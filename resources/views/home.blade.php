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
            <form action="{{ route('event.list') }}" method="GET" class="event-search__inner">
                <input type="text" name="search" placeholder="Mau cari event apa hari ini?" class="event-search__input">

                <button type="submit" class="event-search__button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="event-search__icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    Cari Event
                </button>
            </form>
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

                <a href="{{ route('event.list') }}" class="event-hero__btn text-decoration-none">Explore Event</a>
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
            @forelse($events as $event)
            <div class="event-card">
                <a href="{{ route('event.detail', $event->slug) }}" class="card-image-link">
                    @if($event->photo)
                        <img src="{{ asset('storage/' . $event->photo) }}" alt="{{ $event->name }}" class="card-image">
                    @else
                        <!-- Random Placeholder Logic if no photo -->
                        <img src="{{ asset('image/poster' . rand(1,3) . '.png') }}" alt="{{ $event->name }}" class="card-image">
                    @endif
                </a>
                <div class="card-content">
                    <span class="card-badge">Event</span>
                    <h3 class="card-title">
                        <a href="{{ route('event.detail', $event->slug) }}">
                            {{ Str::limit($event->name, 50) }}
                        </a>
                    </h3>
                    <p class="card-description">{{ Str::limit(strip_tags($event->description), 100) }}</p>
                    <div class="card-footer">
                        <span class="card-date">{{ $event->registration_end ? $event->registration_end->format('d-m-Y') : '-' }}</span>
                        <span class="card-days">
                            @if($event->registration_end && now() <= $event->registration_end)
                                {{ ceil(now()->diffInDays($event->registration_end)) }} Hari Lagi
                            @elseif($event->registration_end && now() > $event->registration_end)
                                Ditutup
                            @else
                                -
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center p-10">
                <p>Belum ada event yang ditampilkan.</p>
            </div>
            @endforelse
        </div>
        <a href="{{ route('event.list') }}" class="view-all-btn">Lihat Semua Event</a>
    </div>
    {{-- PESAN --}}
    <div class="header">
        <h1>Suarakan Aspirasimu</h1>
    </div>
    <div class="card-container">
        <div class="form-section">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('aspiration.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Anda <span class="required">*</span></label>
                    <input type="text" name="name" placeholder="Input Here . . ." 
                        value="{{ auth()->check() ? auth()->user()->name : old('name') }}" 
                        {{ auth()->check() ? 'readonly' : '' }}>
                </div>

                <div class="form-group">
                    <label>Aspirasi / Kritik / Saran <span class="required">*</span></label>
                    <textarea name="description" rows="5" placeholder="Tuliskan aspirasi Anda di sini..." required>{{ old('description') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_private" value="1">
                        <span class="text-sm text-gray-600">Kirim secara Privat (Chat dengan Admin)</span>
                    </label>
                </div>

                <div class="button-wrapper">
                    <button type="submit" class="submit-btn">Kirim Aspirasi</button>
                </div>
            </form>
        </div>

        <div class="image-section">
            <img src="image/about.png" alt="ITATS Graduation">
        </div>
    </div>

    <!-- ASPIRATION FEED -->
    <div class="container my-16 pb-16 pt-10" id="forum">
        <div class="text-center mb-12">
            <span class="text-pink-500 font-bold tracking-wider text-sm uppercase mb-2 block">Komunitas</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Forum Diskusi Mahasiswa</h2>
            <p class="text-gray-500 mt-4 max-w-xl mx-auto">Ruang terbuka untuk berbagi ide, aspirasi, dan diskusi konstruktif demi kemajuan bersama.</p>
        </div>
        
        <div class="max-w-4xl mx-auto space-y-8">
            @forelse($aspirations as $aspiration)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
                    <!-- Main Post -->
                    <div class="p-6 md:p-8">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow-md transform group-hover:scale-110 transition-transform duration-300">
                                    {{ strtoupper(substr($aspiration->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $aspiration->name }}</h4>
                                    <div class="flex items-center gap-3 text-xs text-gray-500 mt-1">
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $aspiration->created_at->diffForHumans() }}
                                        </span>
                                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                        <span class="px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 font-medium">Public</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="md:pl-16">
                            <p class="text-gray-700 leading-relaxed text-base md:text-lg mb-6">{{ $aspiration->description }}</p>
                            
                            <div class="flex items-center gap-4 pt-6 border-t border-gray-50">
                                <button onclick="toggleReply('{{ $aspiration->id }}')" 
                                    class="group/btn flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition-all duration-300 text-sm font-semibold border border-yellow-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-300 group-hover/btn:-rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    Balas Diskusi
                                    <span class="ml-1 bg-white px-2 py-0.5 rounded-full text-xs shadow-sm text-yellow-600 border border-yellow-100">{{ $aspiration->replies->count() }}</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Replies Section with Smooth Transition -->
                    <div id="wrapper-{{ $aspiration->id }}" class="grid grid-rows-[0fr] transition-all duration-500 ease-in-out">
                        <div class="overflow-hidden">
                            <div class="bg-gray-50/50 border-t border-gray-100 p-6 md:p-8 md:pl-24 space-y-6">
                                <!-- Existing Replies -->
                                @foreach($aspiration->replies as $reply)
                                    <div class="flex gap-4 group/reply animate-fade-in">
                                        <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex flex-shrink-0 items-center justify-center text-gray-600 font-bold text-xs shadow-sm mt-1">
                                            {{ strtoupper(substr($reply->user->name ?? $reply->name, 0, 1)) }}
                                        </div>
                                        <div class="bg-white p-4 rounded-2xl rounded-tl-none border border-gray-200 shadow-sm flex-1 hover:shadow-md transition-shadow">
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="font-bold text-sm text-gray-900">{{ $reply->user->name ?? $reply->name }}</span>
                                                <span class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-600 text-sm leading-relaxed">{{ $reply->description }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Reply Form -->
                                <div id="reply-form-{{ $aspiration->id }}" class="mt-6 pt-6 border-t border-gray-200/60 hidden">
                                    @if(auth()->check())
                                        <form action="{{ route('aspiration.reply', $aspiration->id) }}" method="POST" class="flex gap-4">
                                            @csrf
                                            <div class="w-10 h-10 rounded-full bg-pink-100 border border-pink-200 flex flex-shrink-0 items-center justify-center text-pink-600 font-bold text-sm">
                                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                            </div>
                                            <div class="flex-1">
                                                <div class="relative">
                                                    <textarea name="description" rows="3" 
                                                        class="w-full bg-white border-gray-200 rounded-xl focus:border-pink-500 focus:ring-pink-500 text-sm p-4 shadow-sm transition-all" 
                                                        placeholder="Tulis balasan Anda yang sopan dan membangun..." required></textarea>
                                                </div>
                                                <div class="flex justify-end gap-3 mt-3">
                                                    <button type="button" onclick="cancelReply('{{ $aspiration->id }}')" class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
                                                        Batal
                                                    </button>
                                                    <button type="submit" 
                                                        style="background-color: #EC46A4; color: white;"
                                                        class="px-6 py-2 rounded-xl text-sm font-bold shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                                        Kirim Balasan
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <div class="flex flex-col items-center justify-center py-8 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                                            <p class="text-gray-600 font-medium mb-3">Yuk, ikut berdiskusi!</p>
                                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-pink-500 text-white font-semibold text-sm hover:bg-pink-600 transition-colors shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                                </svg>
                                                Login untuk Membalas
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada diskusi</h3>
                    <p class="text-gray-500">Jadilah yang pertama menyuarakan aspirasi!</p>
                </div>
            @endforelse

            <div class="mt-12 flex justify-center">
                {{ $aspirations->links() }}
            </div>
        </div>
    </div>

    <script>
        function toggleReply(id) {
            const wrapper = document.getElementById(`wrapper-${id}`);
            const form = document.getElementById(`reply-form-${id}`);
            
            // Toggle grid-rows between 0fr and 1fr for smooth height transition
            if (wrapper.classList.contains('grid-rows-[0fr]')) {
                wrapper.classList.remove('grid-rows-[0fr]');
                wrapper.classList.add('grid-rows-[1fr]');
                // Show form automatically when opening
                form.classList.remove('hidden');
                // Auto focus textarea if logged in
                const textarea = form.querySelector('textarea');
                if(textarea) setTimeout(() => textarea.focus(), 300);
            } else {
                wrapper.classList.add('grid-rows-[0fr]');
                wrapper.classList.remove('grid-rows-[1fr]');
            }
        }

        function cancelReply(id) {
            const wrapper = document.getElementById(`wrapper-${id}`);
            wrapper.classList.add('grid-rows-[0fr]');
            wrapper.classList.remove('grid-rows-[1fr]');
        }
    </script>

    @if(!auth()->check())
    <!-- FLOATING CHAT ICON FOR GUESTS -->
    <a href="https://wa.me/6281234567890" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition-all z-50 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
        </svg>
        Chat Admin
    </a>
    @endif
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
