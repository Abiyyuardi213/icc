<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        $selected_event_id = $request->query('event_id');
        $events = \App\Models\Event::where('is_active', true)->get();
        $selected_event = $events->find($selected_event_id);

        // Check if user already has a team FOR THIS SPECIFIC EVENT
        if ($selected_event) {
            $existingTeam = $user->teams()->where('event_id', $selected_event->id)->first();
            if ($existingTeam) {
                return redirect()->route('user.events.index')->with('info', 'Anda sudah terdaftar untuk event ini.');
            }
        }

        return view('registration', compact('events', 'selected_event', 'user'));
    }

    public function store(Request $request)
    {
        // ... (Validation Logic same as before, but ensure competition_type matches event id)
        $rules = [
            'competition_id' => ['required', 'exists:events,id'], // Changed from competition_type string
            'team_name' => 'required|string|max:255|unique:teams,name',
            
            // Leader
            'leader_name' => 'required|string|max:255',
            'leader_npm' => 'required|string|max:255', 
            'leader_email' => 'required|email|max:255',
            'leader_phone' => 'required|string|max:15',

            // Members
            'member_1_name' => 'required|string|max:255',
            'member_1_npm' => 'required|string|max:255',

            'member_2_name' => 'nullable|string|max:255',
            'member_2_npm' => 'nullable|string|max:255|required_with:member_2_name',
        ];
        
        $request->validate($rules);

        // Check Duplicate Team for User AND Event
        $existingTeam = \Illuminate\Support\Facades\Auth::user()->teams()
            ->where('event_id', $request->competition_id)
            ->first();

        if ($existingTeam) {
             return back()->withErrors(['team_name' => 'Anda sudah terdaftar di event ini.'])->withInput();
        }

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $team = \App\Models\Team::create([
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'event_id' => $request->competition_id,
                'name' => $request->team_name,
                'status' => 'pending',
            ]);

            // Leader
            $team->members()->create([
                'name' => $request->leader_name,
                'npm' => $request->leader_npm,
                'email' => $request->leader_email,
                'phone' => $request->leader_phone,
                'role' => 'leader',
            ]);

            // Member 1
            $team->members()->create([
                'name' => $request->member_1_name,
                'npm' => $request->member_1_npm,
                'role' => 'member',
            ]);

            // Member 2
            if ($request->member_2_name) {
                $team->members()->create([
                    'name' => $request->member_2_name,
                    'npm' => $request->member_2_npm,
                    'role' => 'member',
                ]);
            }

            \Illuminate\Support\Facades\DB::commit();

            // Create Notification
            \App\Models\Notification::create([
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'title' => 'Pendaftaran Berhasil',
                'message' => 'Anda berhasil mendaftar untuk event ' . $team->event->name . '. Silakan tunggu verifikasi admin.',
                'type' => 'info' 
            ]);

            return redirect()->route('user.events.index')->with('success', 'Registrasi Berhasil! Silakan tunggu verifikasi admin.');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollback();
            return back()->withErrors(['system' => $e->getMessage()])->withInput();
        }
    }

    public function edit()
    {
        $team = \Illuminate\Support\Facades\Auth::user()->team;
        if(!$team) return redirect('/register');
        
        $events = \App\Models\Event::where('is_active', true)->get();
        return view('user.team.edit', compact('team', 'events'));
    }

    public function update(Request $request)
    {
        $team = \Illuminate\Support\Facades\Auth::user()->team;
        if(!$team) return abort(404);

        $rules = [
            'team_name' => 'required|string|max:255|unique:teams,name,' . $team->id,
            
            // Leader
            'leader_name' => 'required|string|max:255',
            'leader_npm' => 'required|string|max:255', 
            'leader_phone' => 'required|string|max:15',

            // Members
            'member_1_name' => 'required|string|max:255',
            'member_1_npm' => 'required|string|max:255',

            'member_2_name' => 'nullable|string|max:255',
            'member_2_npm' => 'nullable|string|max:255|required_with:member_2_name',
        ];
        
        $request->validate($rules);

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $team->update([
                'name' => $request->team_name,
            ]);

            // Update Leader
            $team->leader->update([
                'name' => $request->leader_name,
                'npm' => $request->leader_npm,
                'phone' => $request->leader_phone,
            ]);

            // Update Member 1 (Assuming order 0 is member 1)
            // Ideally we use IDs, but for simplicity we rely on 'role' and order
            $mem1 = $team->members()->where('role', 'member')->skip(0)->first();
            if($mem1) {
                $mem1->update([
                    'name' => $request->member_1_name,
                    'npm' => $request->member_1_npm,
                ]);
            }

            // Update Member 2
             $mem2 = $team->members()->where('role', 'member')->skip(1)->first();
             if ($request->member_2_name) {
                 if ($mem2) {
                     $mem2->update([
                        'name' => $request->member_2_name,
                        'npm' => $request->member_2_npm,
                     ]);
                 } else {
                     // Create new if didn't exist
                    $team->members()->create([
                        'name' => $request->member_2_name,
                        'npm' => $request->member_2_npm,
                        'role' => 'member',
                    ]);
                 }
             } else {
                 // Delete if cleared
                 if ($mem2) $mem2->delete();
             }

            \Illuminate\Support\Facades\DB::commit();
            return redirect('/home')->with('success', 'Data Tim Berhasil Diperbarui!');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollback();
            return back()->withErrors(['system' => $e->getMessage()])->withInput();
        }
    }
}
