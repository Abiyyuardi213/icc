<!-- Sidebar ala SB Admin Pro -->
<aside class="main-sidebar sidebar-light-primary elevation-1" style="background-color: #f8f9fc;">
    <!-- Brand Logo - versi bersih dan proporsional -->
    <a href="{{ url('dashboard') }}" class="d-flex justify-content-center align-items-center py-3" style="background-color: #fff;">
        <img src="{{ asset('image/hima-infor.png') }}"
            alt="Logo HMIF ITATS"
            style="height: 25px; object-fit: contain;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Info -->
        <div class="user-panel d-flex align-items-center mb-3 px-3">
            <div class="image">
                <img src="{{ asset('uploads/profile/' . (Auth::user()->profile_picture ?? 'default.png')) }}"
                    class="img-circle elevation-2"
                    alt="User Image"
                    style="width: 45px; height: 45px; object-fit: cover; border: 2px solid white;">
            </div>
            <div class="info ml-2">
                <a href="#" class="d-block text-dark font-weight-bold">
                    {{-- {{ Auth::user()->username }} --}}
                </a>
                <span class="badge badge-success">Online</span>
                <span class="d-block" style="color: #f39c12; font-size: 14px; font-weight: 600;">
                    {{ Auth::user()->role->role_name ?? 'Unknown' }}
                </span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-primary"></i>
                        <p class="ml-1">Dashboard Utama</p>
                    </a>
                </li>

                @php
                    $isPeranPengguna = request()->is('dashboard-peran*') || request()->is('role*') || request()->is('user*');
                @endphp
                <li class="nav-item has-treeview {{ $isPeranPengguna ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isPeranPengguna ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users text-primary"></i>
                        <p>
                            Peran & Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="{{ $isPeranPengguna ? 'display:block;' : '' }}">
                        <li class="nav-item">
                            <a href="{{ url('dashboard-peran') }}" class="nav-link">
                                <i class="fas fa-columns nav-icon text-secondary"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('role') }}" class="nav-link">
                                <i class="fas fa-user-shield nav-icon text-secondary"></i>
                                <p>Master Peran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('user') }}" class="nav-link">
                                <i class="fas fa-users-cog nav-icon text-secondary"></i>
                                <p>Master Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
