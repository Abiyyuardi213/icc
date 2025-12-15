<style>
    .admin-navbar {
        height: 64px;
        background-color: white;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1.5rem;
        position: sticky;
        top: 0;
        z-index: 40;
    }

    .toggle-sidebar {
        background: none;
        border: none;
        cursor: pointer;
        color: #374151;
    }

    .admin-profile {
        position: relative;
    }

    .profile-btn {
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .profile-avatar {
        width: 32px;
        height: 32px;
        background-color: #EC46A4;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .profile-dropdown {
        position: absolute;
        right: 0;
        top: 100%;
        width: 200px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        display: none;
        flex-direction: column;
        margin-top: 0.5rem;
    }

    .profile-dropdown.show {
        display: flex;
    }

    .dropdown-item {
        padding: 0.75rem 1rem;
        text-decoration: none;
        color: #374151;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dropdown-item:hover {
        background-color: #f9fafb;
    }

    .dropdown-divider {
        height: 1px;
        background-color: #e5e7eb;
        margin: 0;
    }
</style>

<header class="admin-navbar">
    <button class="toggle-sidebar" id="toggleSidebar">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div class="admin-profile">
        <button class="profile-btn" id="profileDropdownBtn">
            <span class="text-sm font-medium mr-2">{{ Auth::user()->name ?? 'Admin' }}</span>
            <div class="profile-avatar">
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div class="profile-dropdown" id="profileDropdown">
            <a href="{{ route('home') }}" class="dropdown-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Beranda
            </a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                @csrf
                <button type="button" id="logoutBtn" class="dropdown-item w-full text-left text-red-600 hover:bg-red-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: "Apakah Anda yakin ingin keluar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', 
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Show Toast
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                
                Toast.fire({
                    icon: 'success',
                    title: 'Signing out...'
                });

                // Submit Form
                setTimeout(() => {
                    document.getElementById('logoutForm').submit();
                }, 800);
            }
        });
    });
</script>

