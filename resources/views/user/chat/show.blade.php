@extends('layouts.user')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <div class="mb-4">
        <a href="{{ route('user.chat.index') }}" class="text-gray-500 hover:text-gray-700 text-sm flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Chat
        </a>
    </div>

    <!-- Main Message -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <div class="flex items-center gap-3 mb-4 border-b border-gray-50 pb-4">
            <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-500 font-bold">
                {{ strtoupper(substr($chat->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="font-bold text-gray-800">{{ $chat->name }}</h2>
                <p class="text-xs text-gray-500">{{ $chat->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
        <div class="prose max-w-none text-gray-700">
            {{ $chat->description }}
        </div>
    </div>

    <!-- Replies -->
    <div class="space-y-4 mb-8">
        @foreach($chat->replies as $reply)
            <div class="bg-gray-50 rounded-lg p-4 ml-8 border border-gray-200">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-gray-700 text-sm">
                        {{ $reply->user_id == auth()->id() ? 'Anda' : 'Admin' }}
                    </span>
                    <span class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-600 text-sm">{{ $reply->description }}</p>
            </div>
        @endforeach
    </div>

    <!-- Reply Form -->
   <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4">Balas Pesan</h3>
        <form action="{{ route('user.chat.reply', $chat->id) }}" method="POST">
            @csrf
            <textarea name="description" rows="3" class="w-full border-gray-300 rounded-lg focus:border-pink-500 focus:ring-pink-500" placeholder="Tulis balasan..." required></textarea>
            <div class="mt-3 flex justify-end">
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-lg font-semibold text-sm transition-colors">
                    Kirim Balasan
                </button>
            </div>
        </form>
   </div>
</div>
@endsection
