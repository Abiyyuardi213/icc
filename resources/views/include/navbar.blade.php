<nav class="navbar">
    <div class="container-navbar">

        <div class="logo">
            <img src="image/logo1.png" alt="Logo">
        </div>
        <div class="nav-links desktop-only">
            <a href="#" class="active">Beranda</a>
            <a href="{{ url('/list-event') }}">Event</a>
            <a href="#">About</a>
            <a href="#footer">Contact</a>
        </div>

        <div class="nav-btn desktop-only">
            <a href="#" class="btn-register">Register</a>
        </div>

        <button id="menuBtn" class="hamburger mobile-only" aria-label="Menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

    </div>

    <div id="mobileMenu" class="mobile-menu">
        <a href="#" class="active">Beranda</a>
        <a href="#">Event</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
        <a href="#" class="btn-register full-width">Register Now</a>
    </div>
</nav>

<!-- MOBILE DROPDOWN -->
<div id="mobileMenu" class="hidden fixed top-[100px] left-0 w-full bg-white shadow-md md:hidden z-100">
    <div class="flex flex-col px-6 py-4 gap-4">
        <a href="#" class="text-[#EC46A4] font-semibold">Beranda</a>
        <a href="#" class="text-gray-700 hover:text-[#EC46A4]">Event</a>
        <a href="#" class="text-gray-700 hover:text-[#EC46A4]">About</a>
        <a href="#" class="text-gray-700 hover:text-[#EC46A4]">Contact</a>

        <a href="#" class="mt-2 text-center bg-[#EC46A4] text-white font-semibold py-3 rounded-lg">
            Register
        </a>
    </div>
</div>


<!-- MOBILE DROPDOWN -->
<div id="mobileMenu"
    class="fixed top-[80px] left-0 w-full bg-white shadow-lg opacity-0 block md:hidden invisible translate-y-[-10px] transition-all duration-300 z-999  menu-toggle text-gray-700">

    <div class="flex flex-col px-6 py-6 gap-4">
        <a href="#" class="font-semibold text-[#EC46A4]">Beranda</a>
        <a href="#" class="text-gray-700">Event</a>
        <a href="#" class="text-gray-700">About</a>
        <a href="#" class="text-gray-700">Contact</a>

        <a href="#" class="mt-4 text-center bg-[#EC46A4] text-white py-3 rounded-lg font-semibold shadow">
            Register
        </a>
    </div>
</div>
