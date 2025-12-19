<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Submission;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    public function show($id)
    {
        $task = Task::findOrFail($id);
        // Verify user belongs to the event
        $userTeam = auth()->user()->team;
        
        if (!$userTeam || $userTeam->event_id != $task->event_id) {
            abort(403, 'Unauthorized access to this task.');
        }

        $submission = $userTeam->submissions->where('task_id', $task->id)->first();

        return view('user.task.show', compact('task', 'submission'));
    }

    public function store(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $userTeam = auth()->user()->team;

        if (!$userTeam || $userTeam->event_id != $task->event_id) {
            abort(403, 'Unauthorized.');
        }

        // Check deadline
        if (now()->greaterThan($task->end_time)) {
             if ($request->expectsJson()) {
                 return response()->json(['success' => false, 'message' => 'Waktu pengumpulan telah habis. Tidak bisa mengirim atau mengupdate tugas.'], 403);
             }
             return redirect()->back()->with('error', 'Waktu pengumpulan telah habis.');
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'link_repository' => 'nullable|url',
            'notes' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,zip,rar,doc,docx|max:10240', // 10MB
        ]);
        
        // Handle File Upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $userTeam->id . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('submissions', $filename, 'public');
        }

        
        // Fix file path persistence logic
        $submissionData = [
            'event_id' => $task->event_id,
            'title' => $request->title ?? 'Submission for ' . $task->title,
            'link_repository' => $request->link_repository,
            'notes' => $request->notes,
            'submitted_at' => now(),
        ];
        
        if ($filePath) {
            $submissionData['file_path'] = $filePath;
        }
        
        $submission = Submission::updateOrCreate(
            ['task_id' => $task->id, 'team_id' => $userTeam->id],
            $submissionData
        );

        // Record History
        \App\Models\SubmissionHistory::create([
            'submission_id' => $submission->id,
            'user_id' => auth()->id(),
            'action' => $submission->wasRecentlyCreated ? 'created' : 'updated',
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Tugas berhasil dikirim.']);
        }

        return redirect()->back()->with('success', 'Tugas berhasil dikirim.');
    }
}
