@extends('layouts.user')

@section('title', 'Notifikasi Saya - ICC')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Notifikasi</h1>
        <p class="text-gray-600 mt-1">Pemberitahuan terbaru tentang aktivitas kompetisi Anda.</p>
    </div>
    <form action="{{ route('notifications.readAll') }}" method="POST">
        @csrf
        <button type="submit" class="text-sm text-[#EC46A4] font-medium hover:text-[#d63f93] hover:underline">
            Tandai Semua Dibaca
        </button>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    @if($notifications->count() > 0)
        <div class="divide-y divide-gray-100">
            @foreach($notifications as $notification)
                <div class="p-4 hover:bg-gray-50 transition {{ $notification->is_read ? 'opacity-60' : 'bg-pink-50/30' }}">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 mt-1">
                            @if($notification->type == 'success')
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            @elseif($notification->type == 'warning')
                                <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                            @elseif($notification->type == 'error')
                                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                            @else
                                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                            @endif
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-semibold text-gray-800 {{ $notification->is_read ? '' : 'text-[#EC46A4]' }}">
                                {{ $notification->title }}
                            </h4>
                            <p class="text-gray-600 text-sm mt-1">{{ $notification->message }}</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex-shrink-0 self-center">
                            @if(!$notification->is_read)
                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs border border-gray-200 rounded px-2 py-1 text-gray-500 hover:bg-gray-100">
                                        Mark Read
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-8 text-center">
            <div class="inline-block p-4 rounded-full bg-gray-50 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900">Belum ada notifikasi</h3>
            <p class="text-gray-500 mt-1">Anda akan melihat pemberitahuan di sini.</p>
        </div>
    @endif
</div>
@endsection
