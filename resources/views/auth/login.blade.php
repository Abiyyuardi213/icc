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

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-3 rounded text-sm mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition"
                        placeholder="••••••••">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold py-2.5 rounded-lg transition duration-200 shadow-md transform hover:-translate-y-0.5">
                Masuk
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? 
            <a href="{{ route('register.account') }}" class="text-[#EC46A4] hover:text-[#d63f93] font-medium">Daftar Sekarang</a>
        </div>
    </div>
</div>
@endsection
