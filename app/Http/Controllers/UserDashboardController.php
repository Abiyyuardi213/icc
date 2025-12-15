<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Eager load teams with events and submissions
        $teams = $user->teams()->with(['event.tasks', 'submissions'])->latest()->get();

        $totalEventsJoined = $teams->count();
        $unreadNotifications = $user->notifications()->where('is_read', false)->count();
        
        // Calculate pending tasks across all joined events (only for verified teams)
        $pendingTasksCount = 0;
        foreach ($teams as $team) {
            if ($team->status === 'verified') {
                $eventTasks = $team->event->tasks;
                foreach ($eventTasks as $task) {
                    $hasSubmission = $team->submissions->where('task_id', $task->id)->first();
                    if (!$hasSubmission) {
                        $pendingTasksCount++;
                    }
                }
            }
        }

        // Get nearest upcoming event
        $upcomingEvent = $teams->map(fn($t) => $t->event)
            ->where('event_start', '>', now())
            ->sortBy('event_start')
            ->first();

        return view('user.dashboard', compact(
            'teams',
            'totalEventsJoined',
            'unreadNotifications',
            'pendingTasksCount',
            'upcomingEvent'
        ));
    }
}
