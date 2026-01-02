@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen User</h1>
            <p class="text-gray-500 mt-1 text-sm">Kelola data pengguna dalam sistem</p>
        </div>

        <div>
            <button onclick="openCreateModal()"
                class="bg-[#EC46A4] hover:bg-[#d63f93] text-white font-medium py-2.5 px-5 rounded-xl shadow-lg shadow-pink-200 transition-all hover:shadow-pink-300 flex items-center gap-2 group transform hover:-translate-y-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:rotate-90"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                <span>Tambah User</span>
            </button>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="overflow-x-auto">
            <table id="userTable" class="w-full text-left" style="width:100%">
                <thead class="bg-transparent border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-left">No</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-left">Nama</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-left">Email</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-left">Role</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50/60 transition-colors group">
                            <td class="px-6 py-4 text-gray-600 font-medium whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-gray-700">{{ $user->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-50 text-pink-600">
                                    {{ $user->role->name ?? 'User' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="openEditModal({{ $user->id }})"
                                        class="p-2 bg-blue-50 text-blue-500 hover:bg-blue-100 rounded-lg transition-colors tooltip"
                                        title="Edit User">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" height="24px"
                                            viewBox="0 -960 960 960" width="24px" fill="currentColor">
                                            <path
                                                d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 17l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                                        </svg>
                                    </button>
                                    <button type="button"
                                        class="p-2 bg-red-50 text-red-500 hover:bg-red-100 rounded-lg transition-colors delete-user-btn"
                                        data-user-id="{{ $user->id }}" title="Hapus User">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" height="24px"
                                            viewBox="0 -960 960 960" width="24px" fill="currentColor">
                                            <path
                                                d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
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

    <!-- Modal Overlay with Blur -->
    <div id="modalOverlay"
        class="fixed inset-0 z-50 hidden bg-gray-900/60 backdrop-blur-sm transition-opacity flex items-center justify-center p-4">

        <!-- Create User Modal -->
        <div id="createModal"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-lg hidden transform transition-all scale-95 opacity-0">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 rounded-t-2xl">
                <h3 class="text-xl font-bold text-gray-800">Tambah User Baru</h3>
                <button onclick="closeModals()"
                    class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <form id="createForm" method="POST">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-100 focus:border-[#EC46A4] outline-none transition"
                                placeholder="Contoh: John Doe" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                            <input type="email" name="email"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-100 focus:border-[#EC46A4] outline-none transition"
                                placeholder="john@example.com" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Role Pengguna</label>
                            <div class="relative">
                                <select name="role_id"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-100 focus:border-[#EC46A4] outline-none transition select2"
                                    required>
                                    <option value="" disabled selected>Pilih Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-100 focus:border-[#EC46A4] outline-none transition"
                                required placeholder="Minimal 8 karakter">
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end gap-3">
                        <button type="button" onclick="closeModals()"
                            class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-semibold rounded-xl transition">Batal</button>
                        <button type="submit" id="createBtn"
                            class="px-5 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-xl shadow-lg shadow-pink-200 transition transform active:scale-95">Simpan
                            User</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div id="editModal"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-lg hidden transform transition-all scale-95 opacity-0">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 rounded-t-2xl">
                <h3 class="text-xl font-bold text-gray-800">Edit User</h3>
                <button onclick="closeModals()"
                    class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editUserId" name="id">
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" id="editName" name="name"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-100 focus:border-[#EC46A4] outline-none transition"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                            <input type="email" id="editEmail" name="email"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-100 focus:border-[#EC46A4] outline-none transition"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Role Pengguna</label>
                            <div class="relative">
                                <select id="editRole" name="role_id"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-100 focus:border-[#EC46A4] outline-none transition select2"
                                    required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password Baru <span
                                    class="text-gray-400 font-normal text-xs ml-1">(Opsional)</span></label>
                            <input type="password" name="password"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-100 focus:border-[#EC46A4] outline-none transition"
                                placeholder="Kosongkan jika tidak diubah">
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end gap-3">
                        <button type="button" onclick="closeModals()"
                            class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-semibold rounded-xl transition">Batal</button>
                        <button type="submit" id="editBtn"
                            class="px-5 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-xl shadow-lg shadow-pink-200 transition transform active:scale-95">Simpan
                            Perubahan</button>
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
                    info: "Hal _PAGE_ dari _PAGES_",
                    infoEmpty: "Kosong",
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹"
                    },
                    zeroRecords: "Tidak ada data"
                },
                dom: '<"flex flex-col md:flex-row justify-between items-center mb-6 gap-4"l<"w-full md:w-auto"f>>rt<"flex flex-col md:flex-row justify-between items-center mt-6 gap-4"ip>',
                drawCallback: function() {
                    $('.dataTables_length select').removeClass('border-gray-300').addClass(
                        'px-3 py-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-100 focus:border-pink-400 outline-none text-sm text-gray-600 mx-2'
                    );
                    $('.dataTables_filter input').removeClass('border-gray-300').addClass(
                        'px-4 py-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-100 focus:border-pink-400 outline-none text-sm text-gray-600 bg-white ml-2 w-full md:w-64'
                    );
                    $('.dataTables_filter label').addClass(
                        'flex items-center text-sm text-gray-600 font-medium');
                    $('.dataTables_length').addClass('text-sm text-gray-600');

                    // Pagination customization
                    $('.paginate_button.current').addClass(
                        '!bg-pink-500 !text-white !border-pink-500 hover:!bg-pink-600').removeClass(
                        'bg-white text-gray-700');
                    $('.paginate_button:not(.current)').addClass(
                        '!bg-white !text-gray-600 hover:!bg-gray-50 !border-gray-200');
                }
            });
        });

        const overlay = document.getElementById('modalOverlay');
        const createModal = document.getElementById('createModal');
        const editModal = document.getElementById('editModal');

        function openCreateModal() {
            overlay.classList.remove('hidden');
            createModal.classList.remove('hidden');
            $('.select2').select2({
                width: '100%'
            });
            setTimeout(() => {
                createModal.classList.remove('scale-95', 'opacity-0');
                createModal.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function openEditModal(userId) {
            fetch(`{{ url('admin/user') }}/${userId}/edit`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(user => {
                    document.getElementById('editUserId').value = user.id;
                    document.getElementById('editName').value = user.name;
                    document.getElementById('editEmail').value = user.email;
                    $('#editRole').val(user.role_id).trigger('change');
                    $('#editRole').select2({
                        width: '100%'
                    });
                    document.getElementById('editForm').action = `{{ url('admin/user') }}/${userId}`;

                    overlay.classList.remove('hidden');
                    editModal.classList.remove('hidden');
                    setTimeout(() => {
                        editModal.classList.remove('scale-95', 'opacity-0');
                        editModal.classList.add('scale-100', 'opacity-100');
                    }, 10);
                })
                .catch(err => Swal.fire('Error', 'Gagal memuat data user.', 'error'));
        }

        function closeModals() {
            createModal.classList.add('scale-95', 'opacity-0');
            editModal.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                overlay.classList.add('hidden');
                createModal.classList.add('hidden');
                editModal.classList.add('hidden');
                document.getElementById('createForm').reset();
                document.getElementById('editForm').reset();
            }, 200);
        }

        document.querySelector('body').addEventListener('click', function(e) {
            if (e.target.closest('.delete-user-btn')) {
                const btn = e.target.closest('.delete-user-btn');
                const id = btn.dataset.userId;
                Swal.fire({
                    title: 'Hapus User?',
                    text: "Aksi ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EC46A4',
                    cancelButtonColor: '#9CA3AF',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`{{ url('admin/user') }}/${id}`, {
                            method: 'POST',
                            body: JSON.stringify({
                                _method: 'DELETE'
                            }),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
            }
        });

        document.getElementById('createForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('{{ route('admin.user.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(res => res.json()).then(data => {
                if (data.errors) throw new Error(Object.values(data.errors).flat().join('\n'));
                window.location.reload();
            }).catch(err => Swal.fire('Error', err.message, 'error'));
        });

        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(res => res.json()).then(data => {
                if (data.errors) throw new Error(Object.values(data.errors).flat().join('\n'));
                window.location.reload();
            }).catch(err => Swal.fire('Error', err.message, 'error'));
        });
    </script>
@endsection
