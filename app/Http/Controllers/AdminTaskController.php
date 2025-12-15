<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminTaskController extends Controller
{
    // Show tasks for a specific event
    public function index(Event $event)
    {
        $tasks = $event->tasks()->orderBy('start_time')->get();
        return view('admin.task.index', compact('event', 'tasks'));
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
        ]);

        $event->tasks()->create($request->all());

        return redirect()->route('admin.event.tasks.index', $event->id)
            ->with('success', 'Task berhasil dibuat.');
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
        ]);

        $task->update($request->all());

        return redirect()->route('admin.event.tasks.index', $event->id)
            ->with('success', 'Task berhasil diperbarui.');
    }

    public function destroy(Event $event, Task $task)
    {
        $task->delete();
        return redirect()->route('admin.event.tasks.index', $event->id)
            ->with('success', 'Task berhasil dihapus.');
    }
}
