<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::whereHas('role', function($q) {
            $q->where('name', '!=', 'admin');
        })->count();

        $totalEvents = Event::count();
        $totalTeams = Team::count();
        $verifiedTeams = Team::where('status', 'verified')->count();
        $pendingTeams = Team::where('status', 'pending')->count();

        $latestTeams = Team::with(['user', 'event'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalEvents',
            'totalTeams',
            'verifiedTeams',
            'pendingTeams',
            'latestTeams'
        ));
    }
}
