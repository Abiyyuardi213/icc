<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Aspiration::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => auth()->check() ? auth()->user()->email : null, // Email optional for guests now, handled by DB default or nullable
            'phone' => null,
            'description' => $request->description,
            'is_private' => $request->has('is_private'),
        ]);

        return redirect()->to(url()->previous() . '#forum')->with('success', 'Aspirasi Anda berhasil dikirim!');
    }
    public function reply(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk membalas.');
        }

        $request->validate([
            'description' => 'required|string',
        ]);

        $parent = Aspiration::findOrFail($id);

        Aspiration::create([
            'user_id' => auth()->id(),
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'description' => $request->description,
            'is_private' => false,
            'parent_id' => $parent->id
        ]);

        return redirect()->to(url()->previous() . '#forum')->with('success', 'Balasan Anda berhasil dikirim!');
    }
}
