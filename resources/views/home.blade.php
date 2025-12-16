<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Informatika</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #EC46A4;
            --text-color: #374151;
            --bg-white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: "Inter", sans-serif;
        }

        /* EVENT CARD */
        .sticky-nav {
            transition: all 0.3s ease;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
            margin-top: 50px;
        }

        .header h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .header p {
            color: #888;
            font-size: 1rem;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .event-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 24px rgba(236, 70, 164, 0.15);
        }

        .card-image {
            width: 100%;
            height: 350px;
            object-fit: cover;
            background-color: #f0f0f0;
        }

        .card-content {
            padding: 24px;
        }

        .card-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-bottom: 12px;
            border: 1px solid #ec46a4;
            color: #ec46a4;
            background-color: white;
        }

        .card-title {
            font-size: 1.25rem;
            color: #333;
            margin-bottom: 12px;
            font-weight: 600;
            line-height: 1.4;
            min-height: 60px;
        }

        .card-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 20px;
            min-height: 75px;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid #f0f0f0;
        }

        .card-date {
            color: #888;
            font-size: 0.85rem;
        }

        .card-days {
            color: #ec46a4;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .view-all-btn {
            display: block;
            width: fit-content;
            margin: 0 auto;
            padding: 5px 10px;
            background-color: white;
            color: #ec46a4;
            border: 2px solid #ec46a4;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .view-all-btn:hover {
            background-color: #ec46a4;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(236, 70, 164, 0.3);
        }

        .card-image-link {
            display: block;
            text-decoration: none;
        }

        .card-title a {
            text-decoration: none;
            color: inherit;
            transition: color 0.3s ease;
        }

        .card-title a:hover {
            color: #ec46a4;
        }

        @media (max-width: 768px) {
            .header {
                margin-top: 32px;
                margin-bottom: 32px;
                padding: 0 1rem;
                text-align: center;
            }

            .header h1 {
                font-size: 1.6rem;
                line-height: 1.3;
                margin-bottom: 0.5rem;
            }

            .header p {
                font-size: 0.9rem;
                line-height: 1.6;
            }

            .events-grid {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 0 1rem;
            }

            .event-card {
                border-radius: 14px;
            }

            .card-image {
                height: 220px;
            }

            .card-content {
                padding: 16px;
            }

            .card-badge {
                font-size: 0.65rem;
                margin-bottom: 8px;
            }

            .card-title {
                font-size: 1rem;
                line-height: 1.4;
                margin-bottom: 8px;
                min-height: auto;
            }

            .card-description {
                font-size: 0.85rem;
                line-height: 1.6;
                margin-bottom: 14px;
                min-height: auto;
            }

            .card-footer {
                padding-top: 12px;
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .card-date,
            .card-days {
                font-size: 0.8rem;
            }

            .view-all-btn {
                margin-top: 24px;
                padding: 8px 18px;
                font-size: 0.75rem;
            }
        }

        .card-container {
            display: flex;
            flex-direction: column;
            width: 99%;
            max-width: 1200px;
            background-color: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            margin: auto;
            padding-top: 50px;
        }

        @media (min-width: 1024px) {
            .card-container {
                flex-direction: row;
            }
        }

        .form-section {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .form-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
            margin-bottom: 0.75rem;
        }

        .required {
            color: #ef4444;
        }

        input,
        textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            outline: none;
            transition: all 0.2s;
        }

        input:focus,
        textarea:focus {
            border-color: transparent;
            box-shadow: 0 0 0 2px #ec46a4;
        }

        textarea {
            resize: none;
        }

        .button-wrapper {
            display: flex;
            justify-content: flex-end;
            padding-top: 0.5rem;
        }

        .submit-btn {
            padding: 0.5rem 4rem;
            border: none;
            border-radius: 9999px;
            background: linear-gradient(135deg, #ec46a4 0%, #d63384 100%);
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .image-section {
            flex: 1;
            position: relative;
            min-height: 400px;
            border-radius: 100px;
        }

        .image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        @media (max-width: 640px) {
            .card-container {
                width: 100%;
                border-radius: 16px;
                padding-top: 24px;
                box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
            }

            .form-section {
                padding: 1.5rem;
            }

            label {
                font-size: 0.8rem;
                margin-bottom: 0.5rem;
            }

            input,
            textarea {
                font-size: 0.85rem;
                padding: 0.65rem 0.9rem;
            }

            .form-group {
                margin-bottom: 1.25rem;
            }

            .button-wrapper {
                justify-content: center;
            }

            .submit-btn {
                width: 100%;
                padding: 0.75rem 0;
                font-size: 0.9rem;
            }

            .image-section {
                min-height: 220px;
                border-radius: 0;
            }

            .image-section img {
                border-radius: 0;
            }
        }

        .event-hero {
            width: 100%;
            background-color: #ffffff;
            padding: 64px 0;
        }

        .event-hero__container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .event-hero__photo-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .event-hero__photo {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .event-hero__photo img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            display: block;
        }

        .event-hero__photo--large {
            grid-column: span 2;
        }

        .event-hero__photo--large img {
            height: 256px;
        }

        .event-hero__title {
            font-size: 36px;
            font-weight: 700;
            color: #111827;
            line-height: 1.25;
        }

        .event-hero__description {
            margin-top: 16px;
            color: #4b5563;
            line-height: 1.7;
        }

        .event-hero__features {
            margin-top: 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .event-hero__feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #374151;
            font-weight: 500;
        }

        .event-hero__icon {
            padding: 12px;
            background-color: #EC46A4;
            color: #ffffff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .event-hero__btn {
            margin-top: 32px;
            padding: 8px 24px;
            border: 2px solid #EC46A4;
            background: transparent;
            color: #EC46A4;
            border-radius: 999px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .event-hero__btn:hover {
            background-color: #EC46A4;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .event-hero__container {
                grid-template-columns: 1fr;
            }
        }

        .event-search {
            width: 90%;
            background-color: #F8F9FA;
            padding: 24px;
            padding-top: 60px;
            border-radius: 32px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f3f5;
            margin: 0 auto;
        }

        .event-search__inner {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .event-search__input {
            flex-grow: 1;
            height: 48px;
            padding-left: 20px;
            padding-right: 16px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            color: #4b5563;
            font-size: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .event-search__input::placeholder {
            color: #9ca3af;
        }

        .event-search__input:focus {
            outline: none;
            border-color: transparent;
            box-shadow: 0 0 0 2px rgba(236, 70, 164, 0.2);
        }

        .event-search__button {
            height: 48px;
            padding: 0 40px;
            background-color: #EC46A4;
            color: #ffffff;
            font-weight: 500;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            line-height: 1;
            white-space: nowrap;
            box-shadow: 0 6px 14px rgba(236, 70, 164, 0.35);
            transition: background-color 0.3s ease;
        }

        .event-search__button:hover {
            background-color: #c53b95;
        }

        .event-search__icon {
            width: 20px;
            height: 20px;
        }

        @media (min-width: 768px) {
            .event-search__inner {
                flex-direction: row;
            }
        }

        .indicator {
            width: 8px;
            height: 8px;
            background-color: #d1d5db;
            /* gray-300 */
            border-radius: 9999px;
            transition: all 0.3s ease;
            cursor: pointer;
            z-index: 1000;
        }

        .indicator.active {
            width: 24px;
            background-color: #EC46A4;
        }

        #carousel {
            display: flex;
            width: 100%;
            transition: transform 0.7s ease;
        }

        .carousel-slide {
            flex: 0 0 100%;
            min-width: 100%;
            display: flex;
            justify-content: center;
        }

        .carousel-slide img {
            width: 95%;
            height: 500px;
            max-height: 520px;
            object-fit: cover;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .carousel-wrapper {
            overflow: hidden;
            width: 100%;
        }

        #indicators {
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            background: rgb(255, 255, 255);
            padding: 6px 12px;
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }

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

        .indicator.active {
            width: 24px;
            background-color: #EC46A4;
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

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-white">
    <!-- NAVBAR -->
    @include('include.navbar')

    <!-- HERO SLIDER -->
    <section class="pt-24 pb-14 text-center">
        <div class="w-full flex justify-center">
            <div class="relative w-[92%] overflow-hidden">
                <div class="carousel-wrapper">
                    <div id="carousel" class="carousel">
                        <div class="carousel-slide">
                            <img src="image/banner2.png" alt="">
                        </div>

                        <div class="carousel-slide">
                            <img src="image/banner6.png" alt="">
                        </div>

                        <div class="carousel-slide">
                            <img src="image/banner3.png" alt="">
                        </div>

                        <div class="carousel-slide">
                            <img src="image/banner1.png" alt="">
                        </div>
                    </div>
                </div>

                <!-- DOTS -->
                <div id="indicators"
                    class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 bg-white backdrop-blur-md px-6 py-3 rounded-full shadow">

                    <button class="indicator"></button>
                    <button class="indicator"></button>
                    <button class="indicator"></button>
                    <button class="indicator"></button>
                </div>


                <!-- Arrows -->
                <button id="prev"
                    class="absolute left-2 top-1/2 -translate-y-1/2 bg-white size-14 rounded-full shadow flex justify-center items-center text-xl z-1000">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="next"
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-white size-14 rounded-full shadow flex justify-center items-center text-xl z-1000">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- SEARCH BAR -->
        <div class="event-search">
            <div class="event-search__inner">
                <input type="text" placeholder="Mau cari event apa hari ini?" class="event-search__input">

                <button class="event-search__button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="event-search__icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    Cari Event
                </button>
            </div>
        </div>

    </section>
    {{-- ABOUT --}}
    <section class="event-hero" id="about">
        <div class="event-hero__container">

            <!-- LEFT: FOTO-FOTO -->
            <div class="event-hero__photo-grid">
                <div class="event-hero__photo event-hero__photo--large">
                    <img src="image/fake.jpg" alt="">
                </div>

                <div class="event-hero__photo">
                    <img src="image/futsal_23.jpg" alt="">
                </div>

                <div class="event-hero__photo">
                    <img src="image/ml.jpg" alt="">
                </div>
            </div>

            <!-- RIGHT: TEKS -->
            <div class="event-hero__content">
                <h1 class="event-hero__title">
                    Investasikan Waktumu untuk Pengalaman & Wawasan Baru.
                </h1>

                <p class="event-hero__description">
                    Dunia teknologi berkembang sangat cepat. Temukan workshop, seminar, dan
                    kompetisi coding untuk memperdalam skill-mu dan membangun portofolio yang diminati industri masa
                    kini.
                </p>

                <div class="event-hero__features">

                    <div class="event-hero__feature-item">
                        <div class="event-hero__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M13 2 L3 14 h7 l-1 8 10-12 h-7 z" />
                            </svg>
                        </div>
                        <span>Update tren teknologi terbaru (AI, Web, Mobile)</span>
                    </div>

                    <div class="event-hero__feature-item">
                        <div class="event-hero__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="9" y="2" width="6" height="4" rx="1" />
                                <path d="M5 6 h14 v14 H5 z" />
                            </svg>
                        </div>
                        <span>Kesempatan membangun portofolio proyek nyata</span>
                    </div>

                    <div class="event-hero__feature-item">
                        <div class="event-hero__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="9" cy="7" r="4" />
                                <circle cx="17" cy="7" r="4" />
                                <path d="M3 20c0-4 3-7 6-7s6 3 6 7" />
                                <path d="M13 20c0-4 3-7 6-7s6 3 6 7" />
                            </svg>
                        </div>
                        <span>Networking dengan praktisi & senior IT</span>
                    </div>

                </div>

                <button class="event-hero__btn">Explore Event</button>
            </div>

        </div>
    </section>

    {{-- PITA --}}
    <div class="relative w-full overflow-hidden py-24 bg-white h-[100px]">
        <div class="absolute top-10 left-[-5%] w-[110%] -rotate-3 bg-[#EC46A4] shadow-lg">
            <div class="flex whitespace-nowrap animate-scroll-right z-50  ">
                <div class="flex items-center gap-4 px-4 py-3">
                    <span class="text-white text-xl font-bold tracking-wider">HMIF ITATS • HMIF ITATS • HMIF ITATS •
                        HMIF ITATS •</span>
                </div>
                <div class="flex items-center gap-4 px-4 py-3">
                    <span class="text-white text-xl font-bold tracking-wider">HMIF ITATS • HMIF ITATS • HMIF ITATS •
                        HMIF ITATS •</span>
                </div>
                <div class="flex items-center gap-4 px-4 py-3">
                    <span class="text-white text-xl font-bold tracking-wider">HMIF ITATS • HMIF ITATS • HMIF ITATS •
                        HMIF ITATS •</span>
                </div>
            </div>
        </div>
        <div class="absolute top-10 left-[-5%] w-[110%] rotate-3 bg-[#EC46A4] shadow-lg  ">
            <div class="flex whitespace-nowrap animate-scroll-left">
                <div class="flex items-center gap-4 px-4 py-3">
                    <span class="text-white text-xl font-bold tracking-wider">TEKNIK INFORMATIKA • TEKNIK INFORMATIKA •
                        TEKNIK INFORMATIKA •</span>
                </div>
                <div class="flex items-center gap-4 px-4 py-3">
                    <span class="text-white text-xl font-bold tracking-wider">TEKNIK INFORMATIKA • TEKNIK INFORMATIKA •
                        TEKNIK INFORMATIKA •</span>
                </div>
                <div class="flex items-center gap-4 px-4 py-3">
                    <span class="text-white text-xl font-bold tracking-wider">TEKNIK INFORMATIKA • TEKNIK INFORMATIKA •
                        TEKNIK INFORMATIKA •</span>
                </div>
            </div>
        </div>
    </div>
    {{-- EVENT --}}
    <div class="container" id="event">
        <div class="header">
            <h1>Upcoming Event</h1>
            <p>Bersiaplah untuk keseruan yang tak terlupakan. Catat tanggalnya!</p>
        </div>

        <div class="events-grid">
            <!-- Event Card 1 -->
            <div class="event-card">
                <a href="{{ url('/detail-event') }}" class="card-image-link">
                    <img src="image/poster1.png" alt="Informatic Coding Competition" class="card-image">
                </a>
                <div class="card-content">
                    <span class="card-badge">Lomba</span>
                    <h3 class="card-title">
                        <a href="{{ url('/detail-event') }}">
                            Informatic Coding Competition - 2026: Show Your Skill, Prove...
                        </a>
                    </h3>
                    <p class="card-description">Lomba Coding Basis Data dan Pemrograman Terstruktur adalah kompetisi
                        yang menguji kemampuan yang ingin menguji kemampuan logika, analisis, dan keterampilan
                        pemrograman</p>
                    <div class="card-footer">
                        <span class="card-date">19-09-2026</span>
                        <span class="card-days">9 Hari Lagi</span>
                    </div>
                </div>
            </div>

            <!-- Event Card 2 -->
            <div class="event-card">
                <a href="{{ url('/detail-event') }}" class="card-image-link">
                    <img src="image/poster2.png" alt="Teknik Informatika" class="card-image">
                </a>
                <div class="card-content">
                    <span class="card-badge">Sosialisasi</span>
                    <h3 class="card-title">
                        <a href="{{ url('/detail-event') }}">
                            Mengenal Lebih Dekat Teknik Informatika: Membangun Ponda...
                        </a>
                    </h3>
                    <p class="card-description">Teknik Informatika adalah bidang yang mempelajari cara merancang,
                        mengembangkan, dan mengimplementasikan teknologi yang dapat hadir di setiap aspek hidup modern
                    </p>
                    <div class="card-footer">
                        <span class="card-date">09-11-2026</span>
                        <span class="card-days">20 Hari Lagi</span>
                    </div>
                </div>
            </div>
            <!-- Event Card 3 -->
            <div class="event-card">
                <a href="{{ url('/detail-event') }}" class="card-image-link">
                    <img src="image/poster3.png" alt="PDH Teknik Informatika" class="card-image">
                </a>
                <div class="card-content">
                    <span class="card-badge">Penjualan</span>
                    <h3 class="card-title">
                        <a href="{{ url('/detail-event') }}">
                            Pre-Order PDH Teknik Informatika ITATS - 2025
                        </a>
                    </h3>
                    <p class="card-description">Pre-order PDH Teknik Informatika iTATS 2025 dibuka untuk seluruh
                        mahasiswa yang ingin mendapatkan pakaian dinas harian resmi dengan desain terbaru.</p>
                    <div class="card-footer">
                        <span class="card-date">10-07-2026</span>
                        <span class="card-days">12 Hari Lagi</span>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="view-all-btn">Lihat Semua Event</a>
    </div>
    {{-- PESAN --}}
    <div class="header">
        <h1>Suarakan Aspirasimu</h1>
    </div>
    <div class="card-container">
        <div class="form-section">
            <form>
                <div class="form-group">
                    <label>Your name <span class="required">*</span></label>
                    <input type="text" placeholder="Input Here . . .">
                </div>

                <div class="form-group form-row">
                    <div>
                        <label>Email <span class="required">*</span></label>
                        <input type="email" placeholder="@example.com">
                    </div>
                    <div>
                        <label>Phone Number <span class="required">*</span></label>
                        <input type="tel" placeholder="Enter Phone Number">
                    </div>
                </div>

                <div class="form-group">
                    <label>Description <span class="required">*</span></label>
                    <textarea rows="6" placeholder="Enter here . . ."></textarea>
                </div>

                <div class="button-wrapper">
                    <button type="submit" class="submit-btn">Kirim</button>
                </div>
            </form>
        </div>

        <div class="image-section">
            <img src="image/about.png" alt="ITATS Graduation">
        </div>
    </div>
    <!-- FOOTER -->
    @include('include.footer')
    <!-- SCRIPT SLIDER -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const carousel = document.getElementById('carousel');
            const slides = carousel.children;
            const totalSlides = slides.length;

            const indicators = document.querySelectorAll('#indicators .indicator');
            const prevBtn = document.getElementById('prev');
            const nextBtn = document.getElementById('next');

            let currentIndex = 0;
            const intervalTime = 3000;
            let carouselInterval;

            function updateCarousel() {
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;

                indicators.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentIndex);
                });
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateCarousel();
            }

            function prevSlide() {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateCarousel();
            }

            function startCarousel() {
                carouselInterval = setInterval(nextSlide, intervalTime);
            }

            function resetCarousel() {
                clearInterval(carouselInterval);
                startCarousel();
            }

            nextBtn.addEventListener('click', () => {
                nextSlide();
                resetCarousel();
            });

            prevBtn.addEventListener('click', () => {
                prevSlide();
                resetCarousel();
            });

            indicators.forEach((dot, i) => {
                dot.addEventListener('click', () => {
                    currentIndex = i;
                    updateCarousel();
                    resetCarousel();
                });
            });

            updateCarousel();
            startCarousel();
        });
        // const menuBtn = document.getElementById('menuBtn');
        // const mobileMenu = document.getElementById('mobileMenu');

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('open');
            });
        }
    </script>


</body>

</html>
