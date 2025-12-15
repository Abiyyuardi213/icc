<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ICC 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

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
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    value="{{ old('email') }}">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password" required autocomplete="current-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition duration-200">
                Masuk
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? 
            <a href="{{ route('register.account') }}" class="text-blue-600 hover:text-blue-800 font-medium">Daftar Sekarang</a>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-600 text-sm">← Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>
