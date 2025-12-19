@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Layanan Chat (Aspirasi Privat)</h1>
        <a href="{{ route('home') }}#aspirasi-form" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
            + Buat Chat Baru
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        @forelse($chats as $chat)
            <a href="{{ route('user.chat.show', $chat->id) }}" class="block p-4 border-b border-gray-50 hover:bg-gray-50 transition-colors">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ Str::limit($chat->description, 60) }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Status: {{ $chat->replies && $chat->replies->count() > 0 ? 'Dibalas' : 'Menunggu Respon' }}</p>
                    </div>
                    <span class="text-xs text-gray-400">{{ $chat->created_at->diffForHumans() }}</span>
                </div>
            </a>
        @empty
            <div class="p-8 text-center text-gray-500">
                <p>Belum ada chat privat.</p>
                <p class="text-sm mt-2">Kirim kritik atau saran privat melalui halaman depan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $chats->links() }}
    </div>
</div>
@endsection
