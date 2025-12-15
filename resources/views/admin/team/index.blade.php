@extends('layouts.admin')

@section('title', 'Manajemen Tim')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Tim Peserta</h1>
        <p class="text-gray-600">Verifikasi pendaftaran dan kelola data tim</p>
    </div>
    <!-- No "Create" button because teams register themselves via frontend usually. Admin only manages. -->
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-4">
    <div class="overflow-x-auto">
        <table id="teamTable" class="w-full text-left border-collapse display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tim</th>
                    <th>Kategori (Event)</th>
                    <th>Ketua Tim</th>
                    <th>Jumlah Anggota</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $index => $team)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="font-medium text-gray-900">{{ $team->name }}</td>
                        <td>{{ $team->event->name ?? '-' }}</td>
                        <td>{{ $team->leader_name ?? '-' }}</td>
                        <td>{{ $team->members->count() }} Orang</td>
                        <td class="text-center">
                            @if($team->status == 'verified')
                                <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Approved</span>
                            @elseif($team->status == 'rejected')
                                <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Rejected</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">Pending</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="flex gap-2 justify-center">
                                <button onclick="showTeamDetail({{ $team->id }})" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition" title="Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                                </button>
                                <button onclick="editTeamStatus({{ $team->id }})" class="text-yellow-500 hover:text-yellow-700 bg-yellow-50 hover:bg-yellow-100 p-2 rounded-lg transition" title="Update Status">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 9.414V12h2.586l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg>
                                </button>
                                <button class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition delete-team-btn" data-id="{{ $team->id }}" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
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
    
    <!-- Detail Modal -->
    <div id="detailModal" class="bg-white rounded-2xl shadow-xl w-full max-w-3xl hidden transform transition-all scale-95 opacity-0 m-4 relative">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center sticky top-0 bg-white z-10 rounded-t-2xl">
            <h3 class="text-xl font-bold text-gray-800" id="detailModalTitle">Detail Tim</h3>
            <button onclick="closeModals()" class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[80vh]">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-sm text-gray-500">Event</p>
                    <p class="font-semibold text-gray-800 text-lg" id="detailEventName">-</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span id="detailStatusBadge" class="px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-600">Pending</span>
                </div>
            </div>

            <h4 class="font-bold text-gray-800 mb-3 border-b pb-2">Anggota Tim</h4>
            <div class="space-y-4" id="detailMembersList">
                <!-- Member items injected by JS -->
            </div>
        </div>
        <div class="p-6 border-t border-gray-100 flex justify-end">
            <button onclick="closeModals()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Tutup</button>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div id="statusModal" class="bg-white rounded-2xl shadow-xl w-full max-w-md hidden transform transition-all scale-95 opacity-0 m-4 relative">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-800">Update Status Tim</h3>
            <button onclick="closeModals()" class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            <form id="statusForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="statusTeamId">
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Status</label>
                    <select id="statusSelect" name="status" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#EC46A4] outline-none transition select2">
                        <option value="pending">Pending</option>
                        <option value="verified">Approved (Verified)</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeModals()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-lg shadow-md transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Simple Client Side DataTables
        $('#teamTable').DataTable({
            responsive: true,
            language: {
                search: "Cari Tim:",
                lengthMenu: "Tampilkan _MENU_ tim",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ tim",
                paginate: { first: "Awal", last: "Akhir", next: "Lanjut", previous: "Kembali" },
                zeroRecords: "Belum ada tim yang mendaftar"
            }
        });
    });

    const overlay = document.getElementById('modalOverlay');
    const detailModal = document.getElementById('detailModal');
    const statusModal = document.getElementById('statusModal');

    function closeModals() {
        detailModal.classList.add('scale-95', 'opacity-0');
        statusModal.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            overlay.classList.add('hidden');
            detailModal.classList.add('hidden');
            statusModal.classList.add('hidden');
        }, 200);
    }

    function showTeamDetail(id) {
        fetch(`{{ url('admin/team') }}/${id}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(team => {
            document.getElementById('detailModalTitle').innerText = team.name;
            document.getElementById('detailEventName').innerText = team.event ? team.event.name : '-';
            
            // Status Badge
            const badge = document.getElementById('detailStatusBadge');
            badge.innerText = team.status.toUpperCase();
            badge.className = 'px-3 py-1 text-sm font-semibold rounded-full ';
            if(team.status === 'verified') badge.className += 'bg-green-100 text-green-700';
            else if(team.status === 'rejected') badge.className += 'bg-red-100 text-red-700';
            else badge.className += 'bg-yellow-100 text-yellow-700';

            // Members
            const list = document.getElementById('detailMembersList');
            list.innerHTML = '';
            
            team.members.forEach(member => {
                const roleColor = member.role === 'leader' ? 'text-[#EC46A4] bg-pink-50 border-pink-100' : 'text-gray-600 bg-gray-50 border-gray-100';
                const roleLabel = member.role === 'leader' ? 'Ketua Tim' : 'Anggota';
                
                list.innerHTML += `
                    <div class="flex items-center gap-4 p-3 border rounded-lg ${roleColor} bg-opacity-50">
                        <div class="bg-gray-200 rounded-full h-10 w-10 flex items-center justify-center text-gray-500 font-bold overflow-hidden">
                            ${member.ktm_path 
                                ? `<img src="/storage/${member.ktm_path}" class="w-full h-full object-cover">` 
                                : member.name.charAt(0)}
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-800">${member.name}</p>
                            <p class="text-sm text-gray-500">${member.npm} | ${member.email || '-'}</p>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded border border-current opacity-75">${roleLabel}</span>
                    </div>
                `;
            });

            // Open Modal
            overlay.classList.remove('hidden');
            detailModal.classList.remove('hidden');
            setTimeout(() => {
                detailModal.classList.remove('scale-95', 'opacity-0');
                detailModal.classList.add('scale-100', 'opacity-100');
            }, 10);
        });
    }

    function editTeamStatus(id) {
        document.getElementById('statusTeamId').value = id;
        // Don't fetch current status to pre-select, just default or maybe fetch via row data? 
        // For simplicity, user selects new status
        
        overlay.classList.remove('hidden');
        statusModal.classList.remove('hidden');
        setTimeout(() => {
            statusModal.classList.remove('scale-95', 'opacity-0');
            statusModal.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    // Submit Status Update
    document.getElementById('statusForm').addEventListener('submit', function(e){
        e.preventDefault();
        const id = document.getElementById('statusTeamId').value;
        const status = document.getElementById('statusSelect').value;
        const btn = this.querySelector('button[type="submit"]');
        const originalText = btn.innerText;
        
        btn.disabled = true;
        btn.innerText = 'Menyimpan...';

        fetch(`{{ url('admin/team') }}/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ _method: 'PUT', status: status })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                closeModals();
                Toast.fire({ icon: 'success', title: data.message });
                setTimeout(() => window.location.reload(), 1000);
            } else {
                Toast.fire({ icon: 'error', title: 'Gagal update status.' });
            }
        })
        .catch(err => {
            Toast.fire({ icon: 'error', title: 'Terjadi kesalahan.' });
            console.error(err);
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerText = originalText;
        });
    });

    // Delete
    document.querySelector('body').addEventListener('click', function(e) {
        if (e.target.closest('.delete-team-btn')) {
            const btn = e.target.closest('.delete-team-btn');
            const id = btn.getAttribute('data-id');

            Swal.fire({
                title: 'Hapus Tim?',
                text: "Tim yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EC46A4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ url('admin/team') }}/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ _method: 'DELETE' })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            Toast.fire({ icon: 'success', title: data.message });
                            setTimeout(() => window.location.reload(), 1000);
                        }
                    });
                }
            });
        }
    });
</script>
@endsection
