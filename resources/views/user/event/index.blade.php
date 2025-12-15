@extends('layouts.user')

@section('title', 'Event Saya - ICC')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Event Saya</h1>
    <p class="text-gray-600">Daftar kompetisi yang sedang Anda ikuti.</p>
</div>

@if($team)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50 bg-opacity-50">
            <div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold 
                    {{ $team->status == 'verified' ? 'bg-green-100 text-green-700' : ($team->status == 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                    {{ ucfirst($team->status) }}
                </span>
                <h3 class="text-xl font-bold text-gray-800 mt-2">{{ $team->event->name }}</h3>
            </div>
            <a href="{{ route('participants.edit') }}" class="text-[#EC46A4] hover:text-[#d63f93] font-medium text-sm flex items-center gap-1 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Tim
            </a>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h4 class="font-semibold text-gray-700 mb-4">Informasi Tim</h4>
                <div class="space-y-3">
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500 text-sm">Nama Tim</span>
                        <span class="font-medium text-gray-800">{{ $team->name }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500 text-sm">Tanggal Daftar</span>
                        <span class="font-medium text-gray-800">{{ $team->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between pb-2">
                        <span class="text-gray-500 text-sm">Ketua Tim</span>
                        <span class="font-medium text-gray-800">{{ $team->leader_name }}</span>
                    </div>
                </div>
            </div>
            <div>
                <h4 class="font-semibold text-gray-700 mb-4">Timeline Event</h4>
                <div class="relative border-l-2 border-gray-200 ml-3 space-y-6 pb-2">
                    <div class="mb-8 ml-6">
                        <span class="absolute -left-2.5 flex items-center justify-center w-5 h-5 bg-blue-100 rounded-full ring-4 ring-white">
                            <span class="w-2.5 h-2.5 bg-blue-500 rounded-full"></span>
                        </span>
                        <h5 class="flex items-center mb-1 text-sm font-semibold text-gray-900">Pendaftaran</h5>
                        <time class="block mb-2 text-xs font-normal leading-none text-gray-400">Sedang Berlangsung</time>
                    </div>
                    <div class="mb-8 ml-6">
                        <span class="absolute -left-2.5 flex items-center justify-center w-5 h-5 bg-gray-200 rounded-full ring-4 ring-white">
                            <span class="w-2.5 h-2.5 bg-gray-400 rounded-full"></span>
                        </span>
                        <h5 class="flex items-center mb-1 text-sm font-semibold text-gray-500">Technical Meeting</h5>
                        <time class="block mb-2 text-xs font-normal leading-none text-gray-400">Akan Datang</time>
                    </div>
                     <div class="ml-6">
                        <span class="absolute -left-2.5 flex items-center justify-center w-5 h-5 bg-gray-200 rounded-full ring-4 ring-white">
                            <span class="w-2.5 h-2.5 bg-gray-400 rounded-full"></span>
                        </span>
                        <h5 class="flex items-center mb-1 text-sm font-semibold text-gray-500">Pelaksanaan Lomba</h5>
                        <time class="block mb-2 text-xs font-normal leading-none text-gray-400">{{ $team->event->event_start ? $team->event->event_start->format('d M Y') : 'TBA' }}</time>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="bg-pink-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-[#EC46A4]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-800 mb-2">Belum ada Event</h3>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">Anda belum mendaftar di kompetisi manapun. Yuk pilih kompetisi yang sesuai dengan minatmu!</p>
        <a href="{{ route('event.list') }}" class="px-6 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-lg shadow-md transition">
            Lihat Event Tersedia
        </a>
    </div>
@endif
@endsection
