@extends('layouts.admin')

@section('title', 'Manajemen Event')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"/>
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

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Event</h1>
        <p class="text-gray-600">Kelola daftar event, jadwal, dan kuota</p>
    </div>
    <button onclick="openCreateModal()" class="bg-[#EC46A4] hover:bg-[#d63f93] text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition shadow-md hover:shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Tambah Event
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-4">
    <div class="overflow-x-auto">
        <table id="eventTable" class="w-full text-left border-collapse display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th class="p-4 border-b border-gray-100 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                    <th class="p-4 border-b border-gray-100 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Event</th>
                    <th class="p-4 border-b border-gray-100 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="p-4 border-b border-gray-100 bg-gray-50 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Partisipan</th>
                    <th class="p-4 border-b border-gray-100 bg-gray-50 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Tugas / Progress</th>
                    <th class="p-4 border-b border-gray-100 bg-gray-50 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="p-4 border-b border-gray-100 bg-gray-50 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($events as $index => $event)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="p-4 text-sm text-gray-500 text-center w-12">{{ $index + 1 }}</td>
                    <td class="p-4 max-w-xs overflow-hidden">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-pink-100 flex-shrink-0 flex items-center justify-center text-[#EC46A4] font-bold">
                                {{ substr($event->name, 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <p class="font-semibold text-gray-800 truncate" title="{{ $event->name }}">{{ $event->name }}</p>
                                <p class="text-xs text-gray-500 line-clamp-1">{{ Str::limit(strip_tags($event->description), 30) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-sm text-gray-500">
                        <div class="flex flex-col">
                            <span class="font-medium">{{ $event->event_start ? $event->event_start->format('d M Y') : 'TBA' }}</span>
                            <span class="text-xs text-gray-400">{{ $event->event_end ? 's/d ' . $event->event_end->format('d M Y') : '' }}</span>
                        </div>
                    </td>
                    <td class="p-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                             {{ $event->verified_teams_count }} Tim
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex flex-col items-center gap-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ $event->tasks_count }} Task
                            </span>
                            <div class="flex flex-col items-center mt-1">
                                <span class="text-xs font-bold text-gray-700">
                                    {{ $event->submissions_count }} / {{ $event->verified_teams_count }}
                                </span>
                                <span class="text-[10px] text-gray-400">Submisi / Team</span>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer toggle-status"
                                    data-event-id="{{ $event->id }}"
                                    {{ $event->is_active ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#EC46A4] rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                            </label>
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.event.tasks.index', $event->id) }}" class="text-purple-500 hover:text-purple-700 bg-purple-50 hover:bg-purple-100 p-2 rounded-lg transition" title="Kelola Tugas">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <button onclick="openEditModal({{ $event->id }})" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </button>
                                <button type="button" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition delete-event-btn"
                                    data-event-id="{{ $event->id }}"
                                    title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Overlay -->
<div id="modalOverlay" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 transition-opacity flex items-center justify-center overflow-y-auto">

    <!-- Create Event Modal -->
    <div id="createModal" class="bg-white rounded-2xl shadow-xl w-full max-w-4xl hidden transform transition-all scale-95 opacity-0 m-4 relative">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center sticky top-0 bg-white z-10 rounded-t-2xl">
            <h3 class="text-xl font-bold text-gray-800">Tambah Event Baru</h3>
            <button onclick="closeModals()" class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[80vh]">
            <form id="createForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Event <span class="text-[#EC46A4]">*</span></label>
                            <input type="text" name="name" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Maksimal Tim (Kuota) <span class="text-[#EC46A4]">*</span></label>
                            <input type="number" name="max_members" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" min="1" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Registrasi Mulai <span class="text-[#EC46A4]">*</span></label>
                                <input type="date" name="registration_start" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Registrasi Selesai <span class="text-[#EC46A4]">*</span></label>
                                <input type="date" name="registration_end" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Event Mulai <span class="text-[#EC46A4]">*</span></label>
                                <input type="date" name="event_start" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Event Selesai <span class="text-[#EC46A4]">*</span></label>
                                <input type="date" name="event_end" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Banner Event</label>
                            <input type="file" name="photo" accept="image/*" class="dropify" data-height="150" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M">
                            <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG, GIF. Maks: 5MB.</p>
                        </div>
                    </div>

                    <!-- Kolom Kanan (Deskripsi) -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Event <span class="text-[#EC46A4]">*</span></label>
                            <div class="border rounded-lg overflow-hidden">
                                <textarea name="description" id="createDescription" class="w-full"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeModals()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Batal</button>
                    <button type="submit" id="createBtn" class="px-5 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-lg shadow-md transition transform active:scale-95">Simpan Event</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Event Modal -->
    <div id="editModal" class="bg-white rounded-2xl shadow-xl w-full max-w-4xl hidden transform transition-all scale-95 opacity-0 m-4 relative">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center sticky top-0 bg-white z-10 rounded-t-2xl">
            <h3 class="text-xl font-bold text-gray-800">Edit Event</h3>
            <button onclick="closeModals()" class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[80vh]">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="editEventId" name="id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Event <span class="text-[#EC46A4]">*</span></label>
                            <input type="text" id="editName" name="name" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Maksimal Tim (Kuota) <span class="text-[#EC46A4]">*</span></label>
                            <input type="number" id="editMaxMembers" name="max_members" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" min="1" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Registrasi Mulai <span class="text-[#EC46A4]">*</span></label>
                                <input type="date" id="editRegStart" name="registration_start" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Registrasi Selesai <span class="text-[#EC46A4]">*</span></label>
                                <input type="date" id="editRegEnd" name="registration_end" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Event Mulai <span class="text-[#EC46A4]">*</span></label>
                                <input type="date" id="editEventStart" name="event_start" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Event Selesai <span class="text-[#EC46A4]">*</span></label>
                                <input type="date" id="editEventEnd" name="event_end" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                        </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Banner Event</label>
                            <input type="file" id="editPhotoInput" name="photo" accept="image/*" class="dropify" data-height="150" data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="5M">
                            <p class="text-xs text-gray-400 mt-1">Upload baru untuk mengganti. Format: JPG, JPEG, PNG, GIF. Maks: 5MB.</p>
                        </div>
                    </div>

                    <!-- Kolom Kanan (Deskripsi) -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Event <span class="text-[#EC46A4]">*</span></label>
                            <div class="border rounded-lg overflow-hidden">
                                <textarea name="description" id="editDescription" class="w-full"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeModals()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Batal</button>
                    <button type="submit" id="editBtn" class="px-5 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-lg shadow-md transition transform active:scale-95">Simpan Perubahan</button>
                </div>
            </form>
        </div>  
    </div>
</div>

@endsection

@section('scripts')
<!-- Jodit Editor -->
<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<script>
    let createEditor;
    let editEditor;

    $(document).ready(function() {
        $('#eventTable').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ event",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ event",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 event",
                infoFiltered: "(difilter dari _MAX_ total event)",
                paginate: { first: "Awal", last: "Akhir", next: "Lanjut", previous: "Kembali" },
                zeroRecords: "Tidak ada event yang ditemukan"
            }
        });

        // Initialize Dropify
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happened.'
            }
        });
    });

        // Initialize Jodit for Create
        createEditor = Jodit.make('#createDescription', {
            minHeight: 250,
            toolbarAdaptive: false,
            buttons: "bold,italic,underline,strikethrough,|,ul,ol,|,font,fontsize,paragraph,|,link,|,align,|,undo,redo,|,hr,symbol,fullsize",
        });

        // Initialize Jodit for Edit
        editEditor = Jodit.make('#editDescription', {
            minHeight: 250,
            toolbarAdaptive: false,
            buttons: "bold,italic,underline,strikethrough,|,ul,ol,|,font,fontsize,paragraph,|,link,|,align,|,undo,redo,|,hr,symbol,fullsize",
        });


    // Modal Logic
    const overlay = document.getElementById('modalOverlay');
    const createModal = document.getElementById('createModal');
    const editModal = document.getElementById('editModal');

    function openCreateModal() {
        overlay.classList.remove('hidden');
        createModal.classList.remove('hidden');
        // Animation
        setTimeout(() => {
            createModal.classList.remove('scale-95', 'opacity-0');
            createModal.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function openEditModal(eventId) {
        // Fetch Event Data
        fetch(`{{ url('admin/event') }}/${eventId}/edit`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(event => {
            document.getElementById('editEventId').value = event.id;
            document.getElementById('editName').value = event.name;
            document.getElementById('editMaxMembers').value = event.max_members;
            document.getElementById('editRegStart').value = event.registration_start.split('T')[0];
            document.getElementById('editRegEnd').value = event.registration_end.split('T')[0];
            document.getElementById('editEventStart').value = event.event_start.split('T')[0];
            document.getElementById('editEventEnd').value = event.event_end.split('T')[0];

            // Set Description to Editor
            if(editEditor) {
                editEditor.value = event.description || '';
            }

            // Handle Dropify Logic - AFTER showing modal to ensure dimensions are correct
            document.getElementById('editForm').action = `{{ url('admin/event') }}/${eventId}`;

            // Show Modal first
            overlay.classList.remove('hidden');
            editModal.classList.remove('hidden');
            
            // Wait slightly for transition/rendering
            setTimeout(() => {
                editModal.classList.remove('scale-95', 'opacity-0');
                editModal.classList.add('scale-100', 'opacity-100');
                
                // Initialize/Refresh Dropify when visible
                const dropifyInput = $('#editPhotoInput').dropify();
                const dropifyEvent = dropifyInput.data('dropify');
                dropifyEvent.resetPreview();
                dropifyEvent.clearElement();

                if (event.photo) {
                    const imageUrl = `{{ asset('storage') }}/${event.photo}`;
                    dropifyEvent.settings.defaultFile = imageUrl;
                    dropifyEvent.destroy();
                    dropifyEvent.init();
                }
            }, 10);
        })
        .catch(err => {
            console.error(err);
            Toast.fire({ icon: 'error', title: 'Gagal mengambil data event.' });
        });
    }

    function closeModals() {
        createModal.classList.add('scale-95', 'opacity-0');
        createModal.classList.remove('scale-100', 'opacity-100');
        editModal.classList.add('scale-95', 'opacity-0');
        editModal.classList.remove('scale-100', 'opacity-100');

        setTimeout(() => {
            overlay.classList.add('hidden');
            createModal.classList.add('hidden');
            editModal.classList.add('hidden');

            // Reset forms
            document.getElementById('createForm').reset();
            if(createEditor) createEditor.value = '';
            // Don't modify edit form excessively
        }, 200);
    }

    // Toggle Status
    document.addEventListener('change', function(e) {
        if(e.target.classList.contains('toggle-status')) {
            const eventId = e.target.getAttribute('data-event-id');
            const status = e.target.checked;

            fetch(`{{ url('admin/event') }}/${eventId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    Toast.fire({ icon: 'success', title: data.message });
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(err => {
                Toast.fire({ icon: 'error', title: 'Gagal update status' });
                e.target.checked = !status;
            });
        }
    });

    // AJAX Create
    document.getElementById('createForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const descriptionData = createEditor.value;

        const btn = document.getElementById('createBtn');
        const formData = new FormData(this);
        formData.set('description', descriptionData); // Override with editor data

        const originalText = btn.innerText;
        btn.disabled = true;
        btn.innerText = 'Menyimpan...';

        fetch(`{{ route('admin.event.store') }}`, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(res => res.json().then(data => ({status: res.status, body: data})))
        .then(({status, body}) => {
            if (status === 200 || status === 201) {
                closeModals();
                Toast.fire({ icon: 'success', title: body.message });
                setTimeout(() => window.location.reload(), 1000);
            } else {
                throw new Error(body.message || Object.values(body.errors || {}).flat().join('\n'));
            }
        })
        .catch(err => {
            Toast.fire({ icon: 'error', title: err.message });
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerText = originalText;
        });
    });

    // AJAX Edit
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const descriptionData = editEditor.value;

        const btn = document.getElementById('editBtn');
        const formData = new FormData(this);
        formData.set('description', descriptionData);

        const originalText = btn.innerText;
        btn.disabled = true;
        btn.innerText = 'Menyimpan...';

        fetch(this.action, {
            method: 'POST', // Spoofed to PUT via _method
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(res => res.json().then(data => ({status: res.status, body: data})))
        .then(({status, body}) => {
            if (status === 200) {
                closeModals();
                Toast.fire({ icon: 'success', title: body.message });
                setTimeout(() => window.location.reload(), 1000);
            } else {
                throw new Error(body.message || Object.values(body.errors || {}).flat().join('\n'));
            }
        })
        .catch(err => {
            Toast.fire({ icon: 'error', title: err.message });
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerText = originalText;
        });
    });

    // AJAX Delete
    document.querySelector('body').addEventListener('click', function(e) {
        if (e.target.closest('.delete-event-btn')) {
            const button = e.target.closest('.delete-event-btn');
            const eventId = button.getAttribute('data-event-id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Event akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EC46A4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(`{{ url('admin/event') }}/${eventId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ _method: 'DELETE' })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error(response.statusText);
                        return response.json();
                    })
                    .then(data => {
                        if (!data.success) throw new Error(data.message);
                        return data;
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Toast.fire({ icon: 'success', title: 'Event berhasil dihapus.' });
                    const table = $('#eventTable').DataTable();
                    table.row(button.closest('tr')).remove().draw();
                }
            });
        }
    });
</script>
@endsection
