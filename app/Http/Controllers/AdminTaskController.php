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
            'file' => 'nullable|file|mimes:pdf,zip,rar,doc,docx|max:10240',
            'type' => 'required|string|in:submission,quiz,mixed',
            'stage' => 'required|string|in:preliminary,final',
        ]);

        $data = $request->except(['questions', 'file']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_task_' . $file->getClientOriginalName();
            $data['file_path'] = $file->storeAs('tasks', $filename, 'public');
        }

        $task = $event->tasks()->create($data);

        // Handle Quiz Data
        if (in_array($request->type, ['quiz', 'mixed']) && $request->has('questions')) {
            foreach ($request->questions as $qData) {
                $question = $task->questions()->create([
                    'question_text' => $qData['text'],
                    'time_limit' => $qData['time_limit'] ?? 60,
                ]);

                if (isset($qData['options']) && is_array($qData['options'])) {
                    foreach ($qData['options'] as $index => $optText) {
                        $question->options()->create([
                            'option_text' => $optText,
                            'is_correct' => isset($qData['correct']) && (int)$qData['correct'] === $index,
                        ]);
                    }
                }
            }
        }

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
        $task->load('questions.options');
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
            'type' => 'required|string|in:submission,quiz,mixed',
            'stage' => 'required|string|in:preliminary,final',
        ]);

        $data = $request->except(['questions', 'file']);

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

        // Handle Quiz Data Update
        if (in_array($request->type, ['quiz', 'mixed'])) {
            // Simple approach: Delete all existing questions and recreate
            // In a production app with submissions, this would require soft deletes or versioning
            $task->questions()->delete();

            if ($request->has('questions')) {
                foreach ($request->questions as $qData) {
                    $question = $task->questions()->create([
                        'question_text' => $qData['text'],
                        'time_limit' => $qData['time_limit'] ?? 60,
                    ]);

                    if (isset($qData['options']) && is_array($qData['options'])) {
                        foreach ($qData['options'] as $index => $optText) {
                            $question->options()->create([
                                'option_text' => $optText,
                                'is_correct' => isset($qData['correct']) && (int)$qData['correct'] === $index,
                            ]);
                        }
                    }
                }
            }
        }

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

    public function gradeSubmission(Request $request, Event $event, Task $task, \App\Models\Submission $submission)
    {
        $request->validate([
            'correct_answers' => 'required|integer|min:0',
            'wrong_answers' => 'required|integer|min:0',
            'score' => 'required|numeric|min:0|max:100',
        ]);

        // Collect per-question grading status (essay_grade_{subId}_{qId})
        $gradingStatus = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'essay_grade_') === 0) {
                // key is like essay_grade_10_5 (10=subId, 5=qId)
                // We actually only need the qId part to map it back
                $parts = explode('_', $key);
                if (count($parts) >= 4) {
                    $qId = $parts[3];
                    $gradingStatus[$qId] = $value;
                }
            }
        }

        $submission->update([
            'correct_answers' => $request->correct_answers,
            'wrong_answers' => $request->wrong_answers,
            'score' => $request->score,
            'grading_status' => $gradingStatus,
        ]);

        // Track history
        $submission->histories()->create([
            'user_id' => auth()->id(),
            'action' => 'graded',
        ]);

        return back()->with('success', 'Nilai berhasil disimpan.');
    }
}
