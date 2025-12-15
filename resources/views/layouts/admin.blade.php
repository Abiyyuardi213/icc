<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - ICC')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
        .admin-layout { display: flex; min-height: 100vh; }
        .admin-content { flex: 1; display: flex; flex-direction: column; transition: margin-left 0.3s ease-in-out; margin-left: 250px; }
        
        @media (max-width: 768px) {
            .admin-content { margin-left: 0; }
        }
        
        /* Adjust content when sidebar is closed on desktop */
        .admin-content.full-width {
            margin-left: 0;
        }

        /* DataTables Customization for Tailwind & Theme */
        .dataTables_wrapper {
            padding: 1.5rem;
            font-family: 'Inter', sans-serif !important;
            color: #374151;
        }

        /* Length & Filter */
        .dataTables_length, .dataTables_filter {
            margin-bottom: 2rem;
            font-family: 'Inter', sans-serif !important;
        }

        .dataTables_wrapper .dataTables_length select {
            padding: 0.5rem 2.5rem 0.5rem 1rem !important;
            background-color: #fff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 0.5rem !important;
            color: #374151 !important;
            font-size: 0.875rem !important;
            outline: none;
            transition: all 0.2s;
            cursor: pointer;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            -webkit-appearance: none;
        }

        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #EC46A4 !important;
            box-shadow: 0 0 0 3px rgba(236, 70, 164, 0.1) !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            padding: 0.6rem 1rem !important;
            background-color: #fff !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 0.5rem !important;
            margin-left: 0.75rem !important;
            outline: none;
            transition: all 0.2s;
            font-size: 0.875rem !important;
            width: 250px !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #EC46A4 !important;
            box-shadow: 0 0 0 3px rgba(236, 70, 164, 0.1) !important;
        }

        /* Table Styling */
        table.dataTable {
            border-collapse: separate !important;
            border-spacing: 0 !important;
            width: 100% !important;
            margin-top: 1rem !important;
            border-bottom: 1px solid #f3f4f6 !important;
            margin-bottom: 1.5rem !important;
        }
        
        table.dataTable thead th {
            border-bottom: 2px solid #f3f4f6 !important;
            padding: 1rem 1.5rem !important;
            font-weight: 600 !important;
            color: #6b7280 !important; /* Text-gray-500 */
            background-color: #fff !important;
            font-size: 0.75rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            text-align: left !important;
            font-family: 'Inter', sans-serif !important;
        }

        table.dataTable tbody td {
            padding: 1rem 1.5rem !important;
            border-bottom: 1px solid #f9fafb !important;
            color: #374151 !important; /* Text-gray-700 */
            font-size: 0.875rem !important;
            vertical-align: middle !important;
            font-family: 'Inter', sans-serif !important;
        }

        table.dataTable tbody tr {
            transition: background-color 0.2s ease;
        }

        table.dataTable tbody tr:hover {
            background-color: #fdf2f8 !important; /* Pink-50 */
        }
        
        /* Remove default DataTables borders that might conflict */
        table.dataTable.no-footer {
            border-bottom: 1px solid #e5e7eb !important;
        }

        /* Pagination */
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 1rem !important;
            display: flex;
            justify-content: flex-end;
            gap: 0.35rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            margin-left: 0;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            background: #fff;
            color: #374151 !important;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled) {
            background: #fdf2f8 !important; 
            border-color: #EC46A4 !important;
            color: #EC46A4 !important;
            transform: translateY(-1px);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: linear-gradient(135deg, #EC46A4 0%, #d63f93 100%) !important;
            border-color: transparent !important;
            color: white !important;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(236, 70, 164, 0.3);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            cursor: not-allowed;
            color: #9ca3af !important;
            border-color: #f3f4f6;
            background: #f9fafb !important;
            box-shadow: none;
            opacity: 0.7;
        }
        
        .dataTables_info {
            color: #9ca3af !important;
            font-size: 0.85rem;
            padding-top: 1.25rem !important;
        }
    </style>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    @yield('styles')
</head>
<body>

    <div class="admin-layout">
        <!-- Mobile Overlay -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300 opacity-0 lg:hidden"></div>

        @include('include.admin-sidebar')

        <div class="admin-content" id="adminContent">
            @include('include.admin-navbar')

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('adminSidebar');
        const content = document.getElementById('adminContent');
        const sidebarOverlayElement = document.getElementById('sidebarOverlay');
        const profileBtn = document.getElementById('profileDropdownBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        // Sidebar Toggle
        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth >= 1024) { // Changed breakpoint to lg (1024px) for better desktop handling or keep 768 default? Tailwind md is 768. Let's stick to 768 consistent with CSS.
                // Desktop
                sidebar.classList.toggle('closed');
                content.classList.toggle('full-width');
            } else {
                // Mobile
                const isOpen = sidebar.classList.contains('open');
                if (isOpen) {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
            }
        });

        function openMobileSidebar() {
            sidebar.classList.add('open');
            sidebarOverlayElement.classList.remove('hidden');
            // Small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                sidebarOverlayElement.classList.remove('opacity-0');
            }, 10);
        }

        function closeMobileSidebar() {
            sidebar.classList.remove('open');
            sidebarOverlayElement.classList.add('opacity-0');
            setTimeout(() => {
                sidebarOverlayElement.classList.add('hidden');
            }, 300); // Match duration-300
        }

        // Close sidebar when clicking overlay
        sidebarOverlayElement.addEventListener('click', closeMobileSidebar);

        // Profile Dropdown
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            if (profileDropdown.classList.contains('show')) {
                profileDropdown.classList.remove('show');
            }
        });
    </script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* Custom Select2 Styling to match Tailwind */
        .select2-container .select2-selection--single,
        .select2-container .select2-selection--multiple {
            height: auto !important;
            min-height: 42px !important;
            border: 1px solid #e5e7eb !important; /* gray-200 */
            border-radius: 0.5rem !important; /* rounded-lg */
            padding: 0.25rem 0.5rem !important;
            outline: none !important;
            transition: all 0.15s ease-in-out;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 32px !important;
            color: #374151 !important; /* gray-700 */
            padding-left: 4px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 8px !important;
        }

        /* Focus State */
        .select2-container--open .select2-selection--single,
        .select2-container--open .select2-selection--multiple {
            border-color: #EC46A4 !important; /* Pink-500 */
            box-shadow: 0 0 0 2px rgba(236, 70, 164, 0.2) !important;
        }

        /* Dropdown */
        .select2-dropdown {
            border-color: #e5e7eb !important;
            border-radius: 0.5rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            overflow: hidden !important;
            z-index: 9999 !important; /* Ensure it's above modals */
        }

        .select2-results__option {
            padding: 8px 12px !important;
            font-size: 0.875rem !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #EC46A4 !important;
            color: white !important;
        }

        .select2-container--default .select2-results__option--selected {
            background-color: #fdf2f8 !important; /* Pink-50 */
            color: #EC46A4 !important;
        }

        /* Multiple Select Chips */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #fdf2f8 !important;
            border: 1px solid #fbcfe8 !important;
            color: #be185d !important;
            border-radius: 0.375rem !important;
            padding: 2px 8px !important;
            margin-top: 4px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #be185d !important;
            border-right: 1px solid #fbcfe8 !important;
            margin-right: 6px !important;
        }
        
        /* Fix for Modal interaction */
        /* width: 100% removed to prevent overflow on body-attached dropdowns */
    </style>

    <script>
        // Global Toast Configuration
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Initialize Select2 Globally on .select2 class
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    @yield('scripts')
</body>
</html>
