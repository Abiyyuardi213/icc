<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informatics Coding Competition 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white flex justify-between items-center">
        <h1 class="text-xl font-bold">Informatics Coding Competition 2026</h1>
        <div>
            <a href="{{ route('login') }}" class="mr-4 hover:underline">Login</a>
            <a href="{{ route('register') }}" class="hover:underline">Register</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="flex-grow flex flex-col justify-center items-center text-center px-4">
        <h2 class="text-4xl font-bold mb-4">Selamat Datang!</h2>
        <p class="text-lg mb-6">Daftarkan timmu sekarang untuk mengikuti Informatics Coding Competition 2026.
        Setiap tim terdiri dari 3 anggota, lomba gratis, dan terbuka untuk kategori Basis Data dan Pemrograman Terstruktur.</p>
        <div>
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Daftar Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center">
        &copy; 2026 Informatics Coding Competition. All rights reserved.
    </footer>

</body>
</html>
