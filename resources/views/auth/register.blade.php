@extends('layouts.main')

@section('title', 'Daftar Akun - ICC 2026')

@section('styles')
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .bg-primary { background-color: #EC46A4; }
    .bg-primary:hover { background-color: #d63f93; }
</style>
@endsection

@section('content')
<div class="flex items-center justify-center min-h-[80vh] p-4 bg-gray-50">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}">
                <img src="{{ asset('image/logo1.png') }}" alt="ICC Logo" class="h-16 mx-auto mb-4">
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h1>
            <p class="text-gray-500 text-sm mt-1">Bergabunglah untuk mengikuti kompetisi</p>
        </div>

        <form id="registerForm" action="{{ route('register.account') }}" method="POST" class="space-y-5">
            @csrf

            <div id="errorContainer" class="hidden bg-red-50 text-red-600 p-3 rounded text-sm mb-4"></div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="name" id="name" required autocomplete="name" autofocus
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition"
                        placeholder="Nama Lengkap Anda"
                        value="{{ old('name') }}">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <input type="email" name="email" id="email" required autocomplete="email"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition"
                        placeholder="nama@email.com"
                        value="{{ old('email') }}">
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="password" name="password" id="password" required
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition"
                        placeholder="••••••••">
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition"
                        placeholder="••••••••">
                </div>
            </div>

            <button type="submit" id="registerBtn"
                class="w-full bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold py-2.5 rounded-lg transition duration-200 shadow-md transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                Daftar
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-[#EC46A4] hover:text-[#d63f93] font-medium">Masuk Disini</a>
        </div>
    </div>
</div>

<script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const btn = document.getElementById('registerBtn');
        const originalBtnText = btn.innerHTML;
        const formData = new FormData(form);

        // Reset errors
        document.getElementById('errorContainer').classList.add('hidden');
        document.getElementById('errorContainer').innerHTML = '';

        // Loading State
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mendaftar...';

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json().then(data => ({status: response.status, body: data})))
        .then(({status, body}) => {
            if (status === 200 && body.success) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: body.message || 'Registrasi Berhasil'
                });

                setTimeout(() => {
                    window.location.href = body.redirect_url;
                }, 1000);
            } else {
                throw body; // Trigger catch for non-200 responses
            }
        })
        .catch(error => {
            btn.disabled = false;
            btn.innerHTML = originalBtnText;

            // Handle Errors
             if (error.errors) {
                let errorHtml = '<ul class="list-disc pl-5">';
                for (const [key, messages] of Object.entries(error.errors)) {
                    messages.forEach(msg => errorHtml += `<li>${msg}</li>`);
                }
                errorHtml += '</ul>';
                
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                
                Toast.fire({
                    icon: 'error',
                    title: 'Registrasi Gagal'
                });
                
                const errContainer = document.getElementById('errorContainer');
                errContainer.innerHTML = errorHtml;
                errContainer.classList.remove('hidden');

            } else {
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.message || 'Terjadi kesalahan sistem',
                });
            }
        });
    });
</script>
@endsection
