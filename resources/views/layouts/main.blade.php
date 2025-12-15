<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Informatics Events')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CSS is embedded for now as requested to match the theme -->
    <style>
        /* =========================================
           1. VARIABLES & RESET (Dasar)
           ========================================= */
        :root {
            --primary-color: #EC46A4; /* Pink Utama */
            --primary-hover: #d63f93; /* Pink Gelap (Hover) */
            --text-color: #374151; /* Abu-abu Gelap */
            --text-light: #6b7280; /* Abu-abu Sedang */
            --bg-white: #ffffff;
            --border-color: #e5e7eb;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --bg-gray: #f9fafb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-gray);
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
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 1rem 1.5rem;
            box-shadow: var(--shadow);
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
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
            font-size: 0.95rem;
            transition: color 0.3s;
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
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(236, 70, 164, 0.3);
            transition: all 0.2s;
            display: inline-block;
        }

        .btn-register:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .hamburger {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-color);
            padding: 0.5rem;
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
            font-weight: 500;
            padding: 0.5rem 0;
        }

        .mobile-menu a:hover {
            color: var(--primary-color);
        }

        .btn-register.full-width {
            text-align: center;
            width: 100%;
        }

        .desktop-only { display: none; }
        .mobile-only { display: block; }
        @media (min-width: 768px) {
            .desktop-only { display: flex; }
            .nav-btn.desktop-only { display: block; }
            .mobile-only { display: none; }
            .mobile-menu { display: none !important; }
        }

        /* =========================================
           3. FOOTER STYLES
           ========================================= */
        .footer {
            background-color: var(--bg-white);
            border-top: 1px solid var(--border-color);
            margin-top: auto;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }

        @media (min-width: 768px) {
            .footer-grid {
                grid-template-columns: 1.5fr 1fr 1fr 1fr;
            }
        }

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

        .fw-medium { font-weight: 600; color: var(--text-color); }
        .mt-3 { margin-top: 1rem; }

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
            }
        }

        /* --- CONTENT WRAPPER --- */
        .main-content {
            margin-top: 80px; /* Adjust based on navbar height */
            padding-bottom: 4rem;
            min-height: 80vh;
        }
    </style>
    <!-- Add Google Fonts or other resources if needed -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('styles')
</head>
<body>

    @include('include.navbar')

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer" id="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-col">
                    <!-- Check logo path -->
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
                <p>&copy; {{ date('Y') }} HMIF ITATS. All rights reserved.</p>
                <p>Designed with ❤️ by HMIF Dev Team</p>
            </div>
        </div>
    </footer>

    <script>
        // Simple JS for Mobile Menu Toggle
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if(menuBtn && mobileMenu){
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('open');
                mobileMenu.classList.toggle('hidden'); // Logic consistency
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
