@extends('layouts.admin')

@section('title', 'Admin - Layanan Chat')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Layanan Chat (Aspirasi Privat)</h1>
    <p class="text-gray-600">Kelola pesan privat dari pengguna.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm">
                    <th class="px-6 py-4 font-semibold">Pengirim</th>
                    <th class="px-6 py-4 font-semibold">Pesan</th>
                    <th class="px-6 py-4 font-semibold">Waktu</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($chats as $chat)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-800">{{ $chat->user->name ?? 'Guest' }}</div>
                        <div class="text-xs text-gray-500">{{ $chat->email ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-700">{{ Str::limit($chat->description, 50) }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $chat->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4">
                        @if($chat->replies && $chat->replies->count() > 0)
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-600 rounded-full">Dibalas</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-600 rounded-full">Menunggu</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.chat.show', $chat->id) }}" class="text-[#EC46A4] hover:underline font-medium text-sm">Lihat & Balas</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        Belum ada pesan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-gray-100">
        {{ $chats->links() }}
    </div>
</div>
@endsection
