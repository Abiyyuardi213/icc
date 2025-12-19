@extends('layouts.admin')

@section('title', 'Detail Chat')

@section('content')
<div class="mb-6">
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
        <a href="{{ route('admin.chat.index') }}" class="hover:text-[#EC46A4]">Layanan Chat</a>
        <span>/</span>
        <span>Detail</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Percakapan dengan {{ $chat->user->name ?? 'Guest' }}</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Chat Area -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Main Message -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold">
                        {{ strtoupper(substr($chat->user->name ?? 'G', 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $chat->user->name ?? 'Guest' }}</h3>
                        <p class="text-xs text-gray-500">{{ $chat->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
            <div class="prose max-w-none text-gray-700 bg-gray-50 p-4 rounded-lg">
                {{ $chat->description }}
            </div>
        </div>

        <!-- Replies -->
        <div class="space-y-4">
            @foreach($chat->replies as $reply)
                <div class="flex {{ $reply->user_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[80%] {{ $reply->user_id == auth()->id() ? 'bg-pink-50 border-pink-100' : 'bg-white border-gray-100' }} border rounded-xl p-4 shadow-sm">
                        <div class="flex items-center justify-between gap-4 mb-2">
                            <span class="font-semibold text-sm {{ $reply->user_id == auth()->id() ? 'text-[#EC46A4]' : 'text-gray-700' }}">
                                {{ $reply->user_id == auth()->id() ? 'Anda (Admin)' : ($reply->user->name ?? 'User') }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700 text-sm">{{ $reply->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Reply Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky bottom-6">
            <h3 class="font-bold text-gray-800 mb-4">Balas Pesan</h3>
            <form action="{{ route('admin.chat.reply', $chat->id) }}" method="POST">
                @csrf
                <textarea name="description" rows="3" class="w-full border-gray-300 rounded-lg focus:border-[#EC46A4] focus:ring-[#EC46A4]" placeholder="Tulis balasan sebagai admin..." required></textarea>
                <div class="mt-3 flex justify-end">
                    <button type="submit" class="bg-[#EC46A4] hover:bg-pink-600 text-white px-6 py-2 rounded-lg font-semibold text-sm transition-colors">
                        Kirim Balasan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Info Pengirim</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <label class="block text-gray-500 text-xs">Nama</label>
                    <p class="font-medium text-gray-800">{{ $chat->user->name ?? 'Guest' }}</p>
                </div>
                <div>
                    <label class="block text-gray-500 text-xs">Email</label>
                    <p class="font-medium text-gray-800">{{ $chat->email ?? $chat->user->email ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-gray-500 text-xs">Bergabung</label>
                    <p class="font-medium text-gray-800">{{ $chat->user ? $chat->user->created_at->format('d M Y') : '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
