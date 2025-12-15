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
            <h1 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h1>
            <p class="text-gray-500 text-sm mt-1">Bergabunglah untuk mengikuti kompetisi</p>
        </div>

        <form action="{{ route('register.account') }}" method="POST" class="space-y-5">
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
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" required autocomplete="name" autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition"
                    value="{{ old('name') }}">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" id="email" required autocomplete="email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition"
                    value="{{ old('email') }}">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-[#EC46A4] outline-none transition">
            </div>

            <button type="submit"
                class="w-full bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold py-2.5 rounded-lg transition duration-200 shadow-md transform hover:-translate-y-0.5">
                Daftar
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-[#EC46A4] hover:text-[#d63f93] font-medium">Masuk Disini</a>
        </div>
    </div>
</div>
@endsection
