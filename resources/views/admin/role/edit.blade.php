@extends('layouts.admin')

@section('title', 'Edit Peran')

@section('content')
{{-- Centering Container --}}
<div class="min-h-[80vh] flex flex-col items-center justify-center">
    <div class="w-full max-w-xl">
        {{-- Breadcrumb & Title --}}
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Peran</h1>
            <div class="flex items-center justify-center gap-2 text-sm text-gray-500">
                <a href="{{ route('role.index') }}" class="hover:text-[#EC46A4] transition">Manajemen Peran</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">Edit</span>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <form id="editRoleForm" action="{{ route('role.update', $role->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Name Input --}}
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama Peran <span class="text-[#EC46A4]">*</span></label>
                    <input type="text" name="name" id="name" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition bg-gray-50 focus:bg-white"
                        placeholder="Contoh: Administrator"
                        value="{{ old('name', $role->name ?? $role->role_name) }}" required>
                </div>

                {{-- Description Input --}}
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition bg-gray-50 focus:bg-white"
                        placeholder="Deskripsi singkat tentang peran ini">{{ old('description', $role->description ?? $role->role_description) }}</textarea>
                </div>

                {{-- Status Input --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Status</label>
                    <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-200">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="is_active" value="1" class="form-radio text-[#EC46A4] focus:ring-[#EC46A4]" 
                                {{ ($role->is_active ?? $role->role_status) == 1 ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Aktif</span>
                        </label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="is_active" value="0" class="form-radio text-gray-600 focus:ring-gray-400" 
                                {{ ($role->is_active ?? $role->role_status) == 0 ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Nonaktif</span>
                        </label>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" id="submitBtn"
                        class="flex-1 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-bold py-3 px-6 rounded-xl transition shadow-md shadow-pink-200 transform active:scale-95">
                        Simpan Perubahan
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
    document.getElementById('editRoleForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let form = this;
        let btn = document.getElementById('submitBtn');
        let originalBtnText = btn.innerText;

        // Disable button & loading state
        btn.disabled = true;
        btn.innerText = 'Menyimpan...';

        let formData = new FormData(form);

        fetch(form.action, {
            method: 'POST', // FormData usually requires POST, Method spoofing handles PUT
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                // 'X-CSRF-TOKEN': '{{ csrf_token() }}' // FormData handles this if input exists, but needed for header check mostly.
                // Note: Fetch with FormData does NOT need Content-Type header manually set.
            }
        })
        .then(response => response.json().then(data => ({status: response.status, body: data})))
        .then(({status, body}) => {
            if (status === 200) {
                Toast.fire({
                    icon: 'success',
                    title: body.message || 'Role berhasil diperbarui.'
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
                title: error.message || 'Gagal menyimpan perubahan.'
            });
            btn.disabled = false;
            btn.innerText = originalBtnText;
        });
    });
</script>
@endsection
