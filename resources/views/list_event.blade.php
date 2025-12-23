<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Event - Informatics Events</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* =========================================
   1. VARIABLES & RESET (Dasar)
   ========================================= */
        :root {
            --primary-color: #EC46A4;
            /* Pink Utama */
            --primary-hover: #d63f93;
            /* Pink Gelap (Hover) */
            --text-color: #374151;
            /* Abu-abu Gelap */
            --text-light: #6b7280;
            /* Abu-abu Sedang */
            --bg-white: #ffffff;
            --border-color: #e5e7eb;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
            /* Ganti font sesuai selera */
        }

        body {
            background-color: #f9fafb;
            color: var(--text-color);
        }

        /* =========================================
   2. NAVBAR STYLES (Glassmorphism)
   ========================================= */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 1rem 1.5rem;
            box-shadow: var(--shadow);
            z-index: 1000;
        }

        .container-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo img {
            height: 50px;
            display: block;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: color 0.3s;
            font-size: 1rem;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--primary-color);
        }

        .btn-register {
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(236, 70, 164, 0.35);
            transition: transform 0.2s, background-color 0.2s;
            display: inline-block;
        }

        .btn-register:hover {
            transform: scale(1.05);
        }

        .hamburger {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-color);
        }

        .mobile-menu {
            display: none;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f3f4f6;
        }

        .mobile-menu.open {
            display: flex;
        }

        .mobile-menu a {
            text-decoration: none;
            color: var(--text-color);
            padding: 0.5rem 0;
            font-weight: 500;
        }

        .mobile-menu a:hover,
        .mobile-menu a.active {
            color: var(--primary-color);
        }

        .btn-register.full-width {
            text-align: center;
            width: 100%;
            margin-top: 0.5rem;
            color: white
        }

        .desktop-only {
            display: none;
        }

        .mobile-only {
            display: block;
        }

        @media (min-width: 768px) {
            .desktop-only {
                display: flex;
            }

            .nav-btn.desktop-only {
                display: block;
            }

            .mobile-only {
                display: none;
            }

            .mobile-menu {
                display: none !important;
            }
        }


        /* =========================================
   3. FOOTER STYLES
   ========================================= */
        .footer {
            background-color: var(--bg-white);
            border-top: 1px solid var(--border-color);
            margin-top: auto;
            /* Agar footer terdorong ke bawah jika konten sedikit */
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
        }

        /* Grid Layout 4 Kolom */
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            /* Mobile: 1 kolom */
            gap: 2.5rem;
        }

        @media (min-width: 768px) {
            .footer-grid {
                grid-template-columns: 1.5fr 1fr 1fr 1fr;
                /* Desktop: 4 kolom (Kolom 1 lebih lebar) */
            }
        }

        /* Kolom Footer */
        .footer-col {
            display: flex;
            flex-direction: column;
        }

        .footer-logo {
            width: 100px;
            margin-bottom: 1rem;
        }

        .footer-title {
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #111827;
            /* Hitam pekat */
        }

        .footer-text {
            font-size: 0.85rem;
            color: var(--text-light);
            line-height: 1.6;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.6rem;
        }

        .footer-links a {
            text-decoration: none;
            color: var(--text-light);
            font-size: 0.85rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        .fw-medium {
            font-weight: 600;
            color: var(--text-color);
        }

        .mt-3 {
            margin-top: 1rem;
        }

        /* Footer Bagian Bawah (Copyright) */
        .footer-bottom {
            border-top: 1px solid var(--border-color);
            background-color: #fff;
        }

        .footer-bottom-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            font-size: 0.75rem;
            color: var(--text-light);
            gap: 0.5rem;
        }

        @media (min-width: 768px) {
            .footer-bottom-content {
                flex-direction: row;
                /* Sejajar kiri-kanan di desktop */
            }
        }

        /* --- RESET & VARIABLES (Gunakan yang sudah ada) --- */
        :root {
            --primary-color: #EC46A4;
            --bg-gray: #f9fafb;
            --text-color: #374151;
            --text-light: #6b7280;
        }

        /* --- MAIN LAYOUT LIST --- */
        .main-content-list {
            margin-top: 100px;
            /* Jarak dari navbar fixed */
            padding-bottom: 4rem;
            min-height: 80vh;
            background-color: #fff;
            /* Atau var(--bg-gray) sesuai selera */
        }

        /* --- SECTION SEARCH & FILTER --- */
        .container-search {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            margin-bottom: 2rem;
        }

        /* Search Bar Wrapper */
        .search-wrapper {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .search-input {
            flex: 1;
            /* Input memanjang memenuhi ruang */
            padding: 0.85rem 1.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            /* Sudut agak kotak tapi tumpul */
            font-size: 0.95rem;
            color: var(--text-color);
            outline: none;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            border-color: var(--primary-color);
        }

        .btn-search {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0 1.5rem;
            border-radius: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.2s;
        }

        .btn-search:hover {
            background-color: #d63f93;
        }

        /* Filter Dropdown (Urut Berdasarkan) */
        .filter-wrapper {
            display: flex;
            justify-content: flex-end;
            /* Posisi di kanan */
            align-items: center;
            gap: 0.75rem;
        }

        .filter-label {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .filter-select {
            padding: 0.4rem 2rem 0.4rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 99px;
            /* Pill shape */
            background-color: white;
            color: var(--text-color);
            font-size: 0.85rem;
            cursor: pointer;
            outline: none;
        }


        /* --- GRID SYSTEM --- */
        .container-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: grid;
            /* Membuat 3 kolom sama lebar secara otomatis */
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            /* Jarak antar kartu */
        }


        /* --- EVENT CARD STYLING --- */
        .event-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #f3f4f6;
            display: flex;
            flex-direction: column;
            /* Agar footer selalu di bawah */
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(236, 70, 164, 0.15);
        }

        .card-image-link {
            display: block;
            width: 100%;
            overflow: hidden;
        }

        .card-image {
            width: 100%;
            height: 400px;
            /* Tinggi gambar disesuaikan agar mirip poster A4 */
            object-fit: cover;
            /* Agar gambar tidak gepeng */
            object-position: top;
            transition: transform 0.5s;
        }

        .event-card:hover .card-image {
            transform: scale(1.03);
            /* Zoom in halus saat hover */
        }

        .card-content {
            padding: 1.5rem;
            flex: 1;
            /* Mengisi sisa ruang */
            display: flex;
            flex-direction: column;
        }

        /* Badges Container */
        .card-badges {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
            flex-wrap: wrap;
        }

        /* Badges */
        .card-badge {
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 600;
            border: 1px solid;
        }

        .badge-lomba {
            color: #EC46A4;
            border-color: #EC46A4;
            background-color: #fff0f7;
        }

        .badge-sosialisasi {
            color: #F59E0B;
            /* Warna Amber/Kuning */
            border-color: #F59E0B;
            background-color: #fffbeb;
        }

        .badge-penjualan {
            color: #10B981;
            /* Warna Hijau */
            border-color: #10B981;
            background-color: #ecfdf5;
        }

        /* Badge NEW - Styling khusus untuk event baru */
        .badge-new {
            background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.4);
            border: none;
            animation: pulse-badge 2s ease-in-out infinite;
        }

        @keyframes pulse-badge {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 2px 8px rgba(255, 107, 107, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 3px 10px rgba(255, 107, 107, 0.6);
            }
        }

        .card-title {
            font-size: 1.1rem;
            line-height: 1.4;
            margin-bottom: 0.75rem;
            font-weight: 700;
            /* Membatasi teks maksimal 2 baris, sisanya ... */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-title a {
            text-decoration: none;
            color: var(--primary-color);
            transition: color 0.2s;
        }

        .card-description {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 1.5rem;
            line-height: 1.6;
            /* Membatasi teks maksimal 3 baris */
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex-grow: 1;
            /* Mendorong footer ke bawah */
        }

        /* Card Footer (Date & Days) */
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #f3f4f6;
        }

        .card-date {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .card-days {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-color);
        }


        /* --- RESPONSIVE MEDIA QUERIES --- */

        /* Tablet (2 Kolom) */
        @media (max-width: 1024px) {
            .container-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Mobile (1 Kolom) */
        @media (max-width: 640px) {
            .container-grid {
                grid-template-columns: 1fr;
            }

            .search-wrapper {
                flex-direction: column;
            }

            .btn-search {
                justify-content: center;
                padding: 0.75rem;
            }

            .filter-wrapper {
                justify-content: space-between;
                margin-top: 1rem;
            }
        }
    </style>
</head>

<body>

    @include('include.navbar')
    <main class="main-content-list">

        <div class="container-search">
            <form action="{{ route('event.list') }}" method="GET" class="w-full">
                <div class="search-wrapper">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Mau cari event apa hari ini ?" class="search-input">
                    <button type="submit" class="btn-search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cari Event
                    </button>
                </div>

                <div class="filter-wrapper">
                    <label for="sort" class="filter-label">Urut berdasarkan :</label>
                    <div class="select-container">
                        <select id="sort" name="sort" class="filter-select" onchange="this.form.submit()">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Event Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Event Terlama</option>
                            <option value="ending_soon" {{ request('sort') == 'ending_soon' ? 'selected' : '' }}>Segera Berakhir</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <div class="container-grid">

        @forelse($events as $event)
            <div class="event-card">
                @php
                    // Cek apakah event baru (dibuat dalam 7 hari terakhir)
                    $isNewEvent = $event->created_at && $event->created_at->diffInDays(now()) <= 7;
                @endphp

                <a href="{{ route('event.detail', $event->slug) }}" class="card-image-link">
                    @if($event->photo)
                        <img src="{{ asset('storage/' . $event->photo) }}" alt="{{ $event->name }}" class="card-image">
                    @else
                        <img src="{{ asset('image/poster1.png') }}" alt="{{ $event->name }}" class="card-image">
                    @endif
                </a>
                <div class="card-content">
                    <div class="card-badges">
                        <span class="card-badge badge-lomba">Event</span>
                        @if($isNewEvent)
                            <span class="card-badge badge-new">🔥 BARU</span>
                        @endif
                    </div>
                    <h3 class="card-title">
                        <a href="{{ route('event.detail', $event->slug) }}">
                            {{ $event->name }}
                        </a>
                    </h3>
                    <p class="card-description">{{ strip_tags($event->description) }}</p>

                    <div class="card-footer">
                        @php
                            $now = now();
                            $regStart = $event->registration_start;
                            $regEnd = $event->registration_end;
                            $eventStart = $event->event_start;

                            $statusText = '';
                            $statusColor = 'text-gray-500';

                            if ($now < $regStart) {
                                $diff = $now->diff($regStart);
                                $statusText = "Buka dalam " . $diff->days . " hari " . $diff->h . " jam";
                                $statusColor = 'text-blue-500';
                            } elseif ($now >= $regStart && $now <= $regEnd) {
                                $diff = $now->diff($regEnd);
                                $statusText = "Sisa waktu daftar: " . $diff->days . " hari";
                                $statusColor = 'text-green-500';
                            } elseif ($now > $regEnd && $now < $eventStart) {
                                $statusText = "Pendaftaran Ditutup";
                                $statusColor = 'text-red-500';
                            } else {
                                $statusText = "Event Telah Dimulai/Selesai";
                                $statusColor = 'text-gray-500';
                            }
                        @endphp

                        <span class="card-date">{{ $regEnd ? $regEnd->format('d-m-Y') : '-' }}</span>
                        <span class="card-days {{ $statusColor }}">
                            {{ $statusText }}
                        </span>
                    </div>

                    <!-- Optional: Button logic if needed directly on card, but usually details page handles it.
                         The user asked for text/status on list page. -->
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center p-10">
                <p>Belum ada event yang tersedia saat ini.</p>
            </div>
        @endforelse

        </div>
    </main>
    <footer class="footer" id="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-col">
                    <img src="{{ asset('image/hima.png') }}" alt="HMIF Logo" class="footer-logo">
                    <h2 class="footer-title">Tentang HMIF ITATS</h2>
                    <p class="footer-text">
                        Wadah kolaborasi dan pengembangan mahasiswa Informatika. Berkarya, berdampak, dan bertumbuh
                        bersama.
                    </p>
                </div>
                <div class="footer-col">
                    <h2 class="footer-title">Navigasi</h2>
                    <ul class="footer-links">
                        <li><a href="#">Struktur Organisasi</a></li>
                        <li><a href="#">Divisi</a></li>
                        <li><a href="#">Program Kerja</a></li>
                        <li><a href="#">Kegiatan</a></li>
                        <li><a href="#">Pengumuman & Berita</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h2 class="footer-title">Kontak</h2>
                    <p class="footer-text">
                        <span class="fw-medium">Email:</span> hmifitats1991@gmail.com
                    </p>
                    <p class="footer-text mt-3">
                        <span class="fw-medium">Alamat:</span> Jl. Arief Rahman Hakim No.100,<br>
                        Klampis Ngasem, Kec. Sukolilo, Surabaya,<br>
                        Jawa Timur 60117
                    </p>
                </div>
                <div class="footer-col">
                    <h2 class="footer-title">Ikuti Kami</h2>
                    <ul class="footer-links">
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">LinkedIn</a></li>
                        <li><a href="#">YouTube</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>© 2025 HMIF. Semua hak dilindungi.</p>
                <p class="tokens-text">
                    UI berbasis design tokens: primary biru, accent amber, netral yang bersih.
                </p>
            </div>
        </div>
    </footer>
    <script>
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('open');
            });
        }
    </script>

</body>

</html>
