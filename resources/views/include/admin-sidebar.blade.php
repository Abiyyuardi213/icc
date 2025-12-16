<style>
    .admin-sidebar {
        width: 250px;
        height: 100vh;
        background-color: white;
        border-right: 1px solid #e5e7eb;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 50;
        transition: transform 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
    }

    .admin-sidebar.closed {
        transform: translateX(-100%);
    }

    .sidebar-header {
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #e5e7eb;
    }

    .sidebar-header img {
        height: 32px;
    }

    .sidebar-menu {
        flex: 1;
        padding: 1rem;
        overflow-y: auto;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        color: #374151;
        text-decoration: none;
        border-radius: 0.5rem;
        margin-bottom: 0.5rem;
        font-weight: 500;
        transition: background 0.2s;
    }

    .menu-item:hover, .menu-item.active {
        background-color: #fce7f3; /* Pink muda */
        color: #EC46A4;
    }

    .menu-item svg {
        width: 20px;
        height: 20px;
    }

    /* Mobile handling handled by parent layout or JS */
    @media (max-width: 768px) {
        .admin-sidebar {
            transform: translateX(-100%);
        }
        .admin-sidebar.open {
            transform: translateX(0);
        }
    }
    @media (max-width: 1024px) {
        .admin-sidebar {
            transform: translateX(-100%);
        }
        .admin-sidebar.open {
            transform: translateX(0);
        }
    }
</style>

<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <a href="{{ route('home') }}">
           <img src="{{ asset('image/logo1.png') }}" alt="Logo">
        </a>
    </div>

    <nav class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            Dashboard
        </a>
        
        <!-- Placeholder Links - Update these as controllers are created -->
        <a href="{{ route('admin.user.index') }}" class="menu-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Manage Users
        </a>

        <a href="{{ route('role.index') }}" class="menu-item {{ request()->routeIs('role.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            Manage Roles
        </a>
        
        <a href="{{ route('admin.event.index') }}" class="menu-item {{ request()->routeIs('admin.event.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Manage Events
        </a>

        <a href="{{ route('admin.team.index') }}" class="menu-item {{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Manage Teams
        </a>
        <div class="mt-auto border-t border-gray-100 pt-4">
             <a href="{{ route('admin.profile.edit') }}" class="menu-item {{ request()->routeIs('admin.profile.edit') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Profile
            </a>
            
            <button onclick="confirmAdminLogout()" class="menu-item w-full text-left hover:bg-red-50 hover:text-red-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
            
            <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </nav>

    <script>
        function confirmAdminLogout() {
            Swal.fire({
                title: 'Logout?',
                text: "Anda yakin ingin keluar dari sistem?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#EC46A4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('admin-logout-form').submit();
                }
            });
        }
    </script>
</aside>
