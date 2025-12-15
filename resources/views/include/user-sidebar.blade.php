<style>
    .user-sidebar {
        width: 260px;
        height: 100vh;
        background-color: white;
        border-right: 1px solid #e5e7eb;
        position: fixed;
        left: 0;
        top: 0;
        transition: transform 0.3s ease-in-out;
        z-index: 50;
        display: flex;
        flex-direction: column;
    }

    .user-sidebar.closed {
        transform: translateX(-100%);
    }

    .sidebar-header {
        height: 64px;
        display: flex;
        align-items: center;
        padding: 0 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .sidebar-logo {
        font-weight: 800;
        font-size: 1.25rem;
        color: #EC46A4; /* Pink Primary */
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sidebar-menu {
        flex: 1;
        padding: 1.5rem 1rem;
        overflow-y: auto;
    }

    .menu-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #4b5563;
        font-weight: 500;
        border-radius: 0.5rem;
        margin-bottom: 0.5rem;
        transition: all 0.2s;
        text-decoration: none;
    }

    .menu-item:hover {
        background-color: #fdf2f8; /* Pink-50 */
        color: #EC46A4;
    }

    .menu-item.active {
        background-color: #EC46A4;
        color: white;
    }

    .menu-item svg {
        width: 20px;
        height: 20px;
        margin-right: 12px;
    }

    .badge {
        background-color: #ef4444;
        color: white;
        font-size: 0.75rem;
        padding: 0.1rem 0.4rem;
        border-radius: 9999px;
        margin-left: auto;
    }

    @media (max-width: 768px) {
        .user-sidebar {
            transform: translateX(-100%);
        }
        .user-sidebar.open {
            transform: translateX(0);
        }
    }
</style>

<aside class="user-sidebar" id="userSidebar">
    <div class="sidebar-header">
        <a href="{{ route('home') }}" class="sidebar-logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            ICC User Panel
        </a>
    </div>

    <nav class="sidebar-menu">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4 px-3">Menu Utama</p>
        
        <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('user.events.index') }}" class="menu-item {{ request()->routeIs('user.events.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Event Saya
        </a>

        <a href="{{ route('user.inbox.index') }}" class="menu-item {{ request()->routeIs('user.inbox.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            Kotak Masuk
            <!-- Example Badge -->
            <!-- <span class="badge">2</span> -->
        </a>

        <div class="mt-8">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4 px-3">Lainnya</p>
            <a href="{{ route('home') }}" class="menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </nav>
</aside>
