@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen User</h1>
        <p class="text-gray-600">Kelola data pengguna dalam sistem</p>
    </div>
    <button onclick="openCreateModal()" class="bg-[#EC46A4] hover:bg-[#d63f93] text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition shadow-md hover:shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Tambah User
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-4">
    <div class="overflow-x-auto">
        <table id="userTable" class="w-full text-left border-collapse display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="font-medium text-gray-900">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="px-3 py-1 bg-pink-50 text-[#EC46A4] rounded-full text-xs font-semibold">
                                {{ $user->role->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick="openEditModal({{ $user->id }})" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </button>
                                <button type="button" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition delete-user-btn" 
                                    data-user-id="{{ $user->id }}" 
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
<div id="modalOverlay" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 transition-opacity flex items-center justify-center">
    
    <!-- Create User Modal -->
    <div id="createModal" class="bg-white rounded-2xl shadow-xl w-full max-w-lg hidden transform transition-all scale-95 opacity-0 m-4">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-800">Tambah User Baru</h3>
            <button onclick="closeModals()" class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            <form id="createForm" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-[#EC46A4]">*</span></label>
                        <input type="text" name="name" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-[#EC46A4]">*</span></label>
                        <input type="email" name="email" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Role <span class="text-[#EC46A4]">*</span></label>
                        <div class="relative">
                            <select name="role_id" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition appearance-none bg-white select2" required>
                                <option value="" disabled selected>Pilih Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Password <span class="text-[#EC46A4]">*</span></label>
                        <input type="password" name="password" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required placeholder="Minimal 8 karakter">
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeModals()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Batal</button>
                    <button type="submit" id="createBtn" class="px-5 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-lg shadow-md transition transform active:scale-95">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editModal" class="bg-white rounded-2xl shadow-xl w-full max-w-lg hidden transform transition-all scale-95 opacity-0 m-4">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-800">Edit User</h3>
            <button onclick="closeModals()" class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="editUserId" name="id">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-[#EC46A4]">*</span></label>
                        <input type="text" id="editName" name="name" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-[#EC46A4]">*</span></label>
                        <input type="email" id="editEmail" name="email" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Role <span class="text-[#EC46A4]">*</span></label>
                        <div class="relative">
                            <select id="editRole" name="role_id" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition appearance-none bg-white select2" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Password Baru <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                        <input type="password" name="password" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition" placeholder="Biarkan kosong jika tidak diubah">
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeModals()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Batal</button>
                    <button type="submit" id="editBtn" class="px-5 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-lg shadow-md transition transform active:scale-95">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ user",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ user",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 user",
                infoFiltered: "(difilter dari _MAX_ total user)",
                paginate: { first: "Awal", last: "Akhir", next: "Lanjut", previous: "Kembali" },
                zeroRecords: "Tidak ada user yang ditemukan"
            }
        });
    });

    // Modal Logic
    const overlay = document.getElementById('modalOverlay');
    const createModal = document.getElementById('createModal');
    const editModal = document.getElementById('editModal');

    function openCreateModal() {
        overlay.classList.remove('hidden');
        createModal.classList.remove('hidden');
        
        // Re-init Select2 for modal
        $('.select2').select2({
            width: '100%'
        });

        // Animation
        setTimeout(() => {
            createModal.classList.remove('scale-95', 'opacity-0');
            createModal.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function openEditModal(userId) {
        // Fetch User Data
        fetch(`{{ url('admin/user') }}/${userId}/edit`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(user => {
            document.getElementById('editUserId').value = user.id;
            document.getElementById('editName').value = user.name;
            document.getElementById('editEmail').value = user.email;
            
            // Re-init Select2 for edit modal and set value
            $('#editRole').val(user.role_id).trigger('change');
            $('#editRole').select2({
                width: '100%'
            });
            
            // Set Form Action
            document.getElementById('editForm').action = `{{ url('admin/user') }}/${userId}`;

            // Show Modal
            overlay.classList.remove('hidden');
            editModal.classList.remove('hidden');
            setTimeout(() => {
                editModal.classList.remove('scale-95', 'opacity-0');
                editModal.classList.add('scale-100', 'opacity-100');
            }, 10);
        })
        .catch(err => {
            Toast.fire({ icon: 'error', title: 'Gagal mengambil data user.' });
        });
    }

    function closeModals() {
        // Animation Out
        createModal.classList.add('scale-95', 'opacity-0');
        createModal.classList.remove('scale-100', 'opacity-100');
        editModal.classList.add('scale-95', 'opacity-0');
        editModal.classList.remove('scale-100', 'opacity-100');
        
        setTimeout(() => {
            overlay.classList.add('hidden');
            createModal.classList.add('hidden');
            editModal.classList.add('hidden');
            document.getElementById('createForm').reset();
            document.getElementById('editForm').reset();
        }, 200);
    }

    // Close on overlay click
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) closeModals();
    });

    // AJAX Create
    document.getElementById('createForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('createBtn');
        const formData = new FormData(this);
        const originalText = btn.innerText;
        btn.disabled = true;
        btn.innerText = 'Menyimpan...';

        fetch(`{{ route('admin.user.store') }}`, {
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
        const btn = document.getElementById('editBtn');
        const formData = new FormData(this);
        // formData.append('_method', 'PUT'); // Already in form
        const originalText = btn.innerText;
        btn.disabled = true;
        btn.innerText = 'Menyimpan...';

        fetch(this.action, {
            method: 'POST', // Spoofed to PUT
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
        if (e.target.closest('.delete-user-btn')) {
            const button = e.target.closest('.delete-user-btn');
            const userId = button.getAttribute('data-user-id');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "User akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EC46A4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(`{{ url('admin/user') }}/${userId}`, {
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
                    Toast.fire({ icon: 'success', title: 'User berhasil dihapus.' });
                    const table = $('#userTable').DataTable();
                    table.row(button.closest('tr')).remove().draw();
                }
            });
        }
    });

</script>
@endsection
