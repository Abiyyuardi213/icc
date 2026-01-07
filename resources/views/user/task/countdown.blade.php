@extends('layouts.user')

@section('title', 'Menunggu Waktu Mulai - ' . $task->title)

@section('content')
    <div class="min-h-[60vh] flex flex-col items-center justify-center text-center p-6">
        <div class="mb-8">
            <div
                class="bg-pink-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 text-[#EC46A4] animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $task->title }}</h1>
            <p class="text-gray-500">Tugas ini belum dimulai. Silakan tunggu.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 w-full max-w-2xl">
            <h2 class="text-sm uppercase tracking-widest text-gray-400 font-semibold mb-6">Waktu Tersisa Menuju Mulai</h2>

            <div class="grid grid-cols-4 gap-4" id="countdown">
                <div class="flex flex-col">
                    <span class="text-4xl md:text-5xl font-bold text-[#EC46A4]" id="days">00</span>
                    <span class="text-xs text-gray-500 mt-1 uppercase">Hari</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-4xl md:text-5xl font-bold text-[#EC46A4]" id="hours">00</span>
                    <span class="text-xs text-gray-500 mt-1 uppercase">Jam</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-4xl md:text-5xl font-bold text-[#EC46A4]" id="minutes">00</span>
                    <span class="text-xs text-gray-500 mt-1 uppercase">Menit</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-4xl md:text-5xl font-bold text-[#EC46A4]" id="seconds">00</span>
                    <span class="text-xs text-gray-500 mt-1 uppercase">Detik</span>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100">
                <p class="text-sm text-gray-600">
                    Waktu Mulai: <span class="font-bold text-gray-800">{{ $task->start_time->format('d F Y, H:i') }}
                        WIB</span>
                </p>
                <div class="mt-4">
                    <a href="{{ route('user.events.index') }}"
                        class="text-gray-400 hover:text-gray-600 text-sm flex items-center justify-center gap-1 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar Event
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startTime = new Date("{{ $task->start_time->toIso8601String() }}").getTime();

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = startTime - now;

                if (distance < 0) {
                    // Time is up, reload page to redirect to actual task
                    window.location.reload();
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById('days').innerText = String(days).padStart(2, '0');
                document.getElementById('hours').innerText = String(hours).padStart(2, '0');
                document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
                document.getElementById('seconds').innerText = String(seconds).padStart(2, '0');
            }

            setInterval(updateCountdown, 1000);
            updateCountdown();
        });
    </script>
@endsection
