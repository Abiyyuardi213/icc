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
            <img src="{{ asset('image/logo.png') }}" alt="Logo" style="height: 32px; width: auto;">
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
        <a href="{{ route('user.chat.index') }}" class="menu-item {{ request()->routeIs('user.chat.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            Layanan Chat
        </a>

        <a href="{{ route('notifications.index') }}" class="menu-item {{ request()->routeIs('notifications.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            Kotak Masuk
            @php
                $unreadCount = auth()->user()->notifications()->where('is_read', false)->count();
            @endphp
            @if($unreadCount > 0)
                <span class="badge">{{ $unreadCount }}</span>
            @endif
        </a>

        <div class="mt-8">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4 px-3">Akun</p>
            <a href="{{ route('profile.edit') }}" class="menu-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Profil Saya
            </a>
            
            <button type="button" id="logoutBtn" class="menu-item w-full text-left bg-transparent border-0 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </div>

        <div class="mt-4 border-t pt-4">
             <a href="{{ route('home') }}" class="menu-item text-sm text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </nav>
</aside>

<!-- Hidden Logout Form for AJAX fallback or simple submission context -->
<form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>

{{-- SweetAlert2 is already in layout, but let's assume specific script management here --}}
<script>
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Yakin ingin keluar?',
            text: "Anda harus login kembali untuk mengakses akun ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EC46A4',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form directly for ease
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>
