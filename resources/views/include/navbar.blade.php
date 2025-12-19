<style>
    :root {
        --primary-color: #EC46A4;
        --text-color: #374151;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.1)
    }

    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        padding: 1rem 1.5rem;
        box-shadow: var(--shadow);
        z-index: 1000
    }

    .container-navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto
    }

    .logo img {
        height: 48px;
        display: block
    }

    .nav-links {
        display: flex;
        gap: 2rem
    }

    .nav-links a {
        text-decoration: none;
        color: var(--text-color);
        font-weight: 500
    }

    .nav-links a.active,
    .nav-links a:hover {
        color: var(--primary-color)
    }

    .nav-btn .btn-register {
        background: var(--primary-color);
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        text-decoration: none
    }

    .hamburger {
        background: none;
        border: none;
        cursor: pointer
    }

    .mobile-menu {
        display: none
    }

    @media (max-width:767px) {
        .desktop-only {
            display: none
        }

        .mobile-only {
            display: block
        }

        .mobile-menu {
            flex-direction: column;
            gap: 0.75rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #eee
        }
    }
    .mobile-menu.active {
        display: flex;
    }

</style>

<nav class="navbar">
    <div class="container-navbar">

        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('image/logo1.png') }}" alt="Logo">
            </a>
        </div>
        <div class="nav-links desktop-only">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('event.list') }}" class="{{ request()->routeIs('event.list') ? 'active' : '' }}">Event</a>

            @if (request()->routeIs('home'))
                <a href="#about">About</a>
                <a href="#footer">Contact</a>
            @else
                <a href="{{ url('/home#about') }}">About</a>
                <a href="{{ url('/home#footer') }}">Contact</a>
            @endif
        </div>

        <div class="nav-btn desktop-only">
            @auth
                <div class="auth-actions" style="display:flex;align-items:center;gap:8px;">
                    @if (auth()->user()->role_id == 1)
                        <a href="{{ route('admin.dashboard') }}" class="btn-register">Dashboard</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn-register">Dashboard</a>
                    @endif

                    <a href="{{ route('notifications.index') }}" class="btn-notif-navbar" style="color:var(--text-color); margin-left: 5px; position: relative;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                            <span style="position: absolute; top: -5px; right: -5px; background: #EC46A4; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: bold;">
                                {{ $unreadNotificationsCount }}
                            </span>
                        @endif
                    </a>

                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-logout"
                            style="background:transparent;border:none;color:var(--text-color);padding:8px 12px;cursor:pointer;">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-gray-900 mr-4"
                    style="text-decoration: none; margin-right: 15px; color: var(--text-color);">Login</a>
                <a href="{{ route('register.account') }}" class="btn-register">Daftar Akun</a>
            @endauth
        </div>

        <button id="menuBtn" class="hamburger mobile-only" aria-label="Menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

    </div>

    <!-- MOBILE DROPDOWN -->
    <div id="mobileMenu" class="mobile-menu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('event.list') }}" class="{{ request()->routeIs('event.list') ? 'active' : '' }}">Event</a>

        @if (request()->routeIs('home'))
            <a href="#about">About</a>
            <a href="#footer">Contact</a>
        @else
            <a href="{{ url('/home#about') }}">About</a>
            <a href="{{ url('/home#footer') }}">Contact</a>
        @endif

        @auth
            <a href="{{ route('dashboard') }}" class="btn-register full-width">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:8px;">
                @csrf
                <button type="submit" class="btn-register full-width">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register.account') }}" class="btn-register full-width">Daftar Akun</a>
        @endauth
    </div>
</nav>
<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
        });
    });
</script>
