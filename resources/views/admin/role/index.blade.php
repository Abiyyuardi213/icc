@extends('layouts.admin')

@section('title', 'Manajemen Peran')

@section('styles')
@endsection

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Peran</h1>
        <p class="text-gray-600">Kelola peran pengguna dalam sistem</p>
    </div>
    <a href="{{ route('role.create') }}" class="bg-[#EC46A4] hover:bg-[#d63f93] text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Tambah Peran
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-4">
    <div class="overflow-x-auto">
        <table id="roleTable" class="w-full text-left border-collapse display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peran</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $index => $role)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="font-medium text-gray-900">{{ $role->name ?? $role->role_name }}</td>
                        <td>{{ $role->description ?? $role->role_description }}</td>
                        <td class="text-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer toggle-status" 
                                    data-role-id="{{ $role->id }}" 
                                    {{ ($role->is_active ?? $role->role_status) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#EC46A4] rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                            </label>
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('role.edit', $role->id) }}" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                                <button type="button" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition delete-role-btn" 
                                    data-role-id="{{ $role->id }}" 
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



@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#roleTable').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Lanjut",
                    previous: "Kembali"
                },
                zeroRecords: "Tidak ada data yang cocok"
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {

        // Toggle Status
        const toggles = document.querySelectorAll('.toggle-status');
        toggles.forEach(toggle => {
            toggle.addEventListener('change', function() {
                const roleId = this.getAttribute('data-role-id');
                const status = this.checked; // Boolean
                
                // Show loading toast (optional, usually fast enough)
                
                fetch(`{{ url('role') }}/${roleId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    // Send any body if needed, controller might toggle based on logic
                    body: JSON.stringify({}) 
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        Toast.fire({
                            icon: 'success',
                            title: data.message || 'Status berhasil diubah'
                        });
                    } else {
                        throw new Error(data.message || 'Gagal update status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal mengubah status'
                    });
                    this.checked = !status; // Revert checkbox
                });
            });
        });

        // Delete Role with SweetAlert2 & AJAX
        // Delegate event for DataTables (since it redraws DOM)
        document.querySelector('body').addEventListener('click', function(e) {
            if (e.target.closest('.delete-role-btn')) {
                const button = e.target.closest('.delete-role-btn');
                const roleId = button.getAttribute('data-role-id');
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EC46A4',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return fetch(`{{ url('role') }}/${roleId}`, {
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
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .then(data => {
                            if (!data.success) {
                                throw new Error(data.message || 'Gagal menghapus data')
                            }
                            return data
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Role berhasil dihapus.'
                        });
                        // Remove row from DataTable
                        const table = $('#roleTable').DataTable();
                        table.row(button.closest('tr')).remove().draw();
                    }
                });
            }
        });

        // Close modal logic removed as we use SweetAlert2 now
    });
</script>
@endsection
