<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informatics Coding Competition 2026</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #f0f4f8 100%);
            min-height: 100vh;
        }

        /* FLOATING NAVBAR */
        nav {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 92%;
            background: white;
            padding: 16px 28px;
            border-radius: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            z-index: 50;
        }

        nav img {
            height: 36px;
        }

        nav a {
            margin-left: 20px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            padding: 10px 18px;
            border-radius: 10px;
            transition: 0.25s;
        }

        .btn-register {
            background: linear-gradient(135deg, #E91E8C, #D946A6);
            color: white;
            box-shadow: 0 4px 12px rgba(233,30,140,0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(233,30,140,0.45);
        }

        /* HERO SECTION */
        .hero {
            padding-top: 150px;
            padding-bottom: 60px;
            text-align: center;
        }

        .hero-card {
            max-width: 720px;
            margin: 0 auto;
            background: white;
            padding: 50px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(233, 30, 140, 0.08);
            animation: fadeIn 0.6s ease;
        }

        .hero-card h2 {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .hero-card p {
            color: #555;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #E91E8C 0%, #D946A6 100%);
            color: white;
            padding: 14px 28px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 10px;
            text-decoration: none;
            transition: 0.3s ease;
            box-shadow: 0 4px 12px rgba(233, 30, 140, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(233,30,140,0.45);
        }

        /* CARD LOMBA */
        .info-section {
            margin-top: 40px;
            text-align: center;
        }

        .info-title {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .info-container {
            max-width: 950px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .info-card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.06);
            transition: 0.25s;
            cursor: pointer;
        }

        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(0,0,0,0.12);
        }

        .info-card h3 {
            margin-bottom: 8px;
            font-size: 20px;
            font-weight: 700;
            color: #D946A6;
        }

        .info-card p {
            color: #555;
            font-size: 15px;
            line-height: 1.5;
        }

        /* MODAL */
        .modal-bg {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(4px);
            justify-content: center;
            align-items: center;
            z-index: 100;
        }

        .modal {
            background: white;
            padding: 30px;
            border-radius: 16px;
            max-width: 500px;
            width: 90%;
            animation: fadeIn 0.3s;
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
        }

        .modal-close {
            float: right;
            cursor: pointer;
            font-weight: bold;
            font-size: 20px;
        }

        /* FOOTER */
        footer {
            margin-top: 80px;
            background: #1a1a1a;
            color: #ddd;
            padding: 40px 20px;
            text-align: center;
            font-size: 15px;
            letter-spacing: 0.3px;
        }

        footer a {
            color: #E91E8C;
            text-decoration: none;
            font-weight: 600;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div style="display:flex;align-items:center;gap:12px;">
            <img src="{{ asset('image/logo-icc.png') }}" alt="Logo">
            {{-- <span style="font-weight:700;font-size:18px;color:#333;">2026</span> --}}
        </div>

        <div>
            <a href="{{ route('team.register') }}" class="btn-register">Register</a>
        </div>
    </nav>


    <!-- HERO -->
    <section class="hero">
        <div class="hero-card">
            <h2>Selamat Datang!</h2>
            <p>
                Daftarkan timmu untuk mengikuti <strong>Informatics Coding Competition 2026</strong>!
                Kompetisi terbuka untuk kategori <strong>Basis Data</strong> dan <strong>Pemrograman Terstruktur</strong>.
            </p>
            <a href="{{ route('team.register') }}" class="btn-primary">Daftar Sekarang</a>
        </div>

        <!-- INFO CARD SECTION -->
        <div class="info-section">
            <h3 class="info-title">Informasi Perlombaan</h3>

            <div class="info-container">
                <div class="info-card" onclick="openModal('kategori')">
                    <h3>Kategori Lomba</h3>
                    <p>Basis Data dan Pemrograman Terstruktur untuk mahasiswa aktif.</p>
                </div>
                <div class="info-card" onclick="openModal('hadiah')">
                    <h3>Hadiah</h3>
                    <p>Uang pembinaan, sertifikat resmi, dan merchandise eksklusif ICC.</p>
                </div>
                <div class="info-card" onclick="openModal('jadwal')">
                    <h3>Jadwal</h3>
                    <p>Pendaftaran, technical meeting, dan hari kompetisi.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- MODALS -->
    <div id="modal-kategori" class="modal-bg">
        <div class="modal">
            <span class="modal-close" onclick="closeModal('kategori')">&times;</span>
            <h2>Kategori Lomba</h2>
            <p>
                • Basis Data
                • Pemrograman Terstruktur
                <br><br>
                Kedua kategori dapat diikuti oleh mahasiswa aktif dalam 1 tim beranggotakan 2–3 orang.
            </p>
        </div>
    </div>

    <div id="modal-hadiah" class="modal-bg">
        <div class="modal">
            <span class="modal-close" onclick="closeModal('hadiah')">&times;</span>
            <h2>Hadiah Lomba</h2>
            <p>
                • Juara 1 – Sertifikat + Trophy + Rp 1.500.000
                • Juara 2 – Sertifikat + Trophy + Rp 1.000.000
                • Juara 3 – Sertifikat + Trophy + Rp 500.000
                <br><br>
                Semua peserta mendapatkan e-certificate.
            </p>
        </div>
    </div>

    <div id="modal-jadwal" class="modal-bg">
        <div class="modal">
            <span class="modal-close" onclick="closeModal('jadwal')">&times;</span>
            <h2>Jadwal Perlombaan</h2>
            <p>
                • Pendaftaran: 12 Jan – 20 Feb 2026
                • Technical Meeting: 25 Feb 2026
                • Hari H Lomba: 1 Maret 2026
            </p>
        </div>
    </div>


    <script>
        function openModal(id) {
            document.getElementById("modal-" + id).style.display = "flex";
        }
        function closeModal(id) {
            document.getElementById("modal-" + id).style.display = "none";
        }
    </script>


    <!-- FOOTER -->
    <footer>
        &copy; 2026 Informatics Coding Competition •
        Made with ❤️ by <a href="#">ICC Team Association</a>
    </footer>

</body>
</html>
