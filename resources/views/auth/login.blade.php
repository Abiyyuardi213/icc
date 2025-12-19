@extends('layouts.main')

@section('title', 'Login - ICC 2026')

@section('styles')
<script src="https://cdn.tailwindcss.com"></script>
<style>
    /* Prevent Tailwind from processing the navbar if possible, or just accept it */
    .bg-primary { background-color: #EC46A4; }
    .bg-primary:hover { background-color: #d63f93; }
    .text-primary { color: #EC46A4; }
    .text-primary:hover { color: #d63f93; }
    .focus-ring-primary:focus { --tw-ring-color: #EC46A4; }
</style>
@endsection

@section('content')
<div class="flex items-center justify-center min-h-[80vh] p-4 bg-gray-50">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}">
                <img src="{{ asset('image/logo1.png') }}" alt="ICC Logo" class="h-16 mx-auto mb-4">
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h1>
            <p class="text-gray-500 text-sm mt-1">Silakan masuk untuk mengakses akun Anda</p>
        </div>

        <form id="loginForm" action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Removed Server-side Error Display (handled by generic Toast or client-side) 
                 but keeping it hidden just in case of non-js fallback? 
                 Actually, simpler to just remove if we go full AJAX or keep empty container. -->
            <div id="errorContainer" class="hidden bg-red-50 text-red-600 p-3 rounded text-sm mb-4"></div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <input type="email" name="email" id="email" required autocomplete="email" autofocus
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
                    <input type="password" name="password" id="password" required autocomplete="current-password"
                        class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition"
                        placeholder="••••••••">
                    <button type="button" onclick="togglePassword('password', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                        <!-- Heroicon name: eye -->
                        <svg class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Heroicon name: eye-off -->
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.057 10.057 0 01-1.564 3.029m-5.858-.908a3 3 0 11-4.243-4.243m4.242 4.242L21 21" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" id="loginBtn"
                class="w-full bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold py-2.5 rounded-lg transition duration-200 shadow-md transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                Masuk
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? 
            <a href="{{ route('register.account') }}" class="text-[#EC46A4] hover:text-[#d63f93] font-medium">Daftar Sekarang</a>
        </div>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        // ... (existing submit logic) ...
        e.preventDefault();
        
        const form = this;
        const btn = document.getElementById('loginBtn');
        const originalBtnText = btn.innerHTML;
        const formData = new FormData(form);

        // Reset errors
        document.getElementById('errorContainer').classList.add('hidden');
        document.getElementById('errorContainer').innerHTML = '';

        // Loading State
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...';

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
                    title: body.message || 'Login Berhasil'
                });

                setTimeout(() => {
                    window.location.href = body.redirect_url;
                }, 1000);
            } else {
                throw body; // Trigger catch block with response body
            }
        })
        .catch(error => {
            btn.disabled = false;
            btn.innerHTML = originalBtnText;

            // Handle Validation Errors
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
                    title: error.message || 'Login Gagal'
                });

                // Also show in container if critical
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

    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icons = btn.querySelectorAll('svg');
        
        if (input.type === 'password') {
            input.type = 'text';
            icons[0].classList.remove('hidden'); // Show Eye
            icons[1].classList.add('hidden');    // Hide Eye Off
        } else {
            input.type = 'password';
            icons[0].classList.add('hidden');    // Hide Eye
            icons[1].classList.remove('hidden'); // Show Eye Off
        }
    }
</script>
@endsection
