@extends('layouts.admin')

@section('title', 'Edit Tugas - ' . $event->name)

@section('content')
<div class="mb-6">
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
        <a href="{{ route('admin.event.tasks.index', $event->id) }}" class="hover:text-[#EC46A4]">Tugas</a>
        <span>/</span>
        <span>Edit</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Edit Tugas</h1>
    <p class="text-gray-600">Event: {{ $event->name }}</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-3xl">
    <form action="{{ route('admin.event.tasks.update', ['event' => $event->id, 'task' => $task->id]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Tugas <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ $task->title }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Waktu Mulai <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="start_time" value="{{ $task->start_time->format('Y-m-d\TH:i') }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Waktu Selesai (Deadline) <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="end_time" value="{{ $task->end_time->format('Y-m-d\TH:i') }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Tugas</label>
                <textarea name="description" rows="5" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition">{{ $task->description }}</textarea>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.event.tasks.index', $event->id) }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-lg shadow-md transition">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>
@endsection
