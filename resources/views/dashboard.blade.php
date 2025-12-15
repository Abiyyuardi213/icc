<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Informatics Coding Competition 2026</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root{--primary-color:#EC46A4;--text-color:#374151;--bg-white:#ffffff}
        body{font-family:Inter,system-ui,-apple-system, sans-serif;background:#f8fafc;color:var(--text-color)}
        .dashboard-layout{display:flex;gap:24px;max-width:1200px;margin:80px auto;padding:20px}
        .sidebar{width:260px;background:var(--bg-white);border-radius:12px;padding:18px;box-shadow:0 6px 18px rgba(0,0,0,0.06)}
        .sidebar h3{font-size:1rem;font-weight:700;margin-bottom:12px;color:var(--primary-color)}
        .sidebar a{display:block;padding:10px 12px;border-radius:8px;color:var(--text-color);text-decoration:none;margin-bottom:6px}
        .sidebar a.active{background:linear-gradient(90deg,var(--primary-color),#d63384);color:#fff}
        .main{flex:1}
        .card{background:var(--bg-white);padding:20px;border-radius:12px;box-shadow:0 6px 18px rgba(0,0,0,0.06)}
        .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;margin-top:16px}
        @media (max-width:768px){.dashboard-layout{flex-direction:column;margin:120px 12px 24px}}
    </style>
</head>
<body>

    @include('include.navbar')

    <main class="dashboard-layout">
        <aside class="sidebar">
            <h3>Menu</h3>
            <a href="{{ route('dashboard') }}" class="active">Overview</a>
            @if(auth()->check() && auth()->user()->participant)
                <a href="{{ route('participants.edit', auth()->user()->participant->id) }}">Edit Data Tim</a>
            @else
                <a href="{{ route('participants.create') }}">Isi Data Tim</a>
            @endif
            <a href="{{ route('event.list') }}">Lihat Event</a>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:8px;">
                @csrf
                <button type="submit" class="btn-register" style="width:100%;">Logout</button>
            </form>
        </aside>

        <section class="main">
            <div class="card">
                <h2 style="font-size:1.25rem;font-weight:700">Halo, {{ auth()->user()->name }}!</h2>
                @if(session('success'))
                    <div style="margin-top:12px;background:#ecfdf5;color:#065f46;padding:12px;border-radius:8px">{{ session('success') }}</div>
                @endif

                <p style="margin-top:12px;color:#6b7280">Ringkasan akun dan status pendaftaran tim Anda.</p>

                @if(auth()->user()->participant)
                    <div class="grid" style="margin-top:16px">
                        <div class="card">
                            <h4 style="font-weight:700;margin-bottom:8px">Nama Ketua</h4>
                            <p>{{ auth()->user()->participant->leader_name }} ({{ auth()->user()->participant->leader_npm }})</p>
                        </div>
                        <div class="card">
                            <h4 style="font-weight:700;margin-bottom:8px">No. HP Ketua</h4>
                            <p>{{ auth()->user()->participant->leader_phone }}</p>
                        </div>
                        <div class="card">
                            <h4 style="font-weight:700;margin-bottom:8px">Kategori</h4>
                            <p>{{ ucfirst(str_replace('_',' ', auth()->user()->participant->category)) }}</p>
                        </div>
                    </div>
                    <div style="margin-top:16px">
                        <a href="{{ route('participants.edit', auth()->user()->participant->id) }}" class="btn-register">Edit Data Tim</a>
                    </div>
                @else
                    <div style="margin-top:16px" class="card">
                        <p>Anda belum mengisi data tim.</p>
                        <a href="{{ route('participants.create') }}" class="btn-register" style="margin-top:12px;display:inline-block">Isi Data Tim Sekarang</a>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <footer style="text-align:center;padding:18px;color:#94a3b8">&copy; 2026 Informatics Coding Competition. All rights reserved.</footer>

</body>
</html>
