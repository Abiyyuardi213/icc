@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
    <p class="text-gray-600">Selamat datang kembali, {{ Auth::user()->name }}!</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Stat Cards -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Total Users</h3>
            <span class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </span>
        </div>
        <div class="text-2xl font-bold text-gray-800">1,234</div>
        <p class="text-xs text-green-500 mt-1 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            +12% from last month
        </p>
    </div>

    <!-- More stat cards can be added here -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Total Teams</h3>
            <span class="p-2 bg-pink-50 text-pink-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </span>
        </div>
        <div class="text-2xl font-bold text-gray-800">45</div>
        <p class="text-xs text-green-500 mt-1 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            +5 new this week
        </p>
    </div>
</div>
@endsection
