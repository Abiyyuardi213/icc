@extends('layouts.admin')

@section('title', 'Submisi Tugas - ' . $task->title)

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('admin.event.tasks.index', $event->id) }}" class="hover:text-[#EC46A4]">Tugas</a>
            <span>/</span>
            <span>Submisi</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Submisi: {{ $task->title }}</h1>
        <p class="text-gray-600">Event: {{ $event->name }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-gray-800">Daftar Pengumpulan</h3>
            <span class="text-sm text-gray-500">{{ $submissions->count() }} Tim Mengumpulkan</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm">
                        <th class="px-6 py-4 font-semibold">Tim</th>
                        <th class="px-6 py-4 font-semibold">Judul Submisi</th>
                        <th class="px-6 py-4 font-semibold">Waktu Submit</th>
                        @if ($task->type === 'quiz')
                            <th class="px-6 py-4 font-semibold">Score</th>
                        @else
                            <th class="px-6 py-4 font-semibold">Links/Files</th>
                        @endif
                        <th class="px-6 py-4 font-semibold">Catatan</th>
                        <th class="px-6 py-4 font-semibold">History</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($submissions as $submission)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">{{ $submission->team->name }}</div>
                                <div class="text-xs text-gray-500">Ketua: {{ $submission->team->leader->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $submission->title }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">{{ $submission->updated_at->format('d M Y, H:i') }}</div>
                                <div class="text-xs text-gray-400">{{ $submission->updated_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 space-y-2">
                                @if ($task->type === 'quiz')
                                    <div
                                        class="font-bold text-lg {{ $submission->score >= 70 ? 'text-green-600' : 'text-red-500' }}">
                                        {{ $submission->score ?? 0 }} / 100
                                    </div>
                                @else
                                    @if ($submission->file_path)
                                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank"
                                            class="flex items-center gap-1 text-[#EC46A4] hover:underline text-sm font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Download File
                                        </a>
                                    @endif

                                    @if ($submission->link_repository)
                                        <a href="{{ $submission->link_repository }}" target="_blank"
                                            class="flex items-center gap-1 text-blue-600 hover:underline text-sm font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                            </svg>
                                            Repository
                                        </a>
                                    @endif

                                    @if (!$submission->file_path && !$submission->link_repository)
                                        <div class="text-xs text-gray-400 italic mb-1">Tidak ada lampiran</div>
                                    @endif

                                    @if ($submission->score !== null)
                                        <div
                                            class="mt-2 text-sm font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded inline-block">
                                            Nilai: {{ $submission->score }}
                                            <span class="text-xs font-normal text-gray-500 block">
                                                (Benar: {{ $submission->correct_answers }}, Salah:
                                                {{ $submission->wrong_answers }})
                                            </span>
                                        </div>
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 italic">
                                {{ Str::limit($submission->notes, 50) ?: '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <button onclick="openHistoryModal('{{ $submission->id }}')"
                                        class="text-gray-500 hover:text-[#EC46A4] transition" title="Riwayat">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    @if ($task->type !== 'quiz')
                                        <button
                                            onclick="openGradingModal('{{ $submission->id }}', '{{ $submission->score }}', '{{ $submission->correct_answers }}', '{{ $submission->wrong_answers }}')"
                                            class="text-gray-500 hover:text-blue-600 transition" title="Nilai">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                    @endif

                                    @if ($task->type === 'mixed' && $submission->answers)
                                        @php
                                            // Pre-calculate MC correct count for this submission
                                            $currMcCorrect = 0;
                                            if ($submission->answers) {
                                                foreach ($task->questions as $q) {
                                                    if ($q->options->count() > 0) {
                                                        $ansId = $submission->answers[$q->id] ?? null;
                                                        $opt = $q->options->where('id', $ansId)->first();
                                                        if ($opt && $opt->is_correct) {
                                                            $currMcCorrect++;
                                                        }
                                                    }
                                                }
                                            }
                                        @endphp

                                        <button
                                            onclick="openMixedGradingModal('{{ $submission->id }}', {{ $task->questions->count() }}, {{ $currMcCorrect }}, {{ $submission->grading_status ?? '{}' }})"
                                            class="text-gray-500 hover:text-green-600 transition"
                                            title="Lihat & Nilai Jawaban">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                                            </svg>
                                        </button>

                                        <!-- Hidden Answer Data with Grading Inputs -->
                                        <div id="answer-data-{{ $submission->id }}" class="hidden">
                                            <div class="space-y-4">
                                                @foreach ($task->questions as $index => $question)
                                                    <div class="p-3 bg-gray-50 rounded border border-gray-200">
                                                        <h5 class="font-bold text-gray-700 mb-2">Soal No.
                                                            {{ $index + 1 }}</h5>
                                                        <p class="text-sm text-gray-600 mb-2">
                                                            {{ $question->question_text }}</p>

                                                        <div class="bg-white p-2 rounded border border-gray-200">
                                                            @if ($question->options->count() > 0)
                                                                <!-- Multiple Choice -->
                                                                @php
                                                                    $userAnswerId =
                                                                        $submission->answers[$question->id] ?? null;
                                                                    $selectedOption = $question->options
                                                                        ->where('id', $userAnswerId)
                                                                        ->first();
                                                                    $correctOption = $question->options
                                                                        ->where('is_correct', true)
                                                                        ->first();
                                                                    $isCorrect =
                                                                        $selectedOption && $selectedOption->is_correct;
                                                                @endphp
                                                                <p class="text-sm">
                                                                    <span class="font-semibold">Jawaban Peserta:</span>
                                                                    <span
                                                                        class="{{ $isCorrect ? 'text-green-600' : 'text-red-600' }}">
                                                                        {{ $selectedOption->option_text ?? 'Tidak Menjawab' }}
                                                                    </span>
                                                                </p>
                                                                <p class="text-xs text-gray-500 mt-1">Kunci:
                                                                    {{ $correctOption->option_text }}</p>
                                                            @else
                                                                <!-- Essay grading controls -->
                                                                <p class="text-sm font-semibold mb-1">Jawaban Peserta
                                                                    (Isian)
                                                                    :</p>
                                                                <p
                                                                    class="text-gray-800 whitespace-pre-wrap mb-3 p-2 bg-gray-50 rounded">
                                                                    {{ $submission->answers[$question->id] ?? '-' }}</p>

                                                                @php
                                                                    $gradingStatus = $submission->grading_status ?? [];
                                                                    $thisGrade = $gradingStatus[$question->id] ?? '0'; // default 0 (salah)
                                                                @endphp
                                                                <div class="flex items-center gap-4 border-t pt-2">
                                                                    <span
                                                                        class="text-xs font-bold text-gray-500 uppercase">Nilai
                                                                        Jawaban Ini:</span>
                                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                                        <input type="radio"
                                                                            name="essay_grade_{{ $submission->id }}_{{ $question->id }}"
                                                                            value="1"
                                                                            class="text-green-600 focus:ring-green-500 essay-grade-radio"
                                                                            onchange="recalcMixedScore()"
                                                                            {{ $thisGrade == '1' ? 'checked' : '' }}>
                                                                        <span
                                                                            class="text-sm font-medium text-green-700">Benar</span>
                                                                    </label>
                                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                                        <input type="radio"
                                                                            name="essay_grade_{{ $submission->id }}_{{ $question->id }}"
                                                                            value="0"
                                                                            class="text-red-600 focus:ring-red-500 essay-grade-radio"
                                                                            onchange="recalcMixedScore()"
                                                                            {{ $thisGrade == '0' ? 'checked' : '' }}>
                                                                        <span
                                                                            class="text-sm font-medium text-red-700">Salah</span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- History Data (Hidden) -->
                                <div id="history-data-{{ $submission->id }}" class="hidden">
                                    @foreach ($submission->histories as $history)
                                        <div
                                            class="flex items-start gap-3 text-sm pb-3 border-b border-gray-100 last:border-0 last:pb-0 mb-3 last:mb-0">
                                            <div
                                                class="mt-0.5 w-8 h-8 rounded-full {{ $history->action == 'created' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }} flex flex-shrink-0 items-center justify-center">
                                                @if ($history->action == 'created')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">
                                                    {{ $history->action == 'created' ? 'Mengumpulkan Tugas' : ($history->action == 'graded' ? 'Dinilai' : 'Memperbarui Submisi') }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $history->created_at->format('d M Y, H:i:s') }}</p>
                                                <p class="text-xs text-gray-400">oleh {{ $history->user->name ?? 'User' }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                Belum ada tim yang mengumpulkan tugas ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- History Modal -->
    <div id="historyModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="closeHistoryModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                                Riwayat Perubahan
                            </h3>
                            <div class="mt-2 text-left" id="modalContent">
                                <!-- Content injected via JS -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#EC46A4] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        onclick="closeHistoryModal()">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mixed Grading Modal -->
    <div id="mixedGradingModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="closeMixedGradingModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                <form id="mixedGradingForm" method="POST" action="">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start flex-col w-full">
                            <div class="mb-4 w-full flex justify-between items-center border-b pb-2">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Penilaian Jawaban (Mixed)
                                </h3>
                                <div class="text-right">
                                    <div class="text-xs text-gray-500">Nilai Saat Ini (Otomatis)</div>
                                    <div class="text-2xl font-bold text-[#EC46A4]" id="displayMixedScore">0</div>
                                </div>
                            </div>

                            <div class="mt-2 text-left h-96 overflow-y-auto w-full pr-2" id="mixedGradingContent">
                                <!-- Content injected via JS -->
                            </div>

                            <!-- Hidden inputs for submission -->
                            <input type="hidden" name="score" id="mixedScoreInput">
                            <input type="hidden" name="correct_answers" id="mixedCorrectInput">
                            <input type="hidden" name="wrong_answers" id="mixedWrongInput">
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-3">
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 bg-[#EC46A4] border border-transparent rounded-xl font-semibold text-white hover:bg-[#d63f93] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#EC46A4] shadow-md transition-all">
                            Simpan Penilaian
                        </button>
                        <button type="button"
                            class="mt-3 w-full sm:w-auto inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#EC46A4] sm:mt-0 sm:text-sm"
                            onclick="closeMixedGradingModal()">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Grading Modal -->
    <div id="gradingModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-60 transition-opacity backdrop-blur-sm" aria-hidden="true"
                onclick="closeGradingModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div
                class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-gray-100">
                <form id="gradingForm" method="POST" action="">
                    @csrf
                    <div class="px-6 py-6 border-b border-gray-50 bg-gray-50/50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                Input Penilaian
                            </h3>
                            <button type="button" onclick="closeGradingModal()"
                                class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="px-6 py-6 space-y-6">
                        <!-- Input Grid for Detailed Stats -->
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Correct Answers -->
                            <div class="group">
                                <label for="correct_answers" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center gap-1">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                        Jawaban Benar
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="correct_answers" id="correct_answers" min="0"
                                        required
                                        class="block w-full px-4 py-3 bg-green-50/30 border border-green-200 rounded-xl text-green-800 font-medium placeholder-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                        placeholder="0">
                                </div>
                            </div>

                            <!-- Wrong Answers -->
                            <div class="group">
                                <label for="wrong_answers" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center gap-1">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                        Jawaban Salah
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="wrong_answers" id="wrong_answers" min="0"
                                        required
                                        class="block w-full px-4 py-3 bg-red-50/30 border border-red-200 rounded-xl text-red-800 font-medium placeholder-red-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                                        placeholder="0">
                                </div>
                            </div>
                        </div>

                        <!-- Total Score Input -->
                        <div>
                            <label for="score" class="block text-sm font-bold text-gray-800 mb-2">Total Score
                                Akhir</label>
                            <div class="relative">
                                <input type="number" name="score" id="score" min="0" max="100"
                                    step="0.01" required
                                    class="block w-full px-4 py-4 text-2xl font-bold text-center text-gray-900 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#EC46A4] focus:border-transparent outline-none shadow-sm transition-all"
                                    placeholder="0">
                                <div
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400 font-medium select-none">
                                    / 100
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500 text-center">
                                Masukkan nilai akhir skala 0-100.
                            </p>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex flex-row-reverse gap-3">
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 bg-[#EC46A4] border border-transparent rounded-xl font-semibold text-white hover:bg-[#d63f93] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#EC46A4] shadow-md hover:shadow-lg transition-all transform active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Nilai
                        </button>
                        <button type="button"
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 bg-white border border-gray-300 rounded-xl font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-all"
                            onclick="closeGradingModal()">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        @endif

        function openHistoryModal(id) {
            const content = document.getElementById('history-data-' + id).innerHTML;
            document.getElementById('modalContent').innerHTML = content;
            document.getElementById('historyModal').classList.remove('hidden');
        }

        function closeHistoryModal() {
            document.getElementById('historyModal').classList.add('hidden');
        }

        function openGradingModal(id, score, correct, wrong) {
            const form = document.getElementById('gradingForm');
            // Construct the URL dynamically
            // Use a dummy ID that we can easily replace
            const baseUrl = "{{ route('admin.event.tasks.submissions.grade', [$event->id, $task->id, '999999']) }}";
            form.action = baseUrl.replace('999999', id);

            document.getElementById('score').value = score || '';
            document.getElementById('correct_answers').value = correct || '';
            document.getElementById('wrong_answers').value = wrong || '';

            document.getElementById('gradingModal').classList.remove('hidden');
        }

        function closeGradingModal() {
            document.getElementById('gradingModal').classList.add('hidden');
        }

        // Mixed Grading Logic
        let currentTotalQuestions = 0;
        let currentMcCorrect = 0;

        function openMixedGradingModal(id, totalQuestions, mcCorrect) {
            currentTotalQuestions = totalQuestions;
            currentMcCorrect = mcCorrect;

            // Set Form Action
            const form = document.getElementById('mixedGradingForm');
            const baseUrl = "{{ route('admin.event.tasks.submissions.grade', [$event->id, $task->id, '999999']) }}";
            form.action = baseUrl.replace('999999', id);

            // Inject Content
            const content = document.getElementById('answer-data-' + id).innerHTML;
            document.getElementById('mixedGradingContent').innerHTML = content;

            // Initial Calculation
            recalcMixedScore();

            // Open Modal
            document.getElementById('mixedGradingModal').classList.remove('hidden');
        }

        function closeMixedGradingModal() {
            document.getElementById('mixedGradingModal').classList.add('hidden');
        }

        function recalcMixedScore() {
            // Count checked 'Benar' (value=1) radios inside the modal content
            const modalContent = document.getElementById('mixedGradingContent');
            const radiosp = modalContent.querySelectorAll('input[type="radio"]:checked');

            let essayCorrect = 0;
            radiosp.forEach(radio => {
                if (radio.value === '1') {
                    essayCorrect++;
                }
            });

            const totalCorrect = currentMcCorrect + essayCorrect;
            const totalWrong = currentTotalQuestions - totalCorrect;

            // Calculate Score (Simple Percentage)
            // Prevent division by zero
            let score = 0;
            if (currentTotalQuestions > 0) {
                score = (totalCorrect / currentTotalQuestions) * 100;
            }

            // Update UI
            document.getElementById('displayMixedScore').innerText = score.toFixed(2);

            // Update Hidden Inputs
            document.getElementById('mixedScoreInput').value = score.toFixed(2);
            document.getElementById('mixedCorrectInput').value = totalCorrect;
            document.getElementById('mixedWrongInput').value = totalWrong;
        }
    </script>
@endsection
