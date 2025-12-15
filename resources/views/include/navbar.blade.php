<style>
    :root{--primary-color:#EC46A4;--text-color:#374151;--shadow:0 4px 6px rgba(0,0,0,0.1)}
    .navbar{position:fixed;top:0;left:0;width:100%;background-color:rgba(255,255,255,0.9);backdrop-filter:blur(8px);padding:1rem 1.5rem;box-shadow:var(--shadow);z-index:1000}
    .container-navbar{display:flex;justify-content:space-between;align-items:center;max-width:1200px;margin:0 auto}
    .logo img{height:48px;display:block}
    .nav-links{display:flex;gap:2rem}
    .nav-links a{text-decoration:none;color:var(--text-color);font-weight:500}
    .nav-links a.active,.nav-links a:hover{color:var(--primary-color)}
    .nav-btn .btn-register{background:var(--primary-color);color:#fff;padding:0.5rem 1rem;border-radius:8px;text-decoration:none}
    .hamburger{background:none;border:none;cursor:pointer}
    .mobile-menu{display:none}
    @media (max-width:767px){.desktop-only{display:none}.mobile-only{display:block}.mobile-menu{display:flex;flex-direction:column;gap:0.75rem;margin-top:1rem;padding-top:1rem;border-top:1px solid #eee}}
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
            
            @if(request()->routeIs('home'))
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
                    <a href="{{ route('dashboard') }}" class="btn-register">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-logout" style="background:transparent;border:none;color:var(--text-color);padding:8px 12px;cursor:pointer;">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-gray-900 mr-4" style="text-decoration: none; margin-right: 15px; color: var(--text-color);">Login</a>
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
        
        @if(request()->routeIs('home'))
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
