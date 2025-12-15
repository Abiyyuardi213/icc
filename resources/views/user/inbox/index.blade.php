@extends('layouts.user')

@section('title', 'Kotak Masuk - ICC')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Kotak Masuk</h1>
        <p class="text-gray-600">Pemberitahuan dan pengumuman terbaru.</p>
    </div>
    <button class="text-sm text-[#EC46A4] hover:underline">Tandai semua dibaca</button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden divide-y divide-gray-100">
    <!-- Notification Item (Unread) -->
    <div class="p-6 bg-pink-50 hover:bg-pink-100 transition cursor-pointer flex gap-4">
        <div class="flex-shrink-0">
            <div class="w-10 h-10 rounded-full bg-[#EC46A4] bg-opacity-10 text-[#EC46A4] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>
        </div>
        <div class="flex-1">
            <div class="flex justify-between items-start">
                <h4 class="text-gray-900 font-semibold text-sm">Selamat Datang di ICC 2026!</h4>
                <span class="text-xs text-gray-500">Baru saja</span>
            </div>
            <p class="text-gray-600 text-sm mt-1">Terima kasih telah bergabung. Lengkapi profil tim Anda untuk mengikuti kompetisi.</p>
        </div>
        <div class="flex-shrink-0 self-center">
            <div class="w-2 h-2 bg-[#EC46A4] rounded-full"></div>
        </div>
    </div>

    <!-- Notification Item (Read) -->
    <div class="p-6 hover:bg-gray-50 transition cursor-pointer flex gap-4">
        <div class="flex-shrink-0">
            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="flex-1">
            <div class="flex justify-between items-start">
                <h4 class="text-gray-800 font-medium text-sm">Informasi Technical Meeting</h4>
                <span class="text-xs text-gray-500">Kemarin</span>
            </div>
            <p class="text-gray-500 text-sm mt-1">Jadwal technical meeting akan diumumkan melalui email dan dashboard ini.</p>
        </div>
    </div>
</div>
@endsection
