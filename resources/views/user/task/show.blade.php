@extends('layouts.user')

@section('title', $task->title . ' - ICC')

@section('content')
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
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Status Pengumpulan</h3>
            
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('user.tasks.store', $task->id) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-[#EC46A4] transition bg-gray-50">
                            @if($submission && $submission->file_path)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">File saat ini:</p>
                                    <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-[#EC46A4] font-medium hover:underline flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                        </svg>
                                        {{ basename($submission->file_path) }}
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-[#EC46A4] hover:file:bg-pink-100">
                            <p class="text-xs text-gray-400 mt-2">Maksimal 10MB. Format: PDF, ZIP, RAR, DOCX.</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Catatan Tambahan</label>
                        <textarea name="notes" rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition">{{ old('notes', $submission->notes ?? '') }}</textarea>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-end">
                        <button type="submit" class="bg-[#EC46A4] hover:bg-[#d63f93] text-white font-bold py-2.5 px-6 rounded-lg shadow-md transition transform active:scale-95">
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
                <div class="flex items-center gap-3 text-sm">
                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Disubmit pada</p>
                        <p class="text-gray-500">{{ $submission->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
