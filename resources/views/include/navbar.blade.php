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
                <a href="{{ url('/dashboard') }}" class="btn-register">Dashboard</a>
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
            <a href="{{ url('/dashboard') }}" class="btn-register full-width">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register.account') }}" class="btn-register full-width">Daftar Akun</a>
        @endauth
    </div>
</nav>
