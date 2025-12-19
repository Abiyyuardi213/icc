<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $events = \App\Models\Event::where('is_active', true)
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get();
        
        $aspirations = \App\Models\Aspiration::where('is_private', false)
                        ->whereNull('parent_id') // Only show main threads
                        ->with(['user', 'replies.user'])
                        ->orderBy('created_at', 'desc')
                        ->simplePaginate(5);

        return view('home', compact('events', 'aspirations'));
    }
}
