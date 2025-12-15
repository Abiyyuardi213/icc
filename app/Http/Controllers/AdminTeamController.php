<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Event;
use Illuminate\Http\Request;
// use Yajra\DataTables\Facades\DataTables; // Removed

class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::with(['user', 'event', 'members'])->latest()->get();
        return view('admin.team.index', compact('teams'));
    }

    /**
     * Show the specified resource (Detailed JSON for Modal).
     */
    public function show($id)
    {
        $team = Team::with(['user', 'event', 'members'])->findOrFail($id);
        
        if (request()->expectsJson()) {
            // Append accessors or map data for easier JS handling
            $team->setAppends(['leader_name', 'member_count']);
            return response()->json($team);
        }
        
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,verified,rejected',
        ]);

        $team = Team::findOrFail($id);
        $team->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status tim berhasil diperbarui.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        if ($team) {
            $team->delete();
            return response()->json([
                'success' => true,
                'message' => 'Tim berhasil dihapus.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tim tidak ditemukan.'
        ], 404);
    }
}
