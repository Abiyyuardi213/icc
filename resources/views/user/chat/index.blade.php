@extends('layouts.user')

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
                <div class="flex justify-between items-center bg-white p-4 rounded-xl border border-gray-100 hover:border-pink-200 transition-colors shadow-sm mb-3">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800">{{ Str::limit($chat->description, 60) }}</h3>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="text-xs text-gray-500">{{ $chat->created_at->diffForHumans() }}</span>
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $chat->replies && $chat->replies->count() > 0 ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                {{ $chat->replies && $chat->replies->count() > 0 ? 'Dibalas' : 'Menunggu' }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <span class="inline-flex items-center gap-1 text-pink-500 hover:text-pink-600 font-medium text-sm transition-colors">
                            Lihat & Balas
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </span>
                    </div>
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
