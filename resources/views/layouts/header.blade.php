<!DOCTYPE html>
<html>
<head>
    <style>
        /* ==================== HEADER CSS ==================== */
        /* ==================== HEADER YANG DIPERBAIKI ==================== */
        .navbar.default-layout-navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: auto;
            min-width: 250px;
            padding: 0 15px;
        }

        .brand-logo {
            display: flex !important;
            align-items: center !important;
            text-decoration: none !important;
            height: 70px !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Container utama header dengan flex horizontal */
        .header-logo-container {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 15px !important;
            width: 100% !important;
            height: 100% !important;
            padding: 5px 0 !important;
            overflow: hidden !important;
        }

        /* Wrapper untuk logo - hanya satu logo */
        .logo-wrapper {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 60px !important;
            height: 60px !important;
            flex-shrink: 0;
        }

        /* Logo gambar - ukuran proporsional */
        .header-logo-img {
            width: 100% !important;
            height: 100% !important;
            object-fit: contain !important;
            display: block !important;
            background: none !important;
            border: none !important;
        }

        /* Container teks */
        .header-text-container {
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            justify-content: center !important;
            line-height: 1.2 !important;
            max-width: 280px !important;
            min-height: 60px !important;
            overflow: hidden !important;
        }

        /* Judul utama - satu baris */
        .header-title {
            color: #28a745 !important;
            font-size: 16.1px !important;
            font-weight: 800 !important;
            margin: 0 !important;
            padding: 0 !important;
            text-align: center !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            letter-spacing: 0.5px;
        }

        /* Subjudul - maksimal dua baris */
        .header-subtitle {
            color: #6c757d !important;
            font-size: 8.7px !important;
            font-weight: 500 !important;
            margin: 2px 0 0 0 !important;
            padding: 0 !important;
            text-align: center !important;
            white-space: normal !important;
            line-height: 1.3 !important;
            overflow: hidden !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            max-width: 100% !important;
        }

        /* Navbar menu wrapper */
        .navbar-menu-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        /* Navbar nav right */
        .navbar-nav-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Hamburger menu button */
        .navbar-toggler {
            border: none;
            background: transparent;
            color: #495057;
            font-size: 1.5rem;
            padding: 8px;
            margin-left: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            color: #28a745;
            transform: scale(1.1);
        }

        /* Profile dropdown */
        .nav-profile .nav-link {
            padding: 5px 12px !important;
            border-radius: 20px !important;
            transition: all 0.3s ease !important;
        }

        .nav-profile .nav-link:hover {
            background: rgba(40, 167, 69, 0.1) !important;
        }

        /* Responsive design untuk header */
        @media (max-width: 991px) {
            .navbar-brand-wrapper {
                min-width: 200px;
            }

            .header-title {
                font-size: 16px !important;
            }

            .header-subtitle {
                font-size: 10px !important;
                -webkit-line-clamp: 1 !important;
            }

            .search-field {
                max-width: 300px;
                margin: 0 10px;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand-wrapper {
                min-width: 180px;
                padding: 0 10px;
            }

            .logo-wrapper {
                min-width: 50px !important;
                height: 50px !important;
            }

            .header-title {
                font-size: 14px !important;
            }

            .header-subtitle {
                font-size: 9px !important;
                -webkit-line-clamp: 1 !important;
            }

            .search-field {
                display: none !important;
            }

            .navbar-menu-wrapper {
                padding: 0 10px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand-wrapper {
                min-width: 150px;
            }

            .header-text-container {
                max-width: 120px !important;
            }

            .header-title {
                font-size: 12px !important;
                white-space: normal !important;
                -webkit-line-clamp: 1 !important;
            }

            .header-subtitle {
                display: none !important;
            }
        }

        /* Pastikan logo tidak duplikat saat sidebar collapse */
        @media (max-width: 991px) {
            .navbar-brand-wrapper .brand-logo {
                display: flex !important;
            }

            .navbar-brand-wrapper .brand-logo-mini {
                display: none !important;
            }
        }

        /* ==================== HEADER RESPONSIVE FIXES ==================== */
        /* Responsive design untuk header - Mode Mobile/Split Screen */
        @media (max-width: 991px) {
            /* Sembunyikan teks header di bagian kiri */
            .header-text-container {
                display: none !important;
            }

            /* Hanya tampilkan logo saja */
            .navbar-brand-wrapper {
                min-width: auto !important;
                width: auto !important;
            }

            .logo-wrapper {
                min-width: 50px !important;
                height: 50px !important;
            }

            /* Atur ulang navbar menu wrapper */
            .navbar-menu-wrapper {
                justify-content: flex-end !important;
                padding: 0 10px !important;
                flex: 1;
            }

            /* Posisikan notification dan profile ke kanan */
            .navbar-nav-right {
                display: flex !important;
                align-items: center !important;
                gap: 5px !important;
                margin-left: auto !important;
            }

            /* Hamburger menu di kiri */
            .navbar-toggler[data-toggle="minimize"] {
                order: -1;
                margin-right: 10px;
            }

            /* Notification bell */
            .nav-item.dropdown {
                margin-right: 5px;
            }

            /* Profile section - tampilkan hanya avatar di mobile */
            .nav-profile .nav-profile-text {
                display: none !important;
            }

            .nav-profile .nav-profile-img {
                margin-right: 0 !important;
            }

            /* Profile dropdown tetap full */
            .nav-profile .dropdown-menu {
                min-width: 280px !important;
            }
        }

        /* Untuk tampilan sangat kecil (mobile kecil) */
        @media (max-width: 576px) {
            .navbar-brand-wrapper {
                min-width: 60px !important;
            }

            .logo-wrapper {
                min-width: 45px !important;
                height: 45px !important;
            }

            /* Search field disembunyikan di mobile */
            .search-field {
                display: none !important;
            }

            /* Perkecil notification icon */
            .nav-link.count-indicator {
                padding: 5px !important;
            }

            /* Perkecil profile avatar */
            .nav-profile .profile-avatar-circle {
                width: 35px !important;
                height: 35px !important;
            }
        }

        /* Untuk tampilan desktop/laptop - tetap seperti semula */
        @media (min-width: 992px) {
            .navbar-brand-wrapper {
                min-width: 250px !important;
            }

            .header-text-container {
                display: flex !important;
            }

            .navbar-menu-wrapper {
                justify-content: space-between !important;
            }

            .nav-profile .nav-profile-text {
                display: flex !important;
            }
        }

        /* ==================== PROFILE SECTION STYLES ==================== */
        /* Avatar dengan foto profil */
        .profile-avatar-circle {
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
            transition: all 0.3s ease;
            overflow: hidden;
            border: 2px solid white;
        }

        .nav-profile .profile-avatar-circle {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }

        /* Avatar yang menampilkan gambar profil */
        .avatar-with-image {
            background: none !important;
        }

        .avatar-with-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .avatar-with-image i {
            display: none;
        }

        .nav-profile .nav-profile-text {
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            line-height: 1.2 !important;
        }

        .nav-profile .profile-name {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
        }

        .nav-profile .profile-email {
            font-size: 12px;
            color: #666;
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Dropdown Profile Menu */
        .profile-dropdown-header {
            background: linear-gradient(135deg, #28a745, #20c997);
            padding: 25px 20px;
            text-align: center;
            color: white;
            position: relative;
            border-radius: 0 0 10px 10px;
        }

        .profile-avatar-large {
            margin-bottom: 15px;
        }

        .avatar-circle {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            border: 3px solid white;
        }

        /* Avatar besar dengan gambar */
        .avatar-circle.has-image {
            background: none !important;
        }

        .avatar-circle.has-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-circle.has-image i {
            display: none;
        }

        .avatar-circle i {
            font-size: 2.5rem;
            color: #28a745;
        }

        .profile-info-header h5 {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 5px 0;
            color: white;
        }

        .profile-info-header p {
            font-size: 0.9rem;
            margin: 0 0 5px 0;
            color: rgba(255, 255, 255, 0.9);
        }

        .user-role-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 5px;
        }

        .user-role-badge i {
            margin-right: 5px;
            font-size: 0.8rem;
        }

        .profile-dropdown-body {
            padding: 15px 0;
        }

        .dropdown-item-section {
            padding: 0 15px;
        }

        .dropdown-section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #6c757d;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin: 0 0 10px 0;
            padding-left: 10px;
        }

        /* PROFIL ITEM STYLE - TAMPILAN VERTIKAL RAPI */
        .profile-item {
            display: flex !important;
            align-items: center !important;
            padding: 12px 15px !important;
            border-radius: 8px !important;
            margin: 5px 10px !important;
            transition: all 0.3s ease !important;
            border: none !important;
            color: #333 !important;
            background: transparent !important;
            text-align: left;
            width: calc(100% - 20px);
        }

        .profile-item:hover {
            background-color: #f8f9fa !important;
            transform: translateX(5px) !important;
            text-decoration: none !important;
        }

        .profile-item .item-icon {
            width: 36px;
            height: 36px;
            background: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: #28a745;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .profile-item .item-content {
            flex: 1;
            min-width: 0;
        }

        .profile-item .item-title {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 3px;
            line-height: 1.2;
        }

        .profile-item .item-subtitle {
            display: block;
            font-size: 0.75rem;
            color: #6c757d;
            line-height: 1.2;
        }

        .profile-item .mdi-chevron-right {
            color: #adb5bd;
            font-size: 1.1rem;
            margin-left: 10px;
            flex-shrink: 0;
        }

        /* LOGOUT ITEM STYLE */
        .logout-section .logout-item {
            background-color: rgba(220, 53, 69, 0.05) !important;
            border: 1px solid rgba(220, 53, 69, 0.1) !important;
        }

        .logout-section .logout-item:hover {
            background-color: rgba(220, 53, 69, 0.1) !important;
            border-color: rgba(220, 53, 69, 0.2) !important;
        }

        .logout-section .item-icon {
            background: rgba(220, 53, 69, 0.1) !important;
            color: #dc3545 !important;
        }

        /* ITEM TANPA ICON CHEVRON */
        .profile-item.no-chevron .mdi-chevron-right {
            display: none;
        }

        /* MEMASTIKAN SEMUA ITEM SEJAJAR VERTIKAL */
        .profile-item-container {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 5px;
        }

        .dropdown-divider {
            margin: 10px 15px !important;
            border-color: #e9ecef !important;
        }
    </style>
</head>
<body>
    <!-- ==================== START HEADER YANG DIPERBAIKI ==================== -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <!-- LOGO UTAMA - HANYA SATU -->
            <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
                <div class="header-logo-container">
                    <!-- Logo di kiri -->
                    <div class="logo-wrapper">
                        <img src="{{ asset('assets-admin/images/logopariwisata.png') }}"
                             class="header-logo-img"
                             alt="Logo Pariwisata Desa"
                             onerror="this.onerror=null; this.src='{{ asset('assets-admin/images/logo-default.png') }}';">
                    </div>
                    <!-- Teks di kanan - akan disembunyikan di mobile -->
                    <div class="header-text-container">
                        <div class="header-title">PARIWISATA DESA</div>
                        <div class="header-subtitle">SISTEM ADMINISTRASI PARIWISATA DAN HOMESTAY DESA</div>
                    </div>
                </div>
            </a>

            <!-- LOGO MINI - DISEMBUNYIKAN -->
            <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}" style="display: none;">
                <div class="header-logo-container">
                    <div class="logo-wrapper">
                        <img src="{{ asset('assets-admin/images/logopariwisata.png') }}"
                             class="header-logo-img"
                             alt="Logo"
                             onerror="this.onerror=null; this.src='{{ asset('assets-admin/images/logo-default.png') }}';">
                    </div>
                </div>
            </a>
        </div>

        <!-- ==================== BAGIAN KANAN HEADER ==================== -->
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <!-- Hamburger menu untuk toggle sidebar -->
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>

            <!-- Search field -->
            <div class="search-field d-none d-xl-block">
                <form class="d-flex align-items-center h-100" action="#">
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                            <i class="input-group-text border-0 mdi mdi-magnify"></i>
                        </div>
                        <input type="text" class="form-control bg-transparent border-0"
                            placeholder="Cari data...">
                    </div>
                </form>
            </div>

            <ul class="navbar-nav navbar-nav-right">
                <!-- Notification Bell -->
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                        data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        <span class="count-symbol bg-danger">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                        aria-labelledby="notificationDropdown">
                        <h6 class="p-3 mb-0 bg-primary text-white">Notifikasi</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="mdi mdi-home"></i>
                                </div>
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal">Booking Baru</h6>
                                <p class="text-gray ellipsis mb-0">1 booking homestay baru</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-warning">
                                    <i class="mdi mdi-star"></i>
                                </div>
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal">Ulasan Baru</h6>
                                <p class="text-gray ellipsis mb-0">3 ulasan wisata baru</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-info">
                                    <i class="mdi mdi-account"></i>
                                </div>
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal">User Baru</h6>
                                <p class="text-gray ellipsis mb-0">1 user baru dibuat</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <h6 class="p-3 mb-0 text-center"><a href="#" class="text-primary">Lihat semua
                                notifikasi</a></h6>
                    </div>
                </li>

                <!-- Profile Section -->
                @php
                    $user = Auth::user();
                    $hasProfilePicture = !empty($user->profile_picture);
                @endphp

               <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" id="profileDropdown"
                            href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img mr-3">
                                <div class="profile-avatar-circle {{ $hasProfilePicture ? 'avatar-with-image' : '' }}">
                                    @if($hasProfilePicture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                             alt="{{ $user->name }}"
  style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="mdi mdi-account"></i>
                        @endif
                            </div>
                        </div>
                        <div class="nav-profile-text d-flex flex-column">
                            <span class="profile-name">{{ $user->name ?? 'Guest' }}</span>
                            <span class="profile-email">{{ $user->email ?? 'admin@example.com' }}</span>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0"
                        aria-labelledby="profileDropdown" data-x-placement="bottom-end" style="min-width: 300px;">

                        <!-- Profile Header -->
                        <div class="profile-dropdown-header">
                            <div class="profile-avatar-large">
                                <div class="avatar-circle {{ $hasProfilePicture ? 'has-image' : '' }}">
                                    @if($hasProfilePicture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                             alt="{{ $user->name }}"
  style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="mdi mdi-account"></i>
                        @endif
                                </div>
                            </div>
                            <div class="profile-info-header">
                                <h5>{{ $user->name ?? 'Guest' }}</h5>
                                <p>{{ $user->email ?? 'admin@example.com' }}</p>
                                <div class="user-role-badge">
                                    <i class="mdi mdi-shield-check"></i> {{ strtoupper($user->role ?? 'ADMIN') }}
                                </div>
                            </div>
                        </div>

                        <!-- Profile Menu Items -->
                        <div class="profile-dropdown-body">
                            <div class="dropdown-item-section">
                                <h6 class="dropdown-section-title">AKUN PENGGUNA</h6>

                                <div class="profile-item-container">
                                    <!-- Profil Saya -->
                                    <a class="dropdown-item profile-item" href="{{ route('user.my-profile') }}">
                                        <div class="item-icon">
                                            <i class="mdi mdi-account-circle"></i>
                                        </div>
                                        <div class="item-content">
                                            <span class="item-title">Profil Saya</span>
                                            <span class="item-subtitle">Kelola informasi profil Anda</span>
                                        </div>
                                        <i class="mdi mdi-chevron-right"></i>
                                    </a>

                                    <!-- Pengaturan -->
                                    <a class="dropdown-item profile-item" href="#">
                                        <div class="item-icon">
                                             <i class="mdi mdi-settings"></i>
                                        </div>
                                        <div class="item-content">
                                            <span class="item-title">Setting</span>
                                            <span class="item-subtitle">Personalasi sistem Anda</span>
                                        </div>
                                        <i class="mdi mdi-chevron-right"></i>
                                    </a>

                                    <!-- Login Terakhir -->
                                    <div class="dropdown-item profile-item no-chevron">
                                        <div class="item-icon">
                                            <i class="mdi mdi-clock-outline"></i>
                                        </div>
                                        <div class="item-content">
                                            <span class="item-title">Login Terakhir</span>
                                            <span class="item-subtitle">
                                                {{ session('last_login') ?? now()->format('Y-m-d H:i:s') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <!-- Logout Section -->
                            <div class="logout-section">
                                <div class="profile-item-container">
                                    <a class="dropdown-item logout-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <div class="item-icon">
                                            <i class="mdi mdi-logout"></i>
                                        </div>
                                        <div class="item-content">
                                            <span class="item-title">Logout</span>
                                            <span class="item-subtitle">Keluar dari sistem</span>
                                        </div>
                                        <i class="mdi mdi-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <!-- Hamburger menu untuk mobile -->
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- ==================== END HEADER ==================== -->
</body>
</html>
