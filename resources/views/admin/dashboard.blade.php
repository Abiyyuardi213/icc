@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
    <p class="text-gray-600">Selamat datang kembali, {{ Auth::user()->name }}!</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card: Users -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Total Users</h3>
            <span class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </span>
        </div>
        <div class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</div>
        <p class="text-xs text-gray-400 mt-1">
            Partisipan Terdaftar
        </p>
    </div>

    <!-- Stat Card: Events -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Total Event</h3>
            <span class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </span>
        </div>
        <div class="text-2xl font-bold text-gray-800">{{ $totalEvents }}</div>
        <p class="text-xs text-gray-400 mt-1">
            Event Aktif
        </p>
    </div>

    <!-- Stat Card: Teams -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Total Tim</h3>
            <span class="p-2 bg-pink-50 text-pink-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </span>
        </div>
        <div class="text-2xl font-bold text-gray-800">{{ $totalTeams }}</div>
        <div class="flex items-center gap-2 mt-1">
             <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded">{{ $verifiedTeams }} Verified</span>
        </div>
    </div>
    
    <!-- Stat Card: Pending Teams -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Menunggu Verifikasi</h3>
            <span class="p-2 bg-yellow-50 text-yellow-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
        </div>
        <div class="text-2xl font-bold text-gray-800">{{ $pendingTeams }}</div>
        <p class="text-xs text-gray-400 mt-1">
            Tim Perlu Review
        </p>
    </div>
</div>

<!-- Recent Teams Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h3 class="font-bold text-gray-800">5 Tim Pendaftar Terbaru</h3>
        <a href="{{ route('admin.team.index') }}" class="text-sm text-[#EC46A4] hover:text-[#d63f93] font-medium">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Nama Tim</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Event</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Ketua</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-center">Status</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($latestTeams as $team)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $team->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $team->event->name ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $team->leader_name ?? '-' }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $team->status == 'verified' ? 'bg-green-100 text-green-700' : ($team->status == 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ ucfirst($team->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-xs text-gray-500">{{ $team->created_at->format('d M H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">Belum ada tim yang mendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
