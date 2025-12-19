@extends('layouts.user')

@section('title', $task->title . ' - ICC')

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
        <a href="{{ route('user.events.index') }}" class="hover:text-[#EC46A4]">Event Saya</a>
        <span>/</span>
        <span>Detail Tugas</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">{{ $task->title }}</h1>
    <p class="text-gray-600">Event: {{ $task->event->name }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Task Details (Left 2/3) -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Deskripsi Tugas</h3>
            <div class="prose max-w-none text-gray-600">
                {!! $task->description !!}
            </div>

            @if($task->file_path)
            <div class="mt-6 pt-6 border-t border-gray-100">
                <h4 class="font-semibold text-gray-800 mb-2">File Lampiran/Soal:</h4>
                <a href="{{ asset('storage/' . $task->file_path) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 hover:bg-gray-100 text-gray-700 rounded-lg border border-gray-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#EC46A4]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                    </svg>
                    <span>Download File Tugas</span>
                </a>
            </div>
            @endif
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Status Pengumpulan</h3>
            
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form id="submissionForm" action="{{ route('user.tasks.store', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Submisi</label>
                        <input type="text" name="title" value="{{ old('title', $submission->title ?? 'Submission for ' . $task->title) }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Link Repository (Git)</label>
                        <input type="url" name="link_repository" value="{{ old('link_repository', $submission->link_repository ?? '') }}" placeholder="https://github.com/username/repo" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Upload File (PDF/ZIP)</label>
                        
                        @if($submission && $submission->file_path)
                        <div class="mb-3">
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-700 text-sm font-medium rounded-md border border-green-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                </svg>
                                <span>Lihat File Submisi Saya</span>
                            </a>
                        </div>
                        @endif

                        <input type="file" name="file" class="dropify" data-height="150" 
                            data-allowed-file-extensions="pdf zip rar doc docx" 
                            data-max-file-size="10M"
                            @if($submission && $submission->file_path) data-default-file="{{ asset('storage/' . $submission->file_path) }}" @endif
                        />
                        <p class="text-xs text-gray-500 mt-1">Maksimal 10MB. Format: PDF, ZIP, RAR, DOCX.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Catatan Tambahan</label>
                        <textarea name="notes" rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition">{{ old('notes', $submission->notes ?? '') }}</textarea>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-end">
                        <button type="submit" id="submitBtn" class="bg-[#EC46A4] hover:bg-[#d63f93] text-white font-bold py-2.5 px-6 rounded-lg shadow-md transition transform active:scale-95 disabled:opacity-70 disabled:cursor-not-allowed">
                            {{ $submission ? 'Update Submisi' : 'Kirim Tugas' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Sidebar Info (Right 1/3) -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
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
                    @if(now()->greaterThan($task->end_time))
                        <p class="font-bold text-red-500">Berakhir</p>
                    @else
                        <p class="font-bold text-[#EC46A4]">{{ now()->diffForHumans($task->end_time, ['syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE, 'parts' => 2]) }} lagi</p>
                    @endif
                </div>
            </div>
        </div>

        @if($submission)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h4 class="font-bold text-gray-800 mb-4">History Submisi</h4>
            <div class="space-y-3">
            <div class="space-y-4">
                @foreach($submission->histories as $history)
                <div class="flex items-start gap-3 text-sm pb-3 border-b border-gray-50 last:border-0 last:pb-0">
                    <div class="mt-0.5 w-8 h-8 rounded-full {{ $history->action == 'created' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }} flex flex-shrink-0 items-center justify-center">
                        @if($history->action == 'created')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        @endif
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">{{ $history->action == 'created' ? 'Mengumpulkan Tugas' : 'Memperbarui Submisi' }}</p>
                        <p class="text-xs text-gray-500">{{ $history->created_at->format('d M Y, H:i:s') }}</p>
                        <p class="text-xs text-gray-400">oleh {{ $history->user->name ?? 'User' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        const dropifyInput = $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happened.'
            }
        });

        // Initialize preview if exists
        @if($submission && $submission->file_path)
            const dropifyEvent = dropifyInput.data('dropify');
            dropifyEvent.resetPreview();
            dropifyEvent.clearElement();
            dropifyEvent.settings.defaultFile = "{{ asset('storage/' . $submission->file_path) }}";
            dropifyEvent.destroy();
            dropifyEvent.init();
        @endif

        $('#submissionForm').on('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = $('#submitBtn');
            const originalBtnText = submitBtn.text();

            // validation check
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const formData = new FormData(form);

            // Change button state
            submitBtn.prop('disabled', true).html('<span class="flex items-center gap-2"><svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Tunggu...</span>');

            // Show Loading Swal
            Swal.fire({
                title: 'Mohon Tunggu',
                text: 'Sedang mengunggah tugas...',
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
                        window.location.reload();
                    });
                }
            })
            .catch(err => {
                console.error(err);
                submitBtn.prop('disabled', false).text(originalBtnText);
                
                let errorMessage = 'Terjadi kesalahan saat mengirim tugas.';
                if (err instanceof Response) {
                    err.json().then(errorData => {
                        if (errorData.message) errorMessage = errorData.message;
                        if (errorData.errors) {
                             const firstError = Object.values(errorData.errors)[0];
                             if(firstError) errorMessage = firstError;
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
