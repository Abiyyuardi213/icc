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
                <input type="email" name="email" id="email" required autocomplete="email" autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition"
                    value="{{ old('email') }}">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password" required autocomplete="current-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition">
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
