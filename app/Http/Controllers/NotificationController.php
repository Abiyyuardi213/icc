<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->orderBy('created_at', 'desc')->get();
        return view('user.notification.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', auth()->id())->findOrFail($id);
        $notification->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }
    
    public function markAllRead()
    {
        Notification::where('user_id', auth()->id())->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }
}
