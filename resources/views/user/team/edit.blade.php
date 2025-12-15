@extends('layouts.user')

@section('title', 'Edit Tim - ICC')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Data Tim</h1>
    <p class="text-gray-600">Perbarui informasi anggota tim Anda.</p>
</div>

<div class="max-w-4xl bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-[#EC46A4] p-6 text-white bg-opacity-95">
        <h2 class="text-xl font-bold flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            {{ $team->name }}
        </h2>
        <p class="opacity-90 text-sm mt-1 flex items-center gap-2">
            <span class="bg-white/20 px-2 py-0.5 rounded text-xs">Event: {{ $team->event->name }}</span>
            <span class="bg-white/20 px-2 py-0.5 rounded text-xs capitalize">Status: {{ $team->status }}</span>
        </p>
    </div>

    <form action="{{ route('participants.update') }}" method="POST" class="p-8">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="bg-red-50 border border-red-100 text-red-600 p-4 rounded-lg mb-6 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Nama Tim -->
        <div class="mb-8">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Tim</label>
            <input type="text" name="team_name" value="{{ old('team_name', $team->name) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-transparent outline-none transition placeholder-gray-400">
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Data Ketua -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-pink-100 text-[#EC46A4] flex items-center justify-center text-xs">K</span>
                        Data Ketua
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="leader_name" value="{{ old('leader_name', $team->leader->name) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">NPM</label>
                            <input type="text" name="leader_npm" value="{{ old('leader_npm', $team->leader->npm) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">No. WhatsApp</label>
                            <input type="text" name="leader_phone" value="{{ old('leader_phone', $team->leader->phone) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none transition">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                 <!-- Member 1 -->
                 <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs">1</span>
                        Anggota 1
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="member_1_name" value="{{ old('member_1_name', $team->member1->name) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">NPM</label>
                            <input type="text" name="member_1_npm" value="{{ old('member_1_npm', $team->member1->npm) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- Member 2 -->
                <div class="relative">
                    @if(!$team->member2)
                    <div class="absolute inset-0 bg-white/50 z-10 flex items-center justify-center backdrop-blur-[1px]">
                         <p class="text-sm font-medium text-gray-500 bg-white px-3 py-1 rounded shadow-sm border">Tidak ada anggota 2</p>
                    </div>
                    @endif
                    <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs">2</span>
                        Anggota 2 (Opsional)
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="member_2_name" value="{{ old('member_2_name', $team->member2?->name) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">NPM</label>
                            <input type="text" name="member_2_npm" value="{{ old('member_2_npm', $team->member2?->npm) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none transition">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
            <a href="{{ route('user.events.index') }}" class="px-6 py-2.5 text-gray-600 hover:text-gray-900 font-medium transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-bold rounded-lg shadow-lg shadow-pink-200 transition transform hover:-translate-y-0.5">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection
