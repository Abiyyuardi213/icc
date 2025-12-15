<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard - ICC')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
        .user-layout { display: flex; min-height: 100vh; }
        .user-content { flex: 1; display: flex; flex-direction: column; transition: margin-left 0.3s ease-in-out; margin-left: 260px; }
        
        @media (max-width: 768px) {
            .user-content { margin-left: 0; }
        }
    </style>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('styles')
</head>
<body>

    <div class="user-layout">
        <!-- Mobile Overlay -->
        <div id="sidebarOverlayUser" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300 opacity-0 md:hidden"></div>

        @include('include.user-sidebar')

        <div class="user-content" id="userContent">
            @include('include.user-navbar')

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const toggleBtnUser = document.getElementById('toggleSidebar');
        const sidebarUser = document.getElementById('userSidebar');
        const sidebarOverlayUser = document.getElementById('sidebarOverlayUser');
        const profileBtnUser = document.getElementById('profileDropdownBtn');
        const profileDropdownUser = document.getElementById('profileDropdown');

        // Sidebar Toggle
        if(toggleBtnUser){
            toggleBtnUser.addEventListener('click', () => {
                // Mobile check
                if (window.innerWidth < 768) {
                    const isOpen = sidebarUser.classList.contains('open');
                    if (isOpen) closeMobileSidebar();
                    else openMobileSidebar();
                } else {
                    // Desktop can implement collapse if needed, for now just static
                    // sidebarUser.classList.toggle('closed');
                }
            });
        }

        function openMobileSidebar() {
            sidebarUser.classList.add('open');
            sidebarOverlayUser.classList.remove('hidden');
            setTimeout(() => sidebarOverlayUser.classList.remove('opacity-0'), 10);
        }

        function closeMobileSidebar() {
            sidebarUser.classList.remove('open');
            sidebarOverlayUser.classList.add('opacity-0');
            setTimeout(() => sidebarOverlayUser.classList.add('hidden'), 300);
        }

        if(sidebarOverlayUser) sidebarOverlayUser.addEventListener('click', closeMobileSidebar);

        // Profile Dropdown
        if(profileBtnUser){
            profileBtnUser.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdownUser.classList.toggle('show');
            });
        }

        document.addEventListener('click', () => {
            if (profileDropdownUser && profileDropdownUser.classList.contains('show')) {
                profileDropdownUser.classList.remove('show');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
