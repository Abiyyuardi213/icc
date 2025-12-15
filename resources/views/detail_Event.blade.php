<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event - ICC 2026</title>

    <style>
        /* --- RESET & VARIABLES --- */
        :root {
            --primary-color: #EC46A4;
            /* Pink Utama */
            --primary-hover: #d63f93;
            --text-color: #374151;
            /* Abu-abu gelap */
            --text-light: #6b7280;
            /* Abu-abu sedang */
            --bg-white: #ffffff;
            --bg-gray: #f9fafb;
            --border-color: #e5e7eb;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg-white);
            color: var(--text-color);
            line-height: 1.6;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 100px;
            /* Agar scroll tidak ketutup navbar */
        }

        /* --- NAVBAR STYLES (Sesuai Request) --- */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;

            /* Background Blur Effect */
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
            height: 40px;
            /* Disesuaikan agar proporsional */
            display: block;
        }

        /* Links Desktop */
        .nav-links {
            display: flex;
            gap: 2.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--primary-color);
        }

        /* Button Register Desktop */
        .btn-register {
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 0.6rem 1.25rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(236, 70, 164, 0.35);
            transition: all 0.2s;
            display: inline-block;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            background-color: var(--primary-hover);
        }

        /* Hamburger */
        .hamburger {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-color);
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
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

        .mobile-menu a:hover {
            color: var(--primary-color);
        }

        .btn-register.full-width {
            text-align: center;
            width: 100%;
            margin-top: 0.5rem;
        }

        /* --- RESPONSIVE LOGIC NAVBAR --- */
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


        /* --- MAIN CONTENT (DETAIL EVENT) --- */
        .main-content {
            margin-top: 90px;
            /* Kompensasi navbar fixed */
            padding: 0 1.5rem 3rem 1.5rem;
        }

        .event-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .event-top-section {
    display: flex; /* Kunci agar berdampingan */
    gap: 2.5rem;   /* Jarak antara gambar dan teks */
    align-items: flex-start; /* Agar teks mulai dari atas, sejajar dengan atas gambar */
    margin-bottom: 2rem;
}
        /* Poster Image */
        .event-poster {
    flex: 0 0 350px; /* Kunci lebar poster agar tetap 350px, tidak mengecil/membesar */
    max-width: 350px;
}

.event-poster img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    display: block;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1); /* Opsional: tambah bayangan agar cantik */
}

        /* Header Section */
        .event-header {
    flex: 1; /* Mengambil sisa ruang kosong di sebelah kanan */
    padding-top: 0.5rem; /* Sedikit padding atas agar sejajar visual dengan gambar */
}
@media (max-width: 768px) {
    .event-top-section {
        flex-direction: column; /* Jadi tumpuk lagi */
    }

    .event-poster {
        flex: none;
        width: 100%;
        max-width: 100%; /* Poster jadi lebar penuh di HP */
    }
}
        /* Body Content */
        .event-body h3 {
            font-size: 1.125rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #111827;
        }

        .event-body h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #374151;
        }

        .event-body p,
        .event-body li {
            font-size: 0.95rem;
            color: #4b5563;
            margin-bottom: 0.75rem;
        }

        .event-body ul,
        .event-body ol {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .event-body ul.no-bullet {
            list-style: none;
            margin-left: 0;
        }

        .event-body ul.nested-list {
            margin-top: 0.5rem;
        }

        .link-highlight {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            word-break: break-all;
        }

        .link-highlight:hover {
            text-decoration: underline;
        }

        .pink-text {
            color: var(--primary-color);
        }

        .closing-text {
            margin-top: 2rem;
            font-weight: 500;
            color: #111827;
        }

        /* CTA Bottom Area */
        .cta-container {
            margin-top: 2.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-cta-large {
            flex: 1;
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 1rem;
            border-radius: 99px;
            /* Rounded pill shape */
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 10px 15px -3px rgba(236, 70, 164, 0.4);
            transition: transform 0.2s;
        }

        .btn-cta-large:hover {
            transform: scale(1.02);
            background-color: var(--primary-hover);
        }

        .btn-notif {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            border: 1px solid var(--primary-color);
            background: white;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-notif:hover {
            background-color: #fff0f7;
        }
        
        /* Badges for Event Detail */
        /* .badge-lomba {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            border: 1px solid;
            color: #EC46A4;
            border-color: #EC46A4;
            background-color: #fff0f7;
        }
        
        .event-title {
            font-size: 1.5rem;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 0.5rem;
            color: #111827;
        }
        
        .event-meta {
            font-size: 0.9rem;
            color: #6b7280;
        }
        
        .fw-bold {
            font-weight: 700;
            color: #374151;
        } */


        /* --- FOOTER STYLES (Native CSS from Tailwind) --- */
        .footer {
            background-color: white;
            border-top: 1px solid var(--border-color);
            margin-top: 3rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
        }

        /* Grid Layout Footer */
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            /* Mobile: 1 kolom */
            gap: 3rem;
        }

        @media (min-width: 768px) {
            .footer-grid {
                grid-template-columns: repeat(4, 1fr);
                /* Desktop: 4 kolom */
            }
        }

        .footer-col {
            display: flex;
            flex-direction: column;
        }

        .footer-logo {
            width: 6rem;
            /* w-24 */
            height: auto;
            margin-bottom: 1rem;
        }

        .footer-title {
            font-size: 0.875rem;
            /* text-sm */
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: black;
        }

        .footer-text {
            font-size: 0.75rem;
            /* text-xs */
            color: #4b5563;
            /* gray-600 */
            line-height: 1.6;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            text-decoration: none;
            color: #4b5563;
            font-size: 0.75rem;
            /* text-xs */
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: #111827;
        }

        .fw-medium {
            font-weight: 500;
        }

        .mt-3 {
            margin-top: 0.75rem;
        }

        /* Footer Bottom */
        .footer-bottom {
            border-top: 1px solid var(--border-color);
            background-color: white;
        }

        .footer-bottom-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #4b5563;
        }

        @media (min-width: 768px) {
            .footer-bottom-content {
                flex-direction: row;
            }
        }

        .tokens-text {
            margin-top: 0.5rem;
        }

        @media (min-width: 768px) {
            .tokens-text {
                margin-top: 0;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="container-navbar">
            <div class="logo">
                <img src="{{ asset('image/logo1.png') }}" alt="Informatics Events">
            </div>

            <div class="nav-links desktop-only">
                <a href="{{ url('/home') }}" >Beranda</a>
                <a href="{{ route('event.list') }}">Event</a>
                <a href="{{ url('/home#about') }}">About</a>
                <a href="#footer">Contact</a>
            </div>

            <div class="nav-btn desktop-only">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-register">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-register" style="background:transparent; color: var(--text-color); box-shadow:none;">Login</a>
                    <a href="{{ route('register.account') }}" class="btn-register">Register</a>
                @endauth
            </div>

            <button id="menuBtn" class="hamburger mobile-only" aria-label="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div id="mobileMenu" class="mobile-menu">
            <a href="{{ url('/home') }}" class="active">Beranda</a>
            <a href="{{ route('event.list') }}">Event</a>
            <a href="{{ url('/home#about') }}">About</a>
            <a href="#footer">Contact</a>
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-register full-width">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register.account') }}" class="btn-register full-width">Daftar Akun</a>
            @endauth
        </div>
    </nav>

    <main class="main-content">
        <div class="event-container">
            <div class="event-top-section">

                <div class="event-poster">
                    <img src="{{ asset('image/poster1.png') }}" alt="{{ $event->name }}">
                </div>

                <div class="event-header">
                    <span class="badge-lomba">Lomba</span>
                    <h1 class="event-title">{{ $event->name }}</h1>
                    <p class="event-meta">Terbuka Hingga : <span class="fw-bold">
                        {{ $event->registration_end ? $event->registration_end->format('d-m-Y') : '-' }}
                    </span></p>
                </div>

            </div>

            <div class="event-body">
                <h3>Deskripsi</h3>
                <p>{!! $event->description !!}</p>

                @if($event->max_members > 1)
                <h3>Ketentuan Tim:</h3>
                <ul>
                    <li>Maksimal anggota: {{ $event->max_members }} orang</li>
                </ul>
                @endif

                <h3>Jadwal Pelaksanaan:</h3>
                <ul>
                    <li><strong>Pendaftaran:</strong> {{ $event->registration_start ? $event->registration_start->format('d M Y') : '-' }} s/d {{ $event->registration_end ? $event->registration_end->format('d M Y') : '-' }}</li>
                    <li><strong>Pelaksanaan Event:</strong> {{ $event->event_start ? $event->event_start->format('d M Y') : '-' }} s/d {{ $event->event_end ? $event->event_end->format('d M Y') : '-' }}</li>
                </ul>

                <h3>Ketentuan Peserta:</h3>
                <ol>
                    <li>Status Peserta: Wajib mahasiswa aktif ITATS angkatan 2024 atau 2025.</li>
                    <li>Komposisi Tim: Setiap tim wajib terdiri dari tiga (3) orang anggota.</li>
                    <li>Biaya Pendaftaran: GRATIS! (Free Registration)</li>
                </ol>

                <h3>Hadiah & Benefit:</h3>
                <ul class="no-bullet">
                    <li>Total Pool Prize: 2 JUTA RUPIAH</li>
                    <li>• Uang Pembinaan</li>
                    <li>• Plakat & Sertifikat Resmi</li>
                    <li>• Pengalaman kompetisi yang berharga</li>
                </ul>

                <h3>Cara Daftar:</h3>
                <p>Langsung kunjungi link berikut untuk mendaftarkan timmu:<br>
                    <a href="{{ route('team.register', ['event_id' => $event->id]) }}" class="link-highlight">🔗
                        Daftar Di sini</a>
                </p>

                <h3>Contact Person (CP):</h3>
                <ul class="no-bullet">
                    <li>📞 Basis Data: 0813-3182-8851 (Brilian)</li>
                    <li>📞 Basprog: 0851-7332-9189 (Indra)</li>
                </ul>

                <p class="supported-by">Didukung oleh: <span class="pink-text">@hmif_itats</span> | <span
                        class="pink-text">@lbp.itats</span> | <span class="pink-text">@lab.rplitats</span></p>

                <p class="closing-text">Jangan sampai ketinggalan! Siapkan tim terbaikmu, asah logikamu, dan jadilah
                    juara di ICC 2026! 🚀</p>

                <div class="cta-container">
                    <a href="{{ route('team.register', ['event_id' => $event->id]) }}" class="btn-cta-large">Daftar Sekarang</a>
                    <button class="btn-notif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                </div>
            </div>
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

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });
    </script>
</body>

</html>
