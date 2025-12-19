<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::withCount([
            'tasks',
            'submissions',
            'teams as verified_teams_count' => function ($query) {
                $query->where('status', 'verified');
            }
        ])->latest()->get();
        return view('admin.event.index', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'max_members' => 'required|integer|min:1',
            'registration_start' => 'required|date',
            'registration_end' => 'required|date|after_or_equal:registration_start',
            'event_start' => 'required|date|after_or_equal:registration_end',
            'event_end' => 'required|date|after_or_equal:event_start',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('events', 'public');
        }

        Event::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'max_members' => $request->max_members,
            'registration_start' => $request->registration_start,
            'registration_end' => $request->registration_end,
            'event_start' => $request->event_start,
            'event_end' => $request->event_end,
            'photo' => $photoPath,
            'is_active' => true, // Default active
        ]);

        return response()->json(['success' => true, 'message' => 'Event berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'max_members' => 'required|integer|min:1',
            'registration_start' => 'required|date',
            'registration_end' => 'required|date|after_or_equal:registration_start',
            'event_start' => 'required|date|after_or_equal:registration_end',
            'event_end' => 'required|date|after_or_equal:event_start',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $photoPath = $event->photo;
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('events', 'public');
        }

        $event->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'max_members' => $request->max_members,
            'registration_start' => $request->registration_start,
            'registration_end' => $request->registration_end,
            'event_start' => $request->event_start,
            'event_end' => $request->event_end,
            'photo' => $photoPath,
        ]);

        // Notify all team leaders
        $teams = $event->teams;
        foreach ($teams as $team) {
            Notification::create([
                'user_id' => $team->user_id,
                'title' => 'Update Event',
                'message' => "Informasi event '{$event->name}' telah diperbarui.",
                'type' => 'info'
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Event berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->delete();
        }
        return response()->json(['success' => true, 'message' => 'Event berhasil dihapus.']);
    }

    public function toggleStatus($id)
    {
        $event = Event::findOrFail($id);
        $event->is_active = !$event->is_active;
        $event->save();

        // Notify all team leaders
        $statusText = $event->is_active ? 'diaktifkan' : 'dinonaktifkan';
        $teams = $event->teams;
        foreach ($teams as $team) {
            Notification::create([
                'user_id' => $team->user_id,
                'title' => 'Status Event Berubah',
                'message' => "Event '{$event->name}' telah {$statusText}.",
                'type' => $event->is_active ? 'success' : 'warning'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status event berhasil diperbarui.'
        ]);
    }
}
