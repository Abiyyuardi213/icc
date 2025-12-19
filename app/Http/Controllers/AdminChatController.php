<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use Illuminate\Support\Str;

class AdminChatController extends Controller
{
    public function index()
    {
        $chats = Aspiration::where('is_private', true)
                    ->whereNull('parent_id') // Only show main threads
                    ->with(['user', 'replies'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
                    
        return view('admin.chat.index', compact('chats'));
    }

    public function show($id)
    {
        $chat = Aspiration::where('is_private', true)
                    ->with(['user', 'replies.user'])
                    ->findOrFail($id);
                    
        // Mark as read or processed could go here if we had that field
        
        return view('admin.chat.show', compact('chat'));
    }

    public function storeReply(Request $request, $id)
    {
        $request->validate(['description' => 'required|string']);
        
        $parent = Aspiration::findOrFail($id);
        
        Aspiration::create([
            'user_id' => auth()->id(), // Admin user
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'description' => $request->description,
            'is_private' => true,
            'parent_id' => $parent->id
        ]);
        
        return redirect()->back()->with('success', 'Balasan berhasil dikirim.');
    }
}
