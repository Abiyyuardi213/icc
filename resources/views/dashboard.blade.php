<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Informatics Coding Competition 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white flex justify-between items-center">
        <h1 class="text-xl font-bold">Dashboard</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </nav>

    <div class="flex-grow p-6">
        <h2 class="text-2xl font-bold mb-4">Halo, {{ auth()->user()->name }}!</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(auth()->user()->participant)
            <!-- Jika tim sudah diisi -->
            <div class="bg-white p-6 rounded shadow mb-4">
                <h3 class="text-xl font-semibold mb-2">Data Tim Anda</h3>
                <p><strong>Ketua Tim:</strong> {{ auth()->user()->participant->leader_name }} ({{ auth()->user()->participant->leader_npm }})</p>
                <p><strong>No. HP Ketua:</strong> {{ auth()->user()->participant->leader_phone }}</p>
                <p><strong>Anggota 1:</strong> {{ auth()->user()->participant->member1_name }} ({{ auth()->user()->participant->member1_npm }})</p>
                <p><strong>Anggota 2:</strong> {{ auth()->user()->participant->member2_name }} ({{ auth()->user()->participant->member2_npm }})</p>
                <p><strong>Kategori:</strong> {{ ucfirst(str_replace('_',' ', auth()->user()->participant->category)) }}</p>
                <a href="{{ route('participants.edit', auth()->user()->participant->id) }}"
                   class="inline-block mt-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                    Edit Data Tim
                </a>
            </div>
        @else
            <!-- Jika tim belum diisi -->
            <div class="bg-white p-6 rounded shadow text-center">
                <p class="mb-4">Anda belum mengisi data tim.</p>
                <a href="{{ route('participants.create') }}"
                   class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition">
                    Isi Data Tim Sekarang
                </a>
            </div>
        @endif
    </div>

    <footer class="bg-gray-800 text-white p-4 text-center">
        &copy; 2026 Informatics Coding Competition. All rights reserved.
    </footer>

</body>
</html>
