<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Event;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTaskController extends Controller
{
    // Show tasks for a specific event
    public function index(Event $event)
    {
        $tasks = $event->tasks()->orderBy('start_time')->get();
        $teams = $event->teams()->with(['user', 'members', 'leader'])->get();
        return view('admin.task.index', compact('event', 'tasks', 'teams'));
    }

    public function create(Event $event)
    {
        return view('admin.task.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'file' => 'nullable|file|mimes:pdf,zip,rar,doc,docx|max:10240', // 10MB Max
        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_task_' . $file->getClientOriginalName();
            $data['file_path'] = $file->storeAs('tasks', $filename, 'public');
        }

        $event->tasks()->create($data);

        // Notify all team leaders (users) of this event
        $teams = $event->teams;
        foreach ($teams as $team) {
            Notification::create([
                'user_id' => $team->user_id,
                'title' => 'Tugas Baru',
                'message' => "Tugas baru '{$request->title}' telah ditambahkan di event {$event->name}. Cek detail tugas sekarang!",
                'type' => 'info'
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Task berhasil dibuat dan notifikasi dikirim.']);
        }

        return redirect()->route('admin.event.tasks.index', $event->id)
            ->with('success', 'Task berhasil dibuat dan notifikasi dikirim.');
    }

    public function edit(Event $event, Task $task)
    {
        return view('admin.task.edit', compact('event', 'task'));
    }

    public function update(Request $request, Event $event, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'file' => 'nullable|file|mimes:pdf,zip,rar,doc,docx|max:10240',
        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            // Delete old file
            if ($task->file_path && Storage::disk('public')->exists($task->file_path)) {
                Storage::disk('public')->delete($task->file_path);
            }

            $file = $request->file('file');
            $filename = time() . '_task_' . $file->getClientOriginalName();
            $data['file_path'] = $file->storeAs('tasks', $filename, 'public');
        }

        $task->update($data);

        // Notify all team leaders
        $teams = $event->teams;
        foreach ($teams as $team) {
            Notification::create([
                'user_id' => $team->user_id,
                'title' => 'Update Tugas',
                'message' => "Tugas '{$task->title}' di event {$event->name} telah diperbarui.",
                'type' => 'info'
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Task berhasil diperbarui dan notifikasi dikirim.']);
        }

        return redirect()->route('admin.event.tasks.index', $event->id)
            ->with('success', 'Task berhasil diperbarui dan notifikasi dikirim.');
    }

    public function destroy(Event $event, Task $task)
    {
        if ($task->file_path && Storage::disk('public')->exists($task->file_path)) {
            Storage::disk('public')->delete($task->file_path);
        }
        $task->delete();
        return redirect()->route('admin.event.tasks.index', $event->id)
            ->with('success', 'Task berhasil dihapus.');
    }

    public function submissions(Event $event, Task $task)
    {
        $submissions = $task->submissions()->with('team.leader')->orderByDesc('updated_at')->get();
        return view('admin.task.submissions', compact('event', 'task', 'submissions'));
    }
}
