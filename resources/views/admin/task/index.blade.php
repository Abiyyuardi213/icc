@extends('layouts.admin')

@section('title', 'Manajemen Tugas - ' . $event->name)

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Tugas</h1>
                <div class="flex items-center gap-2 mt-1">
                    <span class="px-2.5 py-0.5 rounded-full bg-pink-50 text-[#EC46A4] text-xs font-semibold">Event</span>
                    <span class="text-gray-500 font-medium">{{ $event->name }}</span>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.event.index') }}"
                    class="px-4 py-2 bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-gray-800 font-medium rounded-lg transition shadow-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                <a href="{{ route('admin.event.tasks.create', $event->id) }}"
                    class="px-4 py-2 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-medium rounded-lg transition shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah Tugas
                </a>
            </div>
        </div>
    </div>

    <!-- Tasks Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Tugas</h2>
            <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $tasks->count() }} Tugas</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead
                    class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider font-semibold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Informasi Tugas</th>
                        <th class="px-6 py-4">Tahapan</th>
                        <th class="px-6 py-4">Jadwal</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($tasks as $task)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-900 text-base mb-1">{{ $task->title }}</span>
                                    <span
                                        class="text-gray-500 text-xs max-w-md truncate">{{ Str::limit(strip_tags($task->description), 60) }}</span>
                                    <div class="mt-2 flex gap-2">
                                        @if ($task->type == 'quiz')
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                                <svg class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                                Quiz
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                <svg class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                Submission
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($task->stage == 'final')
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        Final Round
                                    </span>
                                @else
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                        Penyisihan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1 text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <span class="w-12 text-xs font-semibold uppercase text-gray-400">Mulai</span>
                                        <span>{{ $task->start_time->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-12 text-xs font-semibold uppercase text-gray-400">Selesai</span>
                                        <span class="text-red-500">{{ $task->end_time->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.event.tasks.submissions', ['event' => $event->id, 'task' => $task->id]) }}"
                                        class="group relative inline-flex items-center justify-center p-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors"
                                        title="Lihat Submisi">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                            <path fill-rule="evenodd"
                                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.event.tasks.edit', ['event' => $event->id, 'task' => $task->id]) }}"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                    <form
                                        action="{{ route('admin.event.tasks.destroy', ['event' => $event->id, 'task' => $task->id]) }}"
                                        method="POST" onsubmit="return confirm('Hapus tugas ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors"
                                            title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                    <p class="text-lg font-medium text-gray-600">Belum ada tugas.</p>
                                    <p class="text-sm">Silakan buat tugas baru untuk event ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Teams Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Tim Terdaftar</h2>
                <p class="text-xs text-gray-500 mt-1">Kelola status kelolosan peserta ke tahap Final.</p>
            </div>
            <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $teams->count() }} Tim</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead
                    class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider font-semibold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Profil Tim</th>
                        <th class="px-6 py-4">Anggota Tim</th>
                        <th class="px-6 py-4 text-center">Status Verifikasi</th>
                        <th class="px-6 py-4 text-center">Lolos Final</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($teams as $team)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-900 text-base">{{ $team->name }}</span>
                                    <div class="flex items-center gap-2 mt-1 text-gray-500 text-xs">
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="font-medium">Ketua: {{ $team->leader_name ?? '-' }}</span>
                                    </div>
                                    <span class="text-xs text-gray-400 pl-5">{{ $team->leader_phone ?? '' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($team->members->where('role', '!=', 'leader')->count() > 0)
                                    <ul class="list-disc list-inside text-xs text-gray-600 space-y-1">
                                        @foreach ($team->members as $member)
                                            @if ($member->role !== 'leader')
                                                <li>{{ $member->name }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-xs text-gray-400 italic">Tidak ada anggota tambahan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                        'verified' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'active' => 'bg-green-50 text-green-700 border-green-200',
                                        'rejected' => 'bg-red-50 text-red-700 border-red-200',
                                    ];
                                    $statusClass =
                                        $statusClasses[$team->status] ?? 'bg-gray-100 text-gray-600 border-gray-200';
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $statusClass }}">
                                    {{ ucfirst($team->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer"
                                        onchange="toggleFinalist({{ $team->id }}, this.checked)"
                                        {{ $team->is_finalist ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none ring-0 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#EC46A4]">
                                    </div>
                                </label>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500">Belum ada tim terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleFinalist(id, isFinalist) {
            fetch(`{{ url('admin/team') }}/${id}/toggle-finalist`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        is_finalist: isFinalist
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal mengubah status.'
                        });
                        // Revert checkbox if needed, usually simple reload
                        setTimeout(() => window.location.reload(), 1500);
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan sistem.'
                    });
                });
        }
    </script>
@endsection
