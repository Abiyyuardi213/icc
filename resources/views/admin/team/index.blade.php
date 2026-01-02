@extends('layouts.admin')

@section('title', 'Manajemen Tim')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Tim Peserta</h1>
            <p class="text-gray-500 mt-1 text-sm">Verifikasi pendaftaran dan kelola data tim</p>
        </div>
        <!-- Optional: Add filters or export buttons here if needed in future -->
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="overflow-x-auto">
            <table id="teamTable" class="w-full text-left" style="width:100%">
                <thead class="bg-transparent border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-left">No</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-left">Nama Tim
                        </th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-left">Event</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-left">Ketua Tim
                        </th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Rata-rata
                        </th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Status
                        </th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Finalis
                        </th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($teams as $index => $team)
                        @php
                            $avgScore = $team->submissions->whereNotNull('score')->avg('score');
                        @endphp
                        <tr class="hover:bg-gray-50/60 transition-colors group">
                            <td class="px-6 py-4 text-gray-600 font-medium whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-800">{{ $team->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $team->event->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $team->leader_name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-bold text-[#EC46A4]">
                                    {{ $avgScore ? number_format($avgScore, 2) : '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($team->status == 'verified')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-600 border border-green-100">
                                        Approved
                                    </span>
                                @elseif($team->status == 'rejected')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-600 border border-red-100">
                                        Rejected
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-600 border border-yellow-100">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer"
                                        onchange="toggleFinalist({{ $team->id }}, this.checked)"
                                        {{ $team->is_finalist ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#EC46A4]">
                                    </div>
                                </label>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="showTeamDetail({{ $team->id }})"
                                        class="p-2 bg-blue-50 text-blue-500 hover:bg-blue-100 rounded-lg transition-colors tooltip"
                                        title="Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button onclick="editTeamStatus({{ $team->id }}, '{{ $team->status }}')"
                                        class="p-2 bg-yellow-50 text-yellow-600 hover:bg-yellow-100 rounded-lg transition-colors tooltip"
                                        title="Update Status">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </button>
                                    <button
                                        class="p-2 bg-red-50 text-red-500 hover:bg-red-100 rounded-lg transition-colors delete-team-btn"
                                        data-id="{{ $team->id }}" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
    <div id="modalOverlay"
        class="fixed inset-0 z-50 hidden bg-gray-900/60 backdrop-blur-sm transition-opacity flex items-center justify-center p-4">

        <!-- Detail Modal -->
        <div id="detailModal"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl hidden transform transition-all scale-95 opacity-0 m-4 relative flex flex-col max-h-[90vh]">
            <div
                class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 rounded-t-2xl shrink-0">
                <h3 class="text-xl font-bold text-gray-800" id="detailModalTitle">Detail Tim</h3>
                <button onclick="closeModals()"
                    class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="p-6 overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Event</p>
                        <p class="font-bold text-gray-800 text-lg" id="detailEventName">-</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Status</p>
                        <span id="detailStatusBadge"
                            class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-gray-200 text-gray-600">Pending</span>
                    </div>
                </div>

                <div class="mb-4 flex items-center gap-2">
                    <h4 class="font-bold text-gray-800 text-lg">Anggota Tim</h4>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">Member List</span>
                </div>

                <div class="grid grid-cols-1 gap-4" id="detailMembersList">
                    <!-- Member items injected by JS -->
                </div>
            </div>
            <div class="p-6 border-t border-gray-100 flex justify-end shrink-0 bg-white rounded-b-2xl">
                <button onclick="closeModals()"
                    class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-semibold rounded-xl transition">Tutup
                    Detail</button>
            </div>
        </div>

        <!-- Update Status Modal -->
        <div id="statusModal"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md hidden transform transition-all scale-95 opacity-0 m-4 relative">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 rounded-t-2xl">
                <h3 class="text-xl font-bold text-gray-800">Update Status</h3>
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
                <form id="statusForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="statusTeamId">

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Status Validasi</label>
                        <select id="statusSelect" name="status"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-100 focus:border-[#EC46A4] outline-none transition select2">
                            <option value="pending">Pending</option>
                            <option value="verified">Approved (Verified)</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-2">Status "Approved" akan memberikan akses penuh kepada tim.</p>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModals()"
                            class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-semibold rounded-xl transition">Batal</button>
                        <button type="submit"
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
            $('#teamTable').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ tim",
                    info: "Hal _PAGE_ dari _PAGES_",
                    infoEmpty: "Kosong",
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹"
                    },
                    zeroRecords: "Belum ada tim yang mendaftar"
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
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(team => {
                    document.getElementById('detailModalTitle').innerText = team.name;
                    document.getElementById('detailEventName').innerText = team.event ? team.event.name : '-';

                    // Status Badge
                    const badge = document.getElementById('detailStatusBadge');
                    const statusConfig = {
                        'verified': {
                            text: 'Approved',
                            class: 'bg-green-50 text-green-600 border border-green-100'
                        },
                        'rejected': {
                            text: 'Rejected',
                            class: 'bg-red-50 text-red-600 border border-red-100'
                        },
                        'pending': {
                            text: 'Pending',
                            class: 'bg-yellow-50 text-yellow-600 border border-yellow-100'
                        }
                    };

                    const config = statusConfig[team.status] || statusConfig['pending'];
                    badge.innerText = config.text;
                    badge.className =
                        `inline-flex items-center px-4 py-1.5 text-sm font-semibold rounded-full ${config.class}`;

                    // Members
                    const list = document.getElementById('detailMembersList');
                    list.innerHTML = '';

                    team.members.forEach(member => {
                        const isLeader = member.role === 'leader';
                        const roleBadge = isLeader ?
                            `<span class="px-2 py-0.5 rounded text-[10px] font-bold bg-pink-100 text-pink-600 uppercase tracking-wide">Leader</span>` :
                            `<span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-500 uppercase tracking-wide">Member</span>`;

                        const borderClass = isLeader ? 'border-pink-100 bg-pink-50/30' :
                            'border-gray-100 hover:bg-gray-50';

                        list.innerHTML += `
                    <div class="flex items-center gap-4 p-4 border rounded-2xl transition-all ${borderClass}">
                        <div class="h-12 w-12 rounded-full flex items-center justify-center text-white font-bold shadow-sm ${isLeader ? 'bg-[#EC46A4]' : 'bg-gray-400'}">
                            ${member.ktm_path 
                                ? `<img src="/storage/${member.ktm_path}" class="w-full h-full object-cover rounded-full">` 
                                : member.name.charAt(0)}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-0.5">
                                <p class="font-bold text-gray-900 truncate">${member.name}</p>
                                ${roleBadge}
                            </div>
                            <p class="text-sm text-gray-500 truncate">${member.email || 'Email tidak tersedia'}</p>
                            <p class="text-xs text-gray-400 font-mono mt-1">NPM: ${member.npm}</p>
                        </div>
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

        function editTeamStatus(id, currentStatus) {
            document.getElementById('statusTeamId').value = id;
            $('#statusSelect').val(currentStatus).trigger('change');

            // Re-init select2 for this modal if needed, or rely on global class
            $('#statusSelect').select2({
                width: '100%',
                dropdownParent: $('#statusModal')
            });

            overlay.classList.remove('hidden');
            statusModal.classList.remove('hidden');
            setTimeout(() => {
                statusModal.classList.remove('scale-95', 'opacity-0');
                statusModal.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        // Submit Status Update
        document.getElementById('statusForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('statusTeamId').value;
            const status = document.getElementById('statusSelect').value;
            const btn = this.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML =
                '<span class="flex items-center gap-2"><svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...</span>';

            fetch(`{{ url('admin/team') }}/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        _method: 'PUT',
                        status: status
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        closeModals();
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        });
                        setTimeout(() => window.location.reload(), 1000);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Gagal update status.'
                        });
                    }
                })
                .catch(err => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan.'
                    });
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
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
                    cancelButtonColor: '#9CA3AF',
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
                                body: JSON.stringify({
                                    _method: 'DELETE'
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: data.message
                                    });
                                    setTimeout(() => window.location.reload(), 1000);
                                }
                            });
                    }
                });
            }
        });

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
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Gagal update.'
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                    Toast.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan sistem.'
                    });
                });
        }
    </script>
@endsection
