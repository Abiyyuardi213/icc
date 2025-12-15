@extends('layouts.user')

@section('title', 'Dashboard - ICC')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
    <p class="text-gray-600 mt-1">Ini adalah dashboard peserta Anda. Pantau aktivitas kompetisi Anda di sini.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Stat 1: Total Events Joined -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="p-3 bg-pink-50 rounded-lg text-[#EC46A4]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Event Saya</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalEventsJoined }}</h3>
        </div>
    </div>

    <!-- Stat 2: Notifications -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Notifikasi</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $unreadNotifications }}</h3> 
        </div>
    </div>

    <!-- Stat 3: Pending Tasks -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="p-3 bg-yellow-50 rounded-lg text-yellow-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Tugas Belum Selesai</p>
            <h3 class="text-lg font-bold text-gray-800">
                {{ $pendingTasksCount }}
            </h3>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Upcoming/Active Events -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4">Event Terdekat</h3>
        @if($upcomingEvent)
            <div class="border border-pink-100 bg-pink-50 rounded-lg p-5">
                <div class="flex justify-between items-start mb-2">
                    <h4 class="font-bold text-[#EC46A4] text-lg">{{ $upcomingEvent->name }}</h4>
                    <span class="text-xs bg-white text-[#EC46A4] px-2 py-1 rounded border border-pink-100 font-medium">Segera Datang</span>
                </div>
                <p class="text-sm text-gray-600 mb-3">{{ Str::limit(strip_tags($upcomingEvent->description), 100) }}</p>
                <div class="flex items-center gap-4 text-sm text-gray-500">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>{{ $upcomingEvent->event_start ? $upcomingEvent->event_start->format('d M Y') : 'TBA' }}</span>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('user.events.index') }}" class="text-sm font-semibold text-[#EC46A4] hover:underline">Lihat Detail Event &rarr;</a>
                </div>
            </div>
        @else
             <div class="text-center py-6 border-dashed border-2 border-gray-100 rounded-lg">
                <p class="text-gray-500 text-sm">Tidak ada event terdekat atau Anda belum bergabung.</p>
             </div>
        @endif
    </div>

    <!-- My Teams List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-gray-800">Status Tim Saya</h3>
            <a href="{{ route('user.events.index') }}" class="text-sm text-[#EC46A4] hover:text-[#d63f93] font-medium">Lihat Semua</a>
        </div>
        <div class="space-y-4">
            @forelse($teams->take(3) as $team)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div>
                    <p class="font-semibold text-gray-800 text-sm">{{ $team->name }}</p>
                    <p class="text-xs text-gray-500">{{ $team->event->name }}</p>
                </div>
                <span class="px-2 py-1 rounded text-xs font-semibold
                    {{ $team->status == 'verified' ? 'bg-green-100 text-green-700' : ($team->status == 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                    {{ ucfirst($team->status) }}
                </span>
            </div>
            @empty
            <div class="text-center py-4 text-gray-400 text-sm">Belum ada tim terdaftar.</div>
            @endforelse
            
            @if($teams->count() == 0)
                <a href="{{ route('event.list') }}" class="block text-center mt-4 w-full py-2 bg-[#EC46A4] text-white rounded-lg hover:bg-[#d63f93] text-sm font-medium transition">
                    Cari Event & Daftar
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
