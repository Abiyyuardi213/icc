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
        $messages = [
            'registration_end.after_or_equal' => 'Tanggal selesai registrasi harus setelah atau sama dengan registrasi mulai.',
            'event_start.after_or_equal' => 'Tanggal mulai event harus setelah atau sama dengan registrasi selesai.',
            'event_end.after_or_equal' => 'Tanggal selesai event harus setelah atau sama dengan event mulai.',
            'date_format' => 'Format tanggal tidak valid (YYYY-MM-DD).',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'max_members' => 'required|integer|min:1',
            'registration_start' => 'required|date_format:Y-m-d',
            'registration_end' => 'required|date_format:Y-m-d|after_or_equal:registration_start',
            'event_start' => 'required|date_format:Y-m-d|after_or_equal:registration_end',
            'event_end' => 'required|date_format:Y-m-d|after_or_equal:event_start',
            'preliminary_date' => 'nullable|date_format:Y-m-d',
            'preliminary_type' => 'nullable|string',
            'final_date' => 'nullable|date_format:Y-m-d',
            'final_type' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], $messages);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('events', 'public');
        }

        Event::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) ?: 'event-' . time(),
            'description' => $request->description,
            'max_members' => $request->max_members,
            'registration_start' => \Carbon\Carbon::parse($request->registration_start)->startOfDay(),
            'registration_end' => \Carbon\Carbon::parse($request->registration_end)->startOfDay(),
            'event_start' => \Carbon\Carbon::parse($request->event_start)->startOfDay(),
            'event_end' => \Carbon\Carbon::parse($request->event_end)->startOfDay(),
            'preliminary_date' => $request->preliminary_date ? \Carbon\Carbon::parse($request->preliminary_date)->startOfDay() : null,
            'preliminary_type' => $request->preliminary_type,
            'final_date' => $request->final_date ? \Carbon\Carbon::parse($request->final_date)->startOfDay() : null,
            'final_type' => $request->final_type,
            'photo' => $photoPath,
            'is_active' => true, // Default active
        ]);

        return response()->json(['success' => true, 'message' => 'Event berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        // Format dates for frontend input (YYYY-MM-DD)
        $data = $event->toArray();
        $data['registration_start'] = $event->registration_start ? $event->registration_start->format('Y-m-d') : '';
        $data['registration_end'] = $event->registration_end ? $event->registration_end->format('Y-m-d') : '';
        $data['event_start'] = $event->event_start ? $event->event_start->format('Y-m-d') : '';
        $data['event_end'] = $event->event_end ? $event->event_end->format('Y-m-d') : '';
        $data['preliminary_date'] = $event->preliminary_date ? $event->preliminary_date->format('Y-m-d') : '';
        $data['final_date'] = $event->final_date ? $event->final_date->format('Y-m-d') : '';

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $messages = [
            'registration_end.after_or_equal' => 'Tanggal selesai registrasi harus setelah atau sama dengan registrasi mulai.',
            'event_start.after_or_equal' => 'Tanggal mulai event harus setelah atau sama dengan registrasi selesai.',
            'event_end.after_or_equal' => 'Tanggal selesai event harus setelah atau sama dengan event mulai.',
            'date_format' => 'Format tanggal tidak valid (YYYY-MM-DD).',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'max_members' => 'required|integer|min:1',
            'registration_start' => 'required|date_format:Y-m-d',
            'registration_end' => 'required|date_format:Y-m-d|after_or_equal:registration_start',
            'event_start' => 'required|date_format:Y-m-d|after_or_equal:registration_end',
            'event_end' => 'required|date_format:Y-m-d|after_or_equal:event_start',
            'preliminary_date' => 'nullable|date_format:Y-m-d',
            'preliminary_type' => 'nullable|string',
            'final_date' => 'nullable|date_format:Y-m-d',
            'final_type' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], $messages);

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
            'slug' => Str::slug($request->name) ?: 'event-' . time(),
            'description' => $request->description,
            'max_members' => $request->max_members,
            'registration_start' => \Carbon\Carbon::parse($request->registration_start)->startOfDay(),
            'registration_end' => \Carbon\Carbon::parse($request->registration_end)->startOfDay(),
            'event_start' => \Carbon\Carbon::parse($request->event_start)->startOfDay(),
            'event_end' => \Carbon\Carbon::parse($request->event_end)->startOfDay(),
            'preliminary_date' => $request->preliminary_date ? \Carbon\Carbon::parse($request->preliminary_date)->startOfDay() : null,
            'preliminary_type' => $request->preliminary_type,
            'final_date' => $request->final_date ? \Carbon\Carbon::parse($request->final_date)->startOfDay() : null,
            'final_type' => $request->final_type,
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
