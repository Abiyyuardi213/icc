<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Tim - ICC 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen py-10 px-4">

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-blue-600 p-6 text-white text-center">
            <h1 class="text-2xl font-bold">Edit Data Tim</h1>
            <p class="opacity-90">{{ $team->name }}</p>
        </div>

        <form action="{{ route('participants.update') }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Info Lomba (Readonly) -->
            <div class="mb-6 bg-gray-50 p-4 rounded border">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori Lomba</label>
                <div class="font-medium text-blue-600">{{ $team->event->name }}</div>
            </div>

            <!-- Nama Tim -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Tim</label>
                <input type="text" name="team_name" value="{{ old('team_name', $team->name) }}" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <hr class="my-8 border-gray-200">

            <!-- Ketua -->
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-l-4 border-blue-600 pl-3">Data Ketua</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Nama Lengkap</label>
                    <input type="text" name="leader_name" value="{{ old('leader_name', $team->leader->name) }}" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">NPM</label>
                    <input type="text" name="leader_npm" value="{{ old('leader_npm', $team->leader->npm) }}" class="w-full px-4 py-2 border rounded">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-600 mb-1">No. WhatsApp</label>
                    <input type="text" name="leader_phone" value="{{ old('leader_phone', $team->leader->phone) }}" class="w-full px-4 py-2 border rounded">
                </div>
            </div>

            <hr class="my-8 border-gray-200">

            <!-- Member 1 -->
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-l-4 border-blue-600 pl-3">Member 1</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                 <div>
                    <label class="block text-sm text-gray-600 mb-1">Nama Lengkap</label>
                    <input type="text" name="member_1_name" value="{{ old('member_1_name', $team->member1->name) }}" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">NPM</label>
                    <input type="text" name="member_1_npm" value="{{ old('member_1_npm', $team->member1->npm) }}" class="w-full px-4 py-2 border rounded">
                </div>
            </div>

            <!-- Member 2 -->
             <h3 class="text-lg font-bold text-gray-800 mb-4 border-l-4 border-blue-600 pl-3">Member 2 (Opsional)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                 <div>
                    <label class="block text-sm text-gray-600 mb-1">Nama Lengkap</label>
                    <input type="text" name="member_2_name" value="{{ old('member_2_name', $team->member2?->name) }}" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">NPM</label>
                    <input type="text" name="member_2_npm" value="{{ old('member_2_npm', $team->member2?->npm) }}" class="w-full px-4 py-2 border rounded">
                </div>
            </div>

            <div class="flex gap-4 mt-8">
                <a href="{{ route('home') }}" class="w-1/3 py-3 text-center border border-gray-300 rounded text-gray-600 font-semibold hover:bg-gray-50 transition">Batal</a>
                <button type="submit" class="w-2/3 py-3 bg-blue-600 text-white rounded font-bold hover:bg-blue-700 transition shadow-lg">Simpan Perubahan</button>
            </div>

        </form>
    </div>

</body>
</html>
