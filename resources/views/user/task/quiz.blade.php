@extends('layouts.user')

@section('title', $task->title . ' - Quiz')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('user.events.index') }}" class="hover:text-[#EC46A4]">Event Saya</a>
            <span>/</span>
            <span>Detail Quiz</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">{{ $task->title }}</h1>
        <p class="text-gray-600">Event: {{ $task->event->name }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Quiz Content (Left 2/3) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Description Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-lg text-gray-800 mb-4">Instruksi Quiz</h3>
                <div class="prose max-w-none text-gray-600 mb-4">
                    {!! $task->description !!}
                </div>

                <div class="flex gap-4 text-sm text-gray-500 bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#EC46A4]" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Total Soal: <strong>{{ $task->questions->count() }}</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#EC46A4]" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Estimasi Waktu: <strong>Menyesuaikan Deadline</strong></span>
                    </div>
                </div>
            </div>

            @if ($submission)
                <!-- Result Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center">
                    <div
                        class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Quiz Selesai!</h2>
                    <p class="text-gray-600 mb-6">Anda telah menyelesaikan quiz ini.</p>

                    <div class="inline-block bg-gray-50 rounded-xl p-6 border border-gray-100 min-w-[200px]">
                        <p class="text-sm text-gray-500 uppercase tracking-wider font-semibold mb-1">Nilai Anda</p>
                        <p class="text-5xl font-bold text-[#EC46A4]">{{ $submission->score }}</p>
                        <p class="text-sm text-gray-400 mt-2">dari 100</p>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('user.events.index') }}"
                            class="text-[#EC46A4] font-semibold hover:underline">Kembali ke Daftar Event</a>
                    </div>
                </div>
            @elseif(now()->greaterThan($task->end_time))
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl text-center">
                    <p class="font-bold text-lg mb-1">Maaf, Waktu Quiz Telah Habis</p>
                    <p>Anda tidak dapat mengerjakan quiz ini lagi.</p>
                </div>
            @else
                <!-- Quiz Form -->
                <form id="quizForm" action="{{ route('user.tasks.storeQuiz', $task->id) }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        @foreach ($task->questions as $index => $question)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-1 h-full bg-[#EC46A4]"></div>

                                <div class="mb-4">
                                    <h4 class="font-bold text-lg text-gray-800 flex items-start gap-3">
                                        <span
                                            class="bg-gray-100 text-gray-500 px-2 py-1 rounded text-sm min-w-[30px] text-center mt-0.5">{{ $index + 1 }}</span>
                                        <span class="flex-1">{{ $question->question_text }}</span>
                                    </h4>
                                    @if ($question->media_path)
                                        <div class="mt-3 ml-10">
                                            <img src="{{ asset('storage/' . $question->media_path) }}"
                                                class="max-w-full h-auto rounded-lg max-h-64 object-cover border border-gray-200">
                                        </div>
                                    @endif
                                </div>

                                <div class="ml-10 space-y-3">
                                    @foreach ($question->options as $option)
                                        <label
                                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-pink-50 hover:border-pink-200 transition group">
                                            <div class="relative flex items-center">
                                                <input type="radio" name="answers[{{ $question->id }}]"
                                                    value="{{ $option->id }}"
                                                    class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-gray-300 checked:border-[#EC46A4] transition-all">
                                                <span
                                                    class="absolute bg-[#EC46A4] w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                            </div>
                                            <span
                                                class="text-gray-700 group-hover:text-gray-900">{{ $option->option_text }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="button" id="submitQuizBtn"
                            class="bg-[#EC46A4] hover:bg-[#d63f93] text-white font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:-translate-y-1">
                            Kirim Jawaban
                        </button>
                        <!-- Actual submit button hidden to trigger via JS with confirmation -->
                    </div>
                </form>
            @endif
        </div>

        <!-- Sidebar Info (Right 1/3) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                <h4 class="font-bold text-gray-800 mb-4">Informasi Deadline</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Waktu Mulai</p>
                        <p class="font-medium text-gray-800">{{ $task->start_time->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Waktu Selesai</p>
                        <p class="font-medium text-gray-800">{{ $task->end_time->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Sisa Waktu</p>
                        @if (now()->greaterThan($task->end_time))
                            <p class="font-bold text-red-500">Berakhir</p>
                        @else
                            <p class="font-bold text-[#EC46A4]">
                                {{ now()->diffForHumans($task->end_time, ['syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE, 'parts' => 2]) }}
                                lagi</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitBtn = document.getElementById('submitQuizBtn');
            const form = document.getElementById('quizForm');

            if (submitBtn && form) {
                submitBtn.addEventListener('click', function() {
                    // Check if all questions are answered (Optional, maybe warn only)
                    const totalQuestions = {{ $task->questions->count() }};
                    const answered = document.querySelectorAll('input[type="radio"]:checked').length;

                    if (answered < totalQuestions) {
                        Swal.fire({
                            title: 'Masih ada soal kosong!',
                            text: `Anda baru menjawab ${answered} dari ${totalQuestions} soal. Yakin ingin mengumpulkan?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#EC46A4',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Kumpulkan',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                submitForm();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Konfirmasi Pengumpulan',
                            text: "Apakah Anda yakin ingin mengumpulkan jawaban quiz ini?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#EC46A4',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Kirim',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                submitForm();
                            }
                        });
                    }
                });
            }

            function submitForm() {
                const form = document.getElementById('quizForm');
                const submitBtn = document.getElementById('submitQuizBtn');

                // Show loading
                Swal.fire({
                    title: 'Sedang Mengirim...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: `Quiz terkirim! Nilai Anda: ${data.score}`,
                                confirmButtonColor: '#EC46A4',
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message || 'Terjadi kesalahan.',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan sistem.',
                        });
                    });
            }
        });
    </script>
@endsection
