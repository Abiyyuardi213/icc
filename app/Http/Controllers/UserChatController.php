<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use Illuminate\Support\Str;

class UserChatController extends Controller
{
    public function index()
    {
        $chats = Aspiration::where('user_id', auth()->id())
                    ->where('is_private', true)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
                    
        return view('user.chat.index', compact('chats'));
    }

    public function show($id)
    {
        $chat = Aspiration::where('user_id', auth()->id())
                    ->where('is_private', true)
                    ->with('replies') // Assuming replies relationship exists or will use parent_id
                    ->findOrFail($id);

        return view('user.chat.show', compact('chat'));
    }
    
    public function storeReply(Request $request, $id)
    {
        $request->validate(['description' => 'required|string']);
        
        $parent = Aspiration::where('user_id', auth()->id())->findOrFail($id);
        
        Aspiration::create([
            'user_id' => auth()->id(),
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'description' => $request->description,
            'is_private' => true,
            'parent_id' => $parent->id
        ]);
        
        return redirect()->back()->with('success', 'Balasan terkirim.');
    }
}
