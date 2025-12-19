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
                    <th class="px-6 py-4 font-semibold">Links/Files</th>
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
                        @if($submission->file_path)
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="flex items-center gap-1 text-[#EC46A4] hover:underline text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download File
                            </a>
                        @endif
                        
                        @if($submission->link_repository)
                            <a href="{{ $submission->link_repository }}" target="_blank" class="flex items-center gap-1 text-blue-600 hover:underline text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                                Repository
                            </a>
                        @endif

                        @if(!$submission->file_path && !$submission->link_repository)
                            <span class="text-xs text-gray-400 italic">Tidak ada lampiran</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 italic">
                        {{ Str::limit($submission->notes, 50) ?: '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <button onclick="openHistoryModal('{{ $submission->id }}')" class="text-gray-500 hover:text-[#EC46A4] transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <!-- History Data (Hidden) -->
                        <div id="history-data-{{ $submission->id }}" class="hidden">
                            @foreach($submission->histories as $history)
                                <div class="flex items-start gap-3 text-sm pb-3 border-b border-gray-100 last:border-0 last:pb-0 mb-3 last:mb-0">
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
<div id="historyModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeHistoryModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
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
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#EC46A4] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeHistoryModal()">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openHistoryModal(id) {
        const content = document.getElementById('history-data-' + id).innerHTML;
        document.getElementById('modalContent').innerHTML = content;
        document.getElementById('historyModal').classList.remove('hidden');
    }

    function closeHistoryModal() {
        document.getElementById('historyModal').classList.add('hidden');
    }
</script>
@endsection
