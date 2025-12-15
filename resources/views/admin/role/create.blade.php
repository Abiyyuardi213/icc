@extends('layouts.admin')

@section('title', 'Tambah Peran')

@section('content')
{{-- Centering Container --}}
<div class="min-h-[80vh] flex flex-col items-center justify-center">
    <div class="w-full max-w-xl">
        {{-- Breadcrumb & Title --}}
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Tambah Peran Baru</h1>
            <div class="flex items-center justify-center gap-2 text-sm text-gray-500">
                <a href="{{ route('role.index') }}" class="hover:text-[#EC46A4] transition">Manajemen Peran</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">Tambah</span>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <form id="createRoleForm" action="{{ route('role.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Name Input --}}
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama Peran <span class="text-[#EC46A4]">*</span></label>
                    <input type="text" name="name" id="name" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition bg-gray-50 focus:bg-white"
                        placeholder="Contoh: Administrator"
                        value="{{ old('name') }}" required>
                    <p class="text-xs text-gray-500">Nama peran harus unik.</p>
                </div>

                {{-- Description Input --}}
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition bg-gray-50 focus:bg-white"
                        placeholder="Jelaskan fungsionalitas peran ini">{{ old('description') }}</textarea>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" id="submitBtn"
                        class="flex-1 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-bold py-3 px-6 rounded-xl transition shadow-md shadow-pink-200 transform active:scale-95">
                        Simpan Peran
                    </button>
                    <a href="{{ route('role.index') }}" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-6 rounded-xl transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('createRoleForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let form = this;
        let btn = document.getElementById('submitBtn');
        let originalBtnText = btn.innerText;

        // Disable button & loading state
        btn.disabled = true;
        btn.innerText = 'Menyimpan...';

        let formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json().then(data => ({status: response.status, body: data})))
        .then(({status, body}) => {
            if (status === 200 || status === 201) {
                Toast.fire({
                    icon: 'success',
                    title: body.message || 'Role berhasil ditambahkan.'
                });
                setTimeout(() => {
                    window.location.href = "{{ route('role.index') }}";
                }, 1000); // Redirect after 1s
            } else {
                throw new Error(body.message || Object.values(body.errors || {}).flat().join('\n'));
            }
        })
        .catch(error => {
            Toast.fire({
                icon: 'error',
                title: error.message || 'Gagal menyimpan data.'
            });
            btn.disabled = false;
            btn.innerText = originalBtnText;
        });
    });
</script>
@endsection
