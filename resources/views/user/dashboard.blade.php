@extends('layouts.user')

@section('title', 'Dashboard - ICC')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
    <p class="text-gray-600 mt-1">Ini adalah dashboard peserta Anda. Pantau aktivitas kompetisi Anda di sini.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Stat 1: Teams Joined -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="p-3 bg-pink-50 rounded-lg text-[#EC46A4]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Tim Saya</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ Auth::user()->team ? 1 : 0 }}</h3>
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
            <h3 class="text-2xl font-bold text-gray-800">2</h3> 
        </div>
    </div>

    <!-- Stat 3: Event Status -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="p-3 bg-yellow-50 rounded-lg text-yellow-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Status Tim</p>
            <h3 class="text-lg font-bold text-gray-800 capitalize">
                {{ Auth::user()->team ? Auth::user()->team->status : 'Belum Daftar' }}
            </h3>
        </div>
    </div>
</div>

<!-- CTA Section -->
@if(!Auth::user()->team)
<div class="bg-gradient-to-r from-[#EC46A4] to-[#d63f93] rounded-2xl p-8 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 -tr-16 opacity-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-64 w-64" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
        </svg>
    </div>
    <div class="relative z-10 max-w-2xl">
        <h2 class="text-2xl font-bold mb-2">Anda Belum Terdaftar di Kompetisi!</h2>
        <p class="mb-6 opacity-90">Segera daftarkan tim Anda untuk mengikuti ICC 2026. Raih kesempatan memenangkan total hadiah jutaan rupiah!</p>
        <a href="{{ route('event.list') }}" class="inline-block bg-white text-[#EC46A4] font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-50 transition transform hover:-translate-y-1">
            Lihat Daftar Event
        </a>
    </div>
</div>
@else
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Tim Anda: {{ Auth::user()->team->name }}</h3>
            <p class="text-gray-600 text-sm">Event: <span class="font-medium text-[#EC46A4]">{{ Auth::user()->team->event->name ?? '-' }}</span></p>
        </div>
        <a href="{{ route('participants.edit') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
            Kelola Tim
        </a>
    </div>
</div>
@endif

@endsection
