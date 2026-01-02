@extends('layouts.admin')

@section('title', 'Tambah Tugas - ' . $event->name)

@section('content')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: 14px !important;
            color: #6b7280 !important;
        }

        .dropify-wrapper .dropify-message .file-icon {
            font-size: 24px !important;
            color: #EC46A4 !important;
        }

        .dropify-wrapper {
            border: 2px dashed #e5e7eb !important;
            border-radius: 0.5rem !important;
            background-color: #f9fafb !important;
        }

        .dropify-wrapper:hover {
            border-color: #EC46A4 !important;
            background-color: #fdf2f8 !important;
        }
    </style>
@endsection
<div class="mb-6">
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
        <a href="{{ route('admin.event.tasks.index', $event->id) }}" class="hover:text-[#EC46A4]">Tugas</a>
        <span>/</span>
        <span>Tambah Baru</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Tambah Tugas Baru</h1>
    <p class="text-gray-600">Event: {{ $event->name }}</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-3xl">
    <form id="createTaskForm" action="{{ route('admin.event.tasks.store', $event->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Tugas <span
                        class="text-red-500">*</span></label>
                <input type="text" name="title"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition"
                    required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Waktu Mulai <span
                            class="text-red-500">*</span></label>
                    <input type="datetime-local" name="start_time"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Waktu Selesai (Deadline) <span
                            class="text-red-500">*</span></label>
                    <input type="datetime-local" name="end_time"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition"
                        required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Tugas</label>
                <textarea name="description" rows="5"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe Tugas <span
                        class="text-red-500">*</span></label>
                <select name="type" id="taskType"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition bg-white"
                    required>
                    <option value="submission">Submisi File / Link</option>
                    <option value="quiz">Quiz (Pilihan Ganda)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tahapan (Stage) <span
                        class="text-red-500">*</span></label>
                <select name="stage"
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition bg-white"
                    required>
                    <option value="preliminary">Penyisihan</option>
                    <option value="final">Final</option>
                </select>
            </div>

            <div id="fileUploadSection">
                <label class="block text-sm font-semibold text-gray-700 mb-1">File Soal/Pendukung (Opsional)</label>
                <input type="file" name="file" class="dropify" data-height="100"
                    data-allowed-file-extensions="pdf zip rar doc docx" data-max-file-size="10M" />
                <p class="text-xs text-gray-500 mt-1">Format: PDF, ZIP, RAR, DOCX. Maks: 10MB.</p>
            </div>

            <!-- Quiz Builder Section -->
            <div id="quizBuilderSection" class="hidden space-y-6 border-t pt-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Quiz Builder</h3>
                    <p class="text-sm text-gray-500 mb-4">Masukan jumlah soal untuk men-generate form pertanyaan.</p>
                    <div class="flex gap-4 items-end">
                        <div class="w-1/3">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Soal</label>
                            <input type="number" id="totalQuestionsInput" name="total_questions"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition"
                                min="1" max="100" placeholder="Contoh: 10">
                        </div>
                        <button type="button" id="generateQuestionsBtn"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">Generate
                            Form</button>
                    </div>
                </div>

                <div id="questionsContainer" class="space-y-6">
                    <!-- Questions will be appended here -->
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.event.tasks.index', $event->id) }}"
                    class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Batal</a>
                <button type="submit" id="submitBtn"
                    class="px-5 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-lg shadow-md transition disabled:opacity-70 disabled:cursor-not-allowed">Simpan
                    Tugas</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happened.'
            }
        });

        // Task Type Toggle
        $('#taskType').on('change', function() {
            const type = $(this).val();
            if (type === 'quiz') {
                $('#quizBuilderSection').removeClass('hidden');
                $('#fileUploadSection').addClass('hidden');
            } else {
                $('#quizBuilderSection').addClass('hidden');
                $('#fileUploadSection').removeClass('hidden');
            }
        });

        // Generate Questions
        $('#generateQuestionsBtn').on('click', function() {
            const total = parseInt($('#totalQuestionsInput').val());
            const container = $('#questionsContainer');
            container.empty();

            if (!total || total < 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Silakan masukkan jumlah soal yang valid (min. 1).'
                });
                return;
            }

            for (let i = 1; i <= total; i++) {
                const questionHtml = `
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 question-item">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="font-bold text-gray-700">Soal No. ${i}</h4>
                            <div class="flex items-center gap-2">
                                <label class="text-xs text-gray-500 font-semibold">Waktu (detik):</label>
                                <input type="number" name="questions[${i}][time_limit]" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 outline-none" placeholder="60">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <textarea name="questions[${i}][text]" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 outline-none" placeholder="Tulis pertanyaan di sini..." required></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            ${[1, 2, 3, 4].map(opt => `
                                <div class="flex items-center gap-2">
                                    <input type="radio" name="questions[${i}][correct]" value="${opt - 1}" class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300" required>
                                    <input type="text" name="questions[${i}][options][]" class="flex-1 px-3 py-1.5 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 outline-none" placeholder="Pilihan ${String.fromCharCode(64 + opt)}" required>
                                </div>
                            `).join('')}
                        </div>
                        <p class="text-xs text-blue-500 mt-2 italic">* Pilih radio button di sebelah kiri untuk menentukan jawaban benar.</p>
                    </div>
                `;
                container.append(questionHtml);
            }
        });

        $('#createTaskForm').on('submit', function(e) {
            e.preventDefault();

            const form = this;
            const submitBtn = $('#submitBtn');
            const originalBtnText = submitBtn.text();

            // validation check
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // Custom Quiz Validation
            if ($('#taskType').val() === 'quiz') {
                if ($('.question-item').length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Belum Ada Soal',
                        text: 'Silakan generate duli form soal.'
                    });
                    return;
                }
            }

            const formData = new FormData(form);

            // Change button state
            submitBtn.prop('disabled', true).html(
                '<span class="flex items-center gap-2"><svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...</span>'
            );

            // Show Loading Swal
            Swal.fire({
                title: 'Mohon Tunggu',
                text: 'Sedang menyimpan data tugas...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw response;
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href =
                                "{{ route('admin.event.tasks.index', $event->id) }}";
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                    submitBtn.prop('disabled', false).text(originalBtnText);

                    let errorMessage = 'Terjadi kesalahan saat menyimpan data.';
                    if (err instanceof Response) {
                        err.json().then(errorData => {
                            if (errorData.message) errorMessage = errorData.message;
                            if (errorData.errors) {
                                const firstError = Object.values(errorData.errors)[0];
                                if (Array.isArray(firstError)) errorMessage = firstError[0];
                                else if (firstError) errorMessage = firstError;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: errorMessage
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: errorMessage
                        });
                    }
                });
        });
    });
</script>
@endsection
