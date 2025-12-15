<nav class="navbar">
    <div class="container-navbar">

        <div class="logo">
            <img src="image/logo1.png" alt="Logo">
        </div>
        <div class="nav-links desktop-only">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('event.list') }}" class="{{ request()->routeIs('event.list') ? 'active' : '' }}">Event</a>
            <a href="#">About</a>
            <a href="#footer">Contact</a>
        </div>

        <div class="nav-btn desktop-only">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-register">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-gray-900 mr-4">Login</a>
                <a href="{{ route('team.register') }}" class="btn-register">Register</a>
            @endauth
        </div>

        <button id="menuBtn" class="hamburger mobile-only" aria-label="Menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

    </div>

    <!-- MOBILE DROPDOWN (Cleaned up duplicates) -->
    <div id="mobileMenu"
        class="fixed top-[80px] left-0 w-full bg-white shadow-lg opacity-0 block md:hidden invisible translate-y-[-10px] transition-all duration-300 z-50 menu-toggle text-gray-700">

        <div class="flex flex-col px-6 py-6 gap-4">
            <a href="{{ route('home') }}" class="font-semibold {{ request()->routeIs('home') ? 'text-[#EC46A4]' : 'text-gray-700' }}">Beranda</a>
            <a href="{{ route('event.list') }}" class="{{ request()->routeIs('event.list') ? 'text-[#EC46A4]' : 'text-gray-700' }}">Event</a>
            <a href="#" class="text-gray-700">About</a>
            <a href="#footer" class="text-gray-700">Contact</a>

            @auth
                <a href="{{ url('/dashboard') }}" class="mt-4 text-center bg-[#EC46A4] text-white py-3 rounded-lg font-semibold shadow">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="block text-center font-semibold text-gray-600">Login</a>
                <a href="{{ route('team.register') }}" class="mt-2 text-center bg-[#EC46A4] text-white py-3 rounded-lg font-semibold shadow">
                    Register
                </a>
            @endauth
        </div>
    </div>
