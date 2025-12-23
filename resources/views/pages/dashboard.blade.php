<!DOCTYPE html>
<html lang="id">

<head>
    <!-- ==================== START HEAD ==================== -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pariwisata Desa - Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets-admin/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets-admin/images/favicon.png') }}">

    <!-- ==================== START CSS ==================== -->
    <style>
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

        /* ==================== SLIDESHOW YANG DIPERBAIKI ==================== */
        .slideshow-section {
            position: relative;
            width: 100%;
            height: 250px;
            border-radius: 15px;
            overflow: hidden;
            margin: 30px 0 40px 0;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        }

        /* Slideshow slides */
        .slideshow-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 1;
        }

        .slideshow-slide.active {
            opacity: 1;
            z-index: 2;
        }

        /* Carousel overlay - DIPERBAIKI: overlay hanya untuk gambar, tidak untuk teks */
        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 3;
            pointer-events: none; /* Agar tidak mengganggu interaksi dengan konten */
        }

        /* Slideshow content - tanpa overlay di dalam teks */
        .slideshow-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 4;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 30px;
            color: white;
            pointer-events: none; /* Agar tidak mengganggu slider */
        }

        /* Container untuk Selamat Datang dan Nama - SEJAJAR */
        .welcome-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 6px;
            flex-wrap: wrap;
            pointer-events: auto; /* Mengizinkan seleksi teks */
        }

        /* Selamat Datang - WARNA COKLAT dan TEBAL */
        .welcome-title {
            font-size: 2rem !important;
            font-weight: 800 !important;
            margin: 0 !important;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
            color: #FFFFFF !important;
            line-height: 1.1;
            pointer-events: auto;
        }

        /* Nama pengguna - PUTIH dan TEBAL */
        .user-name {
            font-size: 2rem !important;
            font-weight: 800 !important;
            color: #FFFFFF !important; /* Warna putih */
            margin: 0 !important;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
            line-height: 1.1;
            pointer-events: auto;
        }

        /* Dashboard Monitoring - PUTIH TANPA OVERLAY dalam teks */
        .welcome-subtitle {
            font-size: 1.2rem !important;
            font-weight: 500 !important;
            max-width: 800px;
            line-height: 1.1;
            margin: 0 !important;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
            color: #FFFFFF !important; /* Warna putih */
            padding: 10px 20px;
            border-radius: 8px;
            pointer-events: auto;
        }

        /* Carousel buttons */
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 5;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            pointer-events: auto;
        }

        .carousel-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-btn.prev {
            left: 20px;
        }

        .carousel-btn.next {
            right: 20px;
        }

        /* Slideshow controls */
        .slideshow-controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 5;
            pointer-events: auto;
        }

        .slide-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slide-indicator.active {
            background: #28a745;
            transform: scale(1.2);
        }

        /* Responsive slideshow */
        @media (max-width: 768px) {
            .slideshow-section {
                height: 200px;
                margin: 20px 0 30px 0;
            }

            .welcome-title {
                font-size: 1.5rem !important;
            }

            .user-name {
                font-size: 1.5rem !important;
            }

            .welcome-subtitle {
                font-size: 1rem !important;
                padding: 8px 15px;
            }

            .welcome-container {
                gap: 5px;
                margin-bottom: 15px;
            }

            .carousel-btn {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .slideshow-section {
                height: 180px;
                margin: 15px 0 25px 0;
            }

            .welcome-title {
                font-size: 1.2rem !important;
            }

            .user-name {
                font-size: 1.2rem !important;
            }

            .welcome-subtitle {
                font-size: 0.9rem !important;
                padding: 6px 12px;
            }

            .slideshow-content {
                padding: 20px;
            }

            .welcome-container {
                flex-direction: column;
                gap: 2px;
                margin-bottom: 10px;
            }
        }

        /* HAPUS Dashboard Overview */
        .card-header-section {
            display: none !important;
        }

        /* ==================== PROFILE SECTION STYLES TIDAK BERUBAH ==================== */
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

        /* ==================== SIDEBAR PROFILE STYLES ==================== */
        /* Sidebar Menu Items - DIUBAH UKURAN SEPERTI TEMPLATE LAMA */
        .nav {
            padding: 0 5px;
        }

        .nav-category {
            margin-top: 10px !important;
            font-size: 10px !important;
            padding: 8px 10px !important;
            color: rgba(255, 255, 255, 0.6) !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        /* Menu Item Style - DIUBAH SEPERTI TEMPLATE LAMA */
        .nav-item .nav-link {
            padding: 10px 12px !important;
            border-radius: 8px !important;
            margin-bottom: 3px !important;
            display: flex !important;
            align-items: center !important;
        }

        .nav-item .nav-link:hover {
            background: rgba(255, 255, 255, 0.1) !important;
        }

        .nav-item .nav-link .icon-bg {
            margin-right: 10px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .nav-item .nav-link .menu-icon {
            font-size: 16px !important;
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .nav-item .nav-link .menu-title {
            font-size: 13px !important;
            font-weight: 500 !important;
            color: rgba(255, 255, 255, 0.9) !important;
        }

        /* Sub-menu Style - DIUBAH SEPERTI TEMPLATE LAMA */
        .sub-menu {
            padding-left: 10px !important;
            margin-top: 3px !important;
            margin-bottom: 3px !important;
        }

        .sub-menu .nav-link {
            padding: 6px 10px !important;
            font-size: 12px !important;
            border-radius: 6px !important;
            margin-bottom: 2px !important;
        }

        .sub-menu .nav-link i {
            font-size: 12px !important;
            margin-right: 6px !important;
            width: 16px !important;
            text-align: center !important;
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .sub-menu .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .sub-menu .nav-link:hover {
            background: rgba(255, 255, 255, 0.05) !important;
        }

        /* User Display & Settings di Sidebar - DIUBAH SEPERTI TEMPLATE LAMA */
        .sidebar-user-actions {
            margin-top: 15px !important;
            padding: 10px 5px !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        /* Sidebar Profile dengan Foto */
        .user-avatar-small {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            margin-right: 10px;
            box-shadow: 0 3px 10px rgba(40, 167, 69, 0.3);
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.3);
            flex-shrink: 0;
        }

        /* Avatar kecil dengan gambar */
        .user-avatar-small.has-image {
            background: none !important;
        }

        .user-avatar-small.has-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-avatar-small.has-image i {
            display: none;
        }

        .user-display-section {
            display: flex;
            align-items: center;
            padding: 8px;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.2), rgba(32, 201, 151, 0.1));
            border-radius: 6px;
            margin-bottom: 10px;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .user-info-small h5 {
            margin: 0;
            font-size: 0.85rem;
            font-weight: 700;
            color: white;
        }

        .user-info-small p {
            margin: 0;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Original CSS styles tetap ada di bawah */
        .nav-dropdown {
            list-style: none;
            padding-left: 0;
            margin: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .nav-dropdown.show {
            max-height: 500px;
        }

        .nav-dropdown .nav-item {
            padding-left: 20px;
        }

        .dropdown-toggle {
            position: relative;
            cursor: pointer;
        }

        .dropdown-toggle::after {
            content: '\f140';
            font-family: 'Material Design Icons';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.3s ease;
            border: none !important;
            width: auto;
            height: auto;
            color: rgba(255, 255, 255, 0.7);
        }

        .dropdown-toggle[aria-expanded="true"]::after {
            transform: translateY(-50%) rotate(180deg);
        }

        /* ==================== FLOATING WHATSAPP BUTTON ==================== */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            animation: pulse 2s infinite;
        }

        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.3);
        }

        .whatsapp-float i {
            margin: 0;
        }

        /* WhatsApp Tooltip */
        .whatsapp-tooltip {
            position: absolute;
            right: 70px;
            bottom: 15px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .whatsapp-float:hover .whatsapp-tooltip {
            opacity: 1;
            transform: translateX(0);
        }

        /* Pulse Animation */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* Circular Progress Styles - Like Reference */
        .circular-progress-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .circular-progress-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .circular-progress-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .circular-progress-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .circular-progress {
            position: relative;
            width: 80px;
            height: 80px;
            flex-shrink: 0;
        }

        .circular-progress-bg {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #f8f9fa;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .circular-progress-ring {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(var(--progress-color) 0% var(--progress-percent), #e9ecef var(--progress-percent) 100%);
            mask: radial-gradient(transparent 60%, black 61%);
            -webkit-mask: radial-gradient(transparent 60%, black 61%);
        }

        .circular-progress-content {
            text-align: center;
            z-index: 2;
        }

        .circular-progress-icon {
            font-size: 24px;
            color: var(--progress-color);
            margin-bottom: 5px;
        }

        .circular-progress-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1;
        }

        .circular-progress-info {
            flex: 1;
        }

        .circular-progress-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .circular-progress-trend {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .trend-up {
            color: #28a745;
        }

        .trend-down {
            color: #dc3545;
        }

        /* Color variations for circular progress */
        .progress-warga {
            --progress-color: #667eea;
            --progress-percent: 75%;
        }

        .progress-wisata {
            --progress-color: #f093fb;
            --progress-percent: 25%;
        }

        .progress-user {
            --progress-color: #4facfe;
            --progress-percent: 60%;
        }

        .progress-aktivitas {
            --progress-color: #43e97b;
            --progress-percent: 85%;
        }

        .progress-homestay {
            --progress-color: #ff9a9e;
            --progress-percent: 45%;
        }

        .progress-kamar {
            --progress-color: #a18cd1;
            --progress-percent: 65%;
        }

        .progress-booking {
            --progress-color: #fad0c4;
            --progress-percent: 85%;
        }

        .progress-ulasan {
            --progress-color: #ffecd2;
            --progress-percent: 55%;
        }

        /* Period Selector */
        .period-selector {
            background: white;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .btn-period {
            border: none;
            background: transparent;
            color: #6c757d;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 600;
            margin: 0 2px;
        }

        .btn-period.active {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-period:hover {
            background: #e9ecef;
            color: #495057;
        }

        /* Chart Container */
        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            transition: transform 0.3s ease;
        }

        .chart-container:hover {
            transform: translateY(-3px);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        /* Chart Canvas */
        .chart-wrapper {
            height: 300px;
            position: relative;
        }

        /* Recent Activity */
        .activity-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .activity-card:hover {
            transform: translateY(-3px);
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f8f9fa;
            transition: background-color 0.3s ease;
        }

        .activity-item:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 18px;
            color: white;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .activity-desc {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .activity-time {
            font-size: 0.75rem;
            color: #adb5bd;
            margin-top: 2px;
        }

        .activity-percent {
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Header Styles */
        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .card-subtitle {
            font-size: 1rem;
            color: #6c757d;
            margin-top: 5px;
        }

        .welcome-message {
            font-size: 1.1rem;
            color: #28a745;
            font-weight: 600;
        }

        /* Profile Display Styles */
        .profile-display {
            display: flex;
            align-items: center;
            padding: 15px;
            background: transparent;
            border-radius: 10px;
            margin-bottom: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-right: 15px;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .profile-info h5 {
            margin: 0;
            font-weight: 700;
            color: white;
        }

        .profile-info p {
            margin: 0;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Logout Button */
        .logout-btn {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
            color: white;
            text-decoration: none;
        }

        .logout-btn i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        /* Perbaikan alignment header profile */
        .navbar-nav-right .nav-profile .nav-link {
            display: flex !important;
            align-items: center !important;
            padding: 8px 15px !important;
            border-radius: 30px !important;
            transition: all 0.3s ease !important;
        }

        .navbar-nav-right .nav-profile .nav-profile-img {
            margin-right: 10px !important;
        }

        .navbar-nav-right .nav-profile .nav-profile-text {
            display: flex !important;
            align-items: center !important;
        }

        /* Hover effect untuk profile header */
        .navbar-nav-right .nav-profile .nav-link:hover {
            background: rgba(0, 0, 0, 0.05) !important;
            transform: translateY(-2px) !important;
        }

        /* New Cards Section */
        .new-cards-section {
            margin-top: 30px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #28a745;
        }

        /* Responsive Design untuk bagian lain */
        @media (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
                font-size: 25px;
            }

            .whatsapp-tooltip {
                right: 60px;
                bottom: 10px;
                font-size: 11px;
                padding: 6px 10px;
            }

            .circular-progress-wrapper {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .circular-progress-info {
                text-align: center;
            }

            .chart-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            /* Profile Responsive */
            .nav-profile .profile-email {
                max-width: 120px;
            }

            .profile-dropdown-header {
                padding: 20px 15px;
            }

            .avatar-circle {
                width: 60px;
                height: 60px;
            }

            .avatar-circle i {
                font-size: 2rem;
            }

            .profile-item {
                padding: 10px 12px !important;
                margin: 3px 8px !important;
            }
        }

        /* Visitor Stats Badge */
        .visitor-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 10px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .visitor-badge i {
            margin-right: 5px;
        }

        /* Activity Status */
        .activity-status {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .status-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .status-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .status-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        /* ==================== DEVELOPER IDENTITY & SETTINGS CSS ==================== */
        .settings-logout-section {
            margin-top: 15px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .settings-item {
            display: flex;
            align-items: center;
            padding: 8px 10px;
            border-radius: 6px;
            margin-bottom: 6px;
            transition: all 0.3s ease;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.05);
        }

        .settings-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(3px);
        }

        .settings-item i {
            margin-right: 8px;
            width: 18px;
            text-align: center;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .settings-item span {
            font-size: 0.85rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
        }

        .logout-item-sidebar {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 6px;
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-item-sidebar:hover {
            background: rgba(220, 53, 69, 0.25);
            transform: translateX(3px);
            text-decoration: none;
        }

        .logout-item-sidebar i {
            margin-right: 8px;
            width: 18px;
            text-align: center;
            font-size: 1rem;
            color: #dc3545;
        }

        .logout-item-sidebar span {
            font-size: 0.85rem;
            font-weight: 600;
            color: #dc3545;
        }

        /* ==================== PROFIL PENGEMBANG YANG DIREDESAIN ULANG ==================== */
        .developer-profile-new {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            margin: 40px 0;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(40, 167, 69, 0.15);
            transition: all 0.4s ease;
        }

        .developer-profile-new:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .developer-profile-new::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #28a745, #20c997, #667eea);
        }

        /* ==================== LAYOUT FOTO DAN INFORMASI YANG LEBIH BAIK ==================== */
        .developer-profile-header-new {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 2px solid rgba(40, 167, 69, 0.1);
            flex-wrap: wrap;
            gap: 40px;
        }

        /* Foto yang lebih menarik */
        .developer-photo-new {
            width: 220px;
            height: 310px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 8px solid rgb(93, 134, 96);
            flex-shrink: 0;
            position: relative;
            transition: all 0.4s ease;
        }

        .developer-photo-new:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
        }

        .developer-photo-new::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(102, 126, 234, 0.1));
            z-index: 1;
            pointer-events: none;
        }

        .developer-photo-new img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.6s ease;
        }

        .developer-photo-new:hover img {
            transform: scale(1.05);
        }

        /* Informasi Developer */
        .developer-info-new {
            flex: 1;
            min-width: 300px;
        }

        /* NAMA BESAR YANG MENARIK */
        .developer-name {
            font-size: 2.8rem;
            font-weight: 900;
            color: #2c3e50;
            margin-bottom: 30px;
            letter-spacing: 1.5px;
            line-height: 1.1;
            text-align: left;
            background: linear-gradient(135deg, #28a745, #20c997, #667eea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .developer-name::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #28a745, #20c997);
            border-radius: 2px;
        }

        /* INFORMASI DUA KOLOM YANG RAPI */
        .developer-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.8);
            padding: 15px;
            border-radius: 12px;
            border-left: 4px solid #28a745;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .detail-item:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .detail-label {
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: 700;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-label i {
            color: #28a745;
            font-size: 1rem;
        }

        .detail-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
            padding: 8px 0;
            border-bottom: none;
        }

        .detail-value a {
            color: #28a745;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .detail-value a:hover {
            color: #20c997;
            transform: translateX(3px);
        }

        .detail-value a i {
            font-size: 1.1rem;
        }

        /* Judul Profil */
        .profile-title-new {
            font-size: 2rem;
            font-weight: 900;
            color: #2c3e50;
            margin-bottom: 10px;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            text-align: center;
            background: linear-gradient(135deg, #28a745, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .profile-subtitle-new {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 30px;
            font-weight: 500;
            text-align: center;
        }

        /* Deskripsi Proyek yang Diperbaiki */
        .project-description {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.08), rgba(32, 201, 151, 0.08));
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            border-left: 6px solid #28a745;
            position: relative;
            overflow: hidden;
        }

        .project-description::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%2328a745' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.3;
        }

        .project-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 2;
        }

        .project-title i {
            color: #28a745;
            font-size: 1.6rem;
        }

        .project-text {
            font-size: 1.05rem;
            line-height: 1.7;
            color: #495057;
            margin-bottom: 0;
            position: relative;
            z-index: 2;
            text-align: justify;
        }

        .project-text strong {
            color: #28a745;
            font-weight: 700;
        }

        /* Quote Section yang Lebih Menarik */
        .quote-section-new {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.08), rgba(117, 75, 162, 0.08));
            border-radius: 15px;
            padding: 35px 40px;
            margin: 30px 0;
            position: relative;
            border-left: 6px solid #667eea;
            overflow: hidden;
        }

        .quote-section-new::before {
            content: '❝';
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 5rem;
            color: rgba(102, 126, 234, 0.1);
            font-family: serif;
        }

        .quote-section-new::after {
            content: '❞';
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-size: 5rem;
            color: rgba(102, 126, 234, 0.1);
            font-family: serif;
        }

        .quote-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2.5rem;
            color: rgba(102, 126, 234, 0.2);
            z-index: 1;
        }

        .quote-text-new {
            font-size: 1.25rem;
            font-style: italic;
            line-height: 1.6;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
            z-index: 2;
            font-weight: 500;
        }

        .quote-author-new {
            text-align: right;
            font-weight: 700;
            color: #667eea;
            font-size: 1.1rem;
            padding-top: 15px;
            border-top: 2px solid rgba(102, 126, 234, 0.2);
            position: relative;
            z-index: 2;
        }

        /* ==================== SOCIAL MEDIA LOGOS YANG LEBIH BAGUS ==================== */
        .social-links-new {
            display: flex;
            gap: 25px;
            margin-top: 35px;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 249, 250, 0.9));
            border-radius: 15px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .social-link-new {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.4s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }

        .social-link-new::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .social-link-new:hover {
            transform: translateY(-8px) scale(1.1);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
        }

        .social-link-new:hover::before {
            opacity: 1;
        }

        .social-link-new i {
            font-size: 28px;
            color: white;
            z-index: 2;
            transition: transform 0.3s ease;
        }

        .social-link-new:hover i {
            transform: scale(1.2);
        }

        /* Instagram - Gradient yang Lebih Bagus */
        .social-instagram-new {
            background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D, #F56040, #F77737, #FCAF45, #FFDC80);
            background-size: 400% 400%;
            animation: instagram-gradient 3s ease infinite;
        }

        @keyframes instagram-gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* LinkedIn - Blue */
        .social-linkedin-new {
            background: linear-gradient(135deg, #0077B5, #00A0DC, #0A66C2);
        }

        /* GitHub - Dark Theme */
        .social-github-new {
            background: linear-gradient(135deg, #333333, #24292e, #0d1117);
        }

        /* Email - Green */
        .social-email-new {
            background: linear-gradient(135deg, #28a745, #20c997, #1ed760);
        }

        /* Tooltip untuk logo */
        .social-tooltip {
            position: absolute;
            bottom: -35px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.85);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
            opacity: 0;
            transition: all 0.3s ease;
            pointer-events: none;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .social-tooltip::before {
            content: '';
            position: absolute;
            top: -5px;
            left: 50%;
            transform: translateX(-50%);
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid rgba(0, 0, 0, 0.85);
        }

        .social-link-new:hover .social-tooltip {
            opacity: 1;
            bottom: -30px;
        }

        /* ==================== RESPONSIVE UNTUK PROFIL PENGEMBANG ==================== */
        @media (max-width: 1024px) {
            .developer-profile-header-new {
                gap: 30px;
            }

            .developer-photo-new {
                width: 200px;
                height: 260px;
            }

            .developer-name {
                font-size: 2.4rem;
            }

            .developer-details-grid {
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .developer-profile-new {
                padding: 30px;
            }

            .developer-profile-header-new {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 25px;
            }

            .developer-photo-new {
                width: 180px;
                height: 230px;
            }

            .developer-info-new {
                min-width: 100%;
                text-align: center;
            }

            .developer-name {
                font-size: 2.2rem;
                text-align: center;
            }

            .developer-name::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .developer-details-grid {
                grid-template-columns: 1fr;
                gap: 15px;
                text-align: left;
            }

            .detail-item {
                text-align: left;
            }

            .social-links-new {
                gap: 20px;
            }

            .social-link-new {
                width: 65px;
                height: 65px;
            }

            .social-link-new i {
                font-size: 26px;
            }

            .quote-text-new {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 576px) {
            .developer-profile-new {
                padding: 25px 20px;
            }

            .developer-photo-new {
                width: 160px;
                height: 200px;
            }

            .developer-name {
                font-size: 1.8rem;
            }

            .profile-title-new {
                font-size: 1.6rem;
            }

            .profile-subtitle-new {
                font-size: 1rem;
            }

            .project-description,
            .quote-section-new {
                padding: 20px;
            }

            .project-title {
                font-size: 1.2rem;
            }

            .project-text {
                font-size: 0.95rem;
            }

            .quote-text-new {
                font-size: 1rem;
            }

            .social-links-new {
                gap: 15px;
                padding: 15px;
            }

            .social-link-new {
                width: 60px;
                height: 60px;
            }

            .social-link-new i {
                font-size: 24px;
            }

            .detail-value {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .developer-profile-header-new {
                gap: 20px;
            }

            .developer-photo-new {
                width: 140px;
                height: 180px;
                border-width: 6px;
            }

            .developer-name {
                font-size: 1.6rem;
                margin-bottom: 20px;
            }

            .social-links-new {
                gap: 12px;
            }

            .social-link-new {
                width: 55px;
                height: 55px;
            }

            .social-link-new i {
                font-size: 22px;
            }

            .social-tooltip {
                font-size: 11px;
                padding: 6px 10px;
                bottom: -30px;
            }

            .social-link-new:hover .social-tooltip {
                bottom: -25px;
            }
        }
    </style>
    <!-- ==================== END CSS ==================== -->
</head>
<!-- ==================== END HEAD ==================== -->

<body>
    <div class="container-scroller">

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
                                             onerror="this.onerror=null; this.classList.add('error'); this.parentElement.innerHTML='<i class=\"mdi mdi-account\"></i>';">
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
                                                 onerror="this.onerror=null; this.classList.add('error'); this.parentElement.innerHTML='<i class=\"mdi mdi-account\"></i>';">
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

        <div class="container-fluid page-body-wrapper">

            <!-- ==================== START SIDEBAR ==================== -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-category">Menu Utama</li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <span class="icon-bg"><i class="mdi mdi-view-dashboard menu-icon"></i></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Fitur Utama</li>

                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#fiturUtama"
                            aria-expanded="false" aria-controls="fiturUtama">
                            <span class="icon-bg"><i class="mdi mdi-apps menu-icon"></i></span>
                            <span class="menu-title">Fitur Utama</span>
                        </a>
                        <div class="collapse" id="fiturUtama">
                            <ul class="nav flex-column sub-menu">
                                <!-- Destinasi Wisata -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('destinasiwisata.index') }}">
                                        <i class="mdi mdi-map-marker menu-icon"></i>
                                        Destinasi Wisata
                                    </a>
                                </li>

                                <!-- HOMESTAY -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('homestay.index') }}">
                                        <i class="mdi mdi-home menu-icon"></i>
                                        Homestay
                                    </a>
                                </li>

                                <!-- KAMAR HOMESTAY -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('kamar.my') }}">
                                        <i class="mdi mdi-door-closed menu-icon"></i>
                                        Kamar Homestay
                                    </a>
                                </li>

                                <!-- BOOKING -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('booking-homestay.index') }}">
                                        <i class="mdi mdi-calendar-check menu-icon"></i>
                                        Booking
                                    </a>
                                </li>

                                <!-- Ulasan Wisata -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('ulasan_wisata.index') }}">
                                        <i class="mdi mdi-star-circle menu-icon"></i>
                                        Ulasan Wisata
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-category">Master Data</li>

                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#masterData"
                            aria-expanded="false" aria-controls="masterData">
                            <span class="icon-bg"><i class="mdi mdi-database menu-icon"></i></span>
                            <span class="menu-title">Master Data</span>
                        </a>
                        <div class="collapse" id="masterData">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}">
                                        <i class="mdi mdi-account-multiple menu-icon"></i>
                                        Manajemen User
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('warga.index') }}">
                                        <i class="mdi mdi-account-group menu-icon"></i>
                                        Data Warga
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- ==================== DOCUMENTATION MENU ==================== -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="icon-bg"><i class="mdi mdi-book-open-page-variant menu-icon"></i></span>
                            <span class="menu-title">Documentation</span>
                        </a>
                    </li>

                    <!-- User Display & Settings Section -->
                    <li class="nav-item sidebar-user-actions mt-4">
                        <div class="settings-logout-section">
                            @php
                                $user = Auth::user();
                                $hasProfilePicture = !empty($user->profile_picture);
                            @endphp

                            <!-- User Info Display dengan Foto Profil -->
                            <div class="user-display-section">
                                <div class="user-avatar-small {{ $hasProfilePicture ? 'has-image' : '' }}">
                                    @if($hasProfilePicture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                             alt="{{ $user->name }}"
                                             onerror="this.onerror=null; this.classList.add('error'); this.parentElement.innerHTML='<i class=\"mdi mdi-account\"></i>';">
                                    @else
                                        <i class="mdi mdi-account"></i>
                                    @endif
                                </div>
                                <div class="user-info-small">
                                    <h5>{{ $user->name ?? 'Guest' }}</h5>
                                    <p>{{ strtoupper($user->role ?? 'ADMIN') }} PARIWISATA DESA</p>
                                </div>
                            </div>

                            <!-- Settings Item -->
                            <a class="settings-item" href="{{ route('user.my-profile') }}">
                                <i class="mdi mdi-settings"></i>
                                <span>Settings</span>
                            </a>

                            <!-- Logout Item -->
                            <a href="#" class="logout-item-sidebar"
                               onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                                <i class="mdi mdi-logout"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- ==================== END SIDEBAR ==================== -->

            <!-- ==================== START MAIN CONTENT ==================== -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <!-- ==================== SLIDESHOW SECTION YANG DIPERBAIKI ==================== -->
                    <div class="slideshow-section">
                        <!-- 5 GAMBAR UNTUK SLIDESHOW -->
                        <div class="slideshow-slide active" style="background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');"></div>
                        <div class="slideshow-slide" style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');"></div>
                        <div class="slideshow-slide" style="background-image: url('https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');"></div>
                        <div class="slideshow-slide" style="background-image: url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');"></div>
                        <div class="slideshow-slide" style="background-image: url('https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');"></div>

                        <!-- Carousel overlay - HANYA UNTUK GAMBAR -->
                        <div class="carousel-overlay"></div>

                        <!-- Content - TEKS TANPA OVERLAY DI DALAM -->
                        <div class="slideshow-content">
                            <!-- Container untuk Selamat Datang dan Nama - SEJAJAR -->
                            <div class="welcome-container">
                                <h1 class="welcome-title">Selamat Datang</h1>
                                <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}!</div>
                            </div>
                            <div class="welcome-subtitle">Dashboard Monitoring Sistem Pariwisata & Homestay Desa</div>
                        </div>

                        <!-- Tombol Navigasi < > -->
                        <button class="carousel-btn prev">❮</button>
                        <button class="carousel-btn next">❯</button>

                        <!-- Controls -->
                        <div class="slideshow-controls">
                            <div class="slide-indicator active" data-slide="0"></div>
                            <div class="slide-indicator" data-slide="1"></div>
                            <div class="slide-indicator" data-slide="2"></div>
                            <div class="slide-indicator" data-slide="3"></div>
                            <div class="slide-indicator" data-slide="4"></div>
                        </div>
                    </div>

                    <!-- Circular Progress Charts - Data Dinamis dari Database -->
                    <div class="circular-progress-container">
                        <!-- Data Warga Progress -->
                        <div class="circular-progress-card progress-warga">
                            <div class="circular-progress-wrapper">
                                <div class="circular-progress">
                                    <div class="circular-progress-bg">
                                        <div class="circular-progress-ring"></div>
                                        <div class="circular-progress-content">
                                            <div class="circular-progress-icon">
                                                <i class="mdi mdi-account-group"></i>
                                            </div>
                                            <div class="circular-progress-value" id="warga-count">
                                                {{ $totalWarga ?? 0 }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="circular-progress-info">
                                    <div class="circular-progress-title">Data Warga</div>
                                    <div class="circular-progress-trend trend-up">
                                        <i class="mdi mdi-arrow-up"></i>
                                        <span>Meningkat sejak kemarin 12.5%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Destinasi Wisata Progress -->
                        <div class="circular-progress-card progress-wisata">
                            <div class="circular-progress-wrapper">
                                <div class="circular-progress">
                                    <div class="circular-progress-bg">
                                        <div class="circular-progress-ring"></div>
                                        <div class="circular-progress-content">
                                            <div class="circular-progress-icon">
                                                <i class="mdi mdi-map-marker"></i>
                                            </div>
                                            <div class="circular-progress-value" id="wisata-count">
                                                {{ $totalDestinasi ?? 0 }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="circular-progress-info">
                                    <div class="circular-progress-title">Destinasi Wisata</div>
                                    <div class="circular-progress-trend trend-up">
                                        <i class="mdi mdi-arrow-up"></i>
                                        <span>Meningkat sejak kemarin 8.3%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total User Progress -->
                        <div class="circular-progress-card progress-user">
                            <div class="circular-progress-wrapper">
                                <div class="circular-progress">
                                    <div class="circular-progress-bg">
                                        <div class="circular-progress-ring"></div>
                                        <div class="circular-progress-content">
                                            <div class="circular-progress-icon">
                                                <i class="mdi mdi-account-multiple"></i>
                                            </div>
                                            <div class="circular-progress-value" id="user-count">
                                                {{ $totalUser ?? 0 }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="circular-progress-info">
                                    <div class="circular-progress-title">Total User</div>
                                    <div class="circular-progress-trend trend-up">
                                        <i class="mdi mdi-arrow-up"></i>
                                        <span>Meningkat sejak kemarin 5.2%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Aktivitas Progress -->
                        <div class="circular-progress-card progress-aktivitas">
                            <div class="circular-progress-wrapper">
                                <div class="circular-progress">
                                    <div class="circular-progress-bg">
                                        <div class="circular-progress-ring"></div>
                                        <div class="circular-progress-content">
                                            <div class="circular-progress-icon">
                                                <i class="mdi mdi-calendar-check"></i>
                                            </div>
                                            <div class="circular-progress-value" id="aktivitas-count">
                                                {{ $totalAktivitas ?? 25 }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="circular-progress-info">
                                    <div class="circular-progress-title">Aktivitas</div>
                                    <div class="circular-progress-trend trend-down">
                                        <i class="mdi mdi-arrow-down"></i>
                                        <span>Menurun sejak kemarin 2.3%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New Circular Progress Cards for Additional Features -->
                    <div class="new-cards-section">
                        <h3 class="section-title">Statistik Tambahan</h3>
                        <div class="circular-progress-container">
                            <!-- Homestay Progress -->
                            <div class="circular-progress-card progress-homestay">
                                <div class="circular-progress-wrapper">
                                    <div class="circular-progress">
                                        <div class="circular-progress-bg">
                                            <div class="circular-progress-ring"></div>
                                            <div class="circular-progress-content">
                                                <div class="circular-progress-icon">
                                                    <i class="mdi mdi-home"></i>
                                                </div>
                                                <div class="circular-progress-value" id="homestay-count">
                                                    {{ $totalHomestay ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="circular-progress-info">
                                        <div class="circular-progress-title">Homestay</div>
                                        <div class="circular-progress-trend trend-up">
                                            <i class="mdi mdi-arrow-up"></i>
                                            <span>Meningkat sejak kemarin 7.8%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kamar Homestay Progress -->
                            <div class="circular-progress-card progress-kamar">
                                <div class="circular-progress-wrapper">
                                    <div class="circular-progress">
                                        <div class="circular-progress-bg">
                                            <div class="circular-progress-ring"></div>
                                            <div class="circular-progress-content">
                                                <div class="circular-progress-icon">
                                                    <i class="mdi mdi-door-closed"></i>
                                                </div>
                                                <div class="circular-progress-value" id="kamar-count">
                                                    {{ $totalKamar ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="circular-progress-info">
                                        <div class="circular-progress-title">Kamar Homestay</div>
                                        <div class="circular-progress-trend trend-up">
                                            <i class="mdi mdi-arrow-up"></i>
                                            <span>Meningkat sejak kemarin 9.2%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Progress -->
                            <div class="circular-progress-card progress-booking">
                                <div class="circular-progress-wrapper">
                                    <div class="circular-progress">
                                        <div class="circular-progress-bg">
                                            <div class="circular-progress-ring"></div>
                                            <div class="circular-progress-content">
                                                <div class="circular-progress-icon">
                                                    <i class="mdi mdi-calendar-check"></i>
                                                </div>
                                                <div class="circular-progress-value" id="booking-count">
                                                    {{ $totalBooking ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="circular-progress-info">
                                        <div class="circular-progress-title">Booking</div>
                                        <div class="circular-progress-trend trend-up">
                                            <i class="mdi mdi-arrow-up"></i>
                                            <span>Meningkat sejak kemarin 15.4%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ulasan Wisata Progress -->
                            <div class="circular-progress-card progress-ulasan">
                                <div class="circular-progress-wrapper">
                                    <div class="circular-progress">
                                        <div class="circular-progress-bg">
                                            <div class="circular-progress-ring"></div>
                                            <div class="circular-progress-content">
                                                <div class="circular-progress-icon">
                                                    <i class="mdi mdi-star-circle"></i>
                                                </div>
                                                <div class="circular-progress-value" id="ulasan-count">
                                                    {{ $totalUlasan ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="circular-progress-info">
                                    <div class="circular-progress-title">Ulasan Wisata</div>
                                    <div class="circular-progress-trend trend-up">
                                        <i class="mdi mdi-arrow-up"></i>
                                        <span>Meningkat sejak kemarin 6.7%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts and Additional Data -->
                    <div class="row">
                        <!-- Left Column - Charts -->
                        <div class="col-md-8 grid-margin">
                            <!-- Performance Chart -->
                            <div class="chart-container">
                                <div class="chart-header">
                                    <h3 class="chart-title">Statistik Pengunjung
                                        <span class="visitor-badge">
                                            <i class="mdi mdi-eye"></i>
                                            Total: <span id="total-visitors">1,245</span> pengunjung
                                        </span>
                                    </h3>
                                    <div class="period-selector">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-period active"
                                                data-period="minggu-ini">Minggu Ini</button>
                                            <button type="button" class="btn btn-period"
                                                data-period="minggu-lalu">Minggu Lalu</button>
                                            <button type="button" class="btn btn-period"
                                                data-period="bulan-ini">Bulan Ini</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas id="visitorChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Metrics -->
                        <div class="col-md-4 grid-margin">
                            <!-- Recent Activity -->
                            <div class="activity-card">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="chart-title mb-0">Aktivitas Terbaru</h3>
                                    <span class="badge badge-primary">Hari Ini</span>
                                </div>
                                <div id="recent-activities">
                                    <!-- Activities will be loaded dynamically -->
                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                            <i class="mdi mdi-account-plus"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Warga Baru Terdaftar</div>
                                            <div class="activity-desc">2 warga baru ditambahkan hari ini</div>
                                            <div class="activity-time">10:30 AM</div>
                                        </div>
                                        <div class="activity-percent trend-up">+12.99%</div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
                                            <i class="mdi mdi-map-marker"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Destinasi Wisata Baru</div>
                                            <div class="activity-desc">1 destinasi wisata ditambahkan</div>
                                            <div class="activity-time">09:15 AM</div>
                                        </div>
                                        <div class="activity-percent trend-up">+8.3%</div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                                            <i class="mdi mdi-home"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Homestay Baru</div>
                                            <div class="activity-desc">1 homestay baru terdaftar</div>
                                            <div class="activity-time">08:45 AM</div>
                                        </div>
                                        <div class="activity-percent trend-up">+7.8%</div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: linear-gradient(135deg, #a18cd1, #fbc2eb);">
                                            <i class="mdi mdi-calendar-check"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Booking Baru</div>
                                            <div class="activity-desc">3 booking homestay baru</div>
                                            <div class="activity-time">Yesterday</div>
                                        </div>
                                        <div class="activity-percent trend-up">+15.4%</div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: linear-gradient(135deg, #ffecd2, #fcb69f);">
                                            <i class="mdi mdi-star-circle"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Ulasan Baru</div>
                                            <div class="activity-desc">5 ulasan wisata baru</div>
                                            <div class="activity-time">Yesterday</div>
                                        </div>
                                        <div class="activity-percent trend-up">+6.7%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== START PROFIL PENGEMBANG YANG DIREDESAIN ULANG ==================== -->
                    <div class="developer-profile-new">
                        <!-- Judul Utama -->
                        <div class="text-center mb-5">
                            <h1 class="profile-title-new">PROFIL PENGEMBANG</h1>
                            <p class="profile-subtitle-new">Developer & Creator of Sistem Pariwisata Desa</p>
                        </div>

                        <!-- Header dengan Foto dan Informasi -->
                        <div class="developer-profile-header-new">
                            <!-- Foto (Persegi Panjang yang Lebih Menarik) -->
                            <div class="developer-photo-new">
                                <img src="{{ asset('assets-admin/images/farasfoto.jpg') }}"
                                     alt="Faras Zakia Indrani"
                                     onerror="this.onerror=null; this.src='{{ asset('assets-admin/images/default-profile.jpg') }}';">
                            </div>

                            <!-- Informasi Developer -->
                            <div class="developer-info-new">
                                <!-- Nama Besar dengan Gradient -->
                                <h2 class="developer-name">
                                    FARAS ZAKIA INDRANI
                                </h2>

                                <!-- Informasi dalam 2 Kolom yang Rapi -->
                                <div class="developer-details-grid">
                                    <!-- Baris 1: Kiri - NIM -->
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="mdi mdi-identifier"></i>
                                            NIM
                                        </div>
                                        <div class="detail-value">2457301048</div>
                                    </div>

                                    <!-- Kanan - Institusi -->
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="mdi mdi-school"></i>
                                            Institusi
                                        </div>
                                        <div class="detail-value">
                                            <a href="https://pcr.ac.id/" target="_blank">
                                                <i class="mdi mdi-open-in-new"></i>
                                                Politeknik Caltex Riau
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Baris 2: Kiri - Program Studi -->
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="mdi mdi-book-education"></i>
                                            Program Studi
                                        </div>
                                        <div class="detail-value">Sistem Informasi</div>
                                    </div>

                                    <!-- Kanan - Telepon -->
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="mdi mdi-phone"></i>
                                            Telepon
                                        </div>
                                        <div class="detail-value">+62 813-6358-9715</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi Proyek yang Diperbaiki -->
                        <div class="project-description">
                            <div class="project-title">
                                <i class="mdi mdi-information-outline"></i>
                                Tentang Proyek Ini
                            </div>
                            <p class="project-text">
                                <strong>Sistem Informasi Pariwisata dan Homestay Desa</strong> adalah aplikasi web yang saya kembangkan sebagai bagian dari tugas mata kuliah Pengembangan Aplikasi Berbasis Web. Sistem ini dirancang khusus untuk membantu pengelolaan destinasi wisata dan homestay di desa secara digital. Dengan fitur yang komprehensif mulai dari manajemen data wisata, pemesanan homestay online, hingga analisis statistik pengunjung, aplikasi ini bertujuan untuk memudahkan administrasi dan meningkatkan aksesibilitas potensi wisata desa kepada masyarakat luas.
                            </p>
                        </div>

                        <!-- Quote Section yang Lebih Menarik -->
                        <div class="quote-section-new">
                            <div class="quote-icon">
                                <i class="mdi mdi-format-quote-close"></i>
                            </div>
                            <p class="quote-text-new">
                                "Membangun sistem yang tidak hanya berfungsi, tetapi juga memberikan dampak positif bagi masyarakat desa melalui teknologi."
                            </p>
                            <div class="quote-author-new">
                                — Faras Zakia Indrani
                            </div>
                        </div>

                        <!-- Social Media Links - LOGO LINGKARAN YANG LEBIH BAGUS -->
                        <div class="social-links-new">
                            <a href="https://www.instagram.com/frszakiaa_?igsh=d3cwMXA5c3F4NHly"
                               target="_blank"
                               class="social-link-new social-instagram-new">
                                <i class="mdi mdi-instagram"></i>
                                <span class="social-tooltip">Instagram</span>
                            </a>

                            <a href="https://www.linkedin.com/in/faras-zakia-indrani-29b4a6360/"
                               target="_blank"
                               class="social-link-new social-linkedin-new">
                                <i class="mdi mdi-linkedin"></i>
                                <span class="social-tooltip">LinkedIn</span>
                            </a>

                            <a href="https://github.com/faraspcr"
                               target="_blank"
                               class="social-link-new social-github-new">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white">
        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
    </svg>
    <span class="social-tooltip">GitHub</span>
</a>

                            <a href="mailto:faras24si@mahasiswa.pcr.ac.id"
                               class="social-link-new social-email-new">
                                <i class="mdi mdi-email"></i>
                                <span class="social-tooltip">Email</span>
                            </a>
                        </div>
                    </div>
                    <!-- ==================== END PROFIL PENGEMBANG YANG DIREDESAIN ULANG ==================== -->

                </div>

                <!-- ==================== START FOOTER YANG DIUBAH ==================== -->
                <footer class="footer">
                    <div class="footer-inner-wraper">
                        <div class="text-center">
                            <span class="text-muted d-block">
                                <div style="margin-bottom: 10px; font-size: 14px; color: #666;">
                                    2024 Sistem Pariwisata Desa v2.1.0
                                </div>
                                <div style="margin-bottom: 10px; font-size: 13px; color: #888;">
                                    Dikembangkan dengan <i class="mdi mdi-heart" style="color: #e74c3c;"></i> oleh Faras Zakia Indrani
                                </div>
                                <div style="margin-top: 15px; font-size: 12px; color: #999; padding-top: 15px; border-top: 1px solid #eee;">
                                    <i class="mdi mdi-shield-check"></i> Hak Cipta Dilindungi | Privacy Policy | Terms of Service
                                </div>
                            </span>
                        </div>
                    </div>
                </footer>
                <!-- ==================== END FOOTER ==================== -->
            </div>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <div class="whatsapp-float" id="whatsappFloat">
        <i class="mdi mdi-whatsapp"></i>
        <div class="whatsapp-tooltip">Hubungi Admin</div>
    </div>

    <!-- Logout Forms -->
    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <form id="sidebar-logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- ==================== START JS ==================== -->
    <!-- plugins:js -->
    <script src="{{ asset('assets-admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets-admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendors/jquery-circle-progress/js/circle-progress.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets-admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets-admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets-admin/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets-admin/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ==================== SLIDESHOW FUNCTIONALITY ====================
            let currentSlide = 0;
            const slides = document.querySelectorAll('.slideshow-slide');
            const indicators = document.querySelectorAll('.slide-indicator');
            const prevBtn = document.querySelector('.carousel-btn.prev');
            const nextBtn = document.querySelector('.carousel-btn.next');
            const overlay = document.querySelector('.carousel-overlay');

            function showSlide(index) {
                // Hide all slides
                slides.forEach(slide => slide.classList.remove('active'));
                indicators.forEach(indicator => indicator.classList.remove('active'));

                // Show current slide
                currentSlide = (index + slides.length) % slides.length;
                slides[currentSlide].classList.add('active');
                indicators[currentSlide].classList.add('active');

                // Update overlay position
                if (overlay) {
                    overlay.style.zIndex = '3';
                }
            }

            // Auto slide every 5 seconds
            let slideInterval = setInterval(() => {
                showSlide(currentSlide + 1);
            }, 5000);

            // Previous button
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    clearInterval(slideInterval);
                    showSlide(currentSlide - 1);

                    // Restart auto slide
                    slideInterval = setInterval(() => {
                        showSlide(currentSlide + 1);
                    }, 5000);
                });
            }

            // Next button
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    clearInterval(slideInterval);
                    showSlide(currentSlide + 1);

                    // Restart auto slide
                    slideInterval = setInterval(() => {
                        showSlide(currentSlide + 1);
                    }, 5000);
                });
            }

            // Indicator click event
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    clearInterval(slideInterval);
                    showSlide(index);

                    // Restart auto slide
                    slideInterval = setInterval(() => {
                        showSlide(currentSlide + 1);
                    }, 5000);
                });
            });

            // ==================== HEADER FIXES ====================
            // Pastikan hanya satu logo yang ditampilkan
            const brandLogo = document.querySelector('.brand-logo');
            const brandLogoMini = document.querySelector('.brand-logo-mini');

            if (brandLogo && brandLogoMini) {
                // Sembunyikan logo mini
                brandLogoMini.style.display = 'none';

                // Pastikan logo utama selalu terlihat
                brandLogo.style.display = 'flex';
            }

            // Handle hamburger menu untuk sidebar
            const sidebarToggler = document.querySelector('.navbar-toggler[data-toggle="minimize"]');
            if (sidebarToggler) {
                sidebarToggler.addEventListener('click', function() {
                    // Tidak perlu melakukan perubahan pada logo
                    // Biarkan CSS yang mengatur tampilan
                });
            }

            // Handle mobile hamburger menu
            const mobileToggler = document.querySelector('.navbar-toggler-right');
            if (mobileToggler) {
                mobileToggler.addEventListener('click', function() {
                    // Tidak perlu melakukan perubahan pada logo
                    // Biarkan CSS yang mengatur tampilan
                });
            }

            // Set user name dari Auth
            @if(Auth::check())
                const userName = "{{ Auth::user()->name }}";
                // Update welcome message
                const welcomeMessage = document.querySelector('.welcome-message');
                if (welcomeMessage) {
                    welcomeMessage.textContent = userName;
                }
            @endif

            // Initialize Chart.js
            let visitorChart = null;

            function initVisitorChart() {
                const ctx = document.getElementById('visitorChart').getContext('2d');

                // Data untuk grafik pengunjung minggu ini vs minggu lalu
                const chartData = {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    dataMingguIni: [156, 189, 203, 178, 245, 312, 285],
                    dataMingguLalu: [134, 165, 187, 156, 210, 278, 245],
                    dataBulanIni: [1456, 1678, 1890, 1765, 1987, 2245, 2100]
                };

                visitorChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: chartData.labels,
                        datasets: [{
                            label: 'Minggu Ini',
                            data: chartData.dataMingguIni,
                            borderColor: '#667eea',
                            backgroundColor: 'rgba(102, 126, 234, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }, {
                            label: 'Minggu Lalu',
                            data: chartData.dataMingguLalu,
                            borderColor: '#f093fb',
                            backgroundColor: 'rgba(240, 147, 251, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4,
                            borderDash: [5, 5]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                }
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                callbacks: {
                                    label: function(context) {
                                        return `${context.dataset.label}: ${context.parsed.y} pengunjung`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false
                                },
                                ticks: {
                                    stepSize: 50,
                                    callback: function(value) {
                                        return value + ' pengunjung';
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Jumlah Pengunjung'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'Hari dalam Seminggu'
                                }
                            }
                        }
                    }
                });
            }

            // Update circular progress based on data
            function updateCircularProgress() {
                // Data dari controller
                const wargaCount = {{ $totalWarga ?? 0 }};
                const wisataCount = {{ $totalDestinasi ?? 0 }};
                const userCount = {{ $totalUser ?? 0 }};
                const aktivitasCount = {{ $totalAktivitas ?? 25 }};
                const homestayCount = {{ $totalHomestay ?? 0 }};
                const kamarCount = {{ $totalKamar ?? 0 }};
                const bookingCount = {{ $totalBooking ?? 0 }};
                const ulasanCount = {{ $totalUlasan ?? 0 }};

                // Update nilai di circular progress
                document.getElementById('warga-count').textContent = wargaCount;
                document.getElementById('wisata-count').textContent = wisataCount;
                document.getElementById('user-count').textContent = userCount;
                document.getElementById('aktivitas-count').textContent = aktivitasCount;
                document.getElementById('homestay-count').textContent = homestayCount;
                document.getElementById('kamar-count').textContent = kamarCount;
                document.getElementById('booking-count').textContent = bookingCount;
                document.getElementById('ulasan-count').textContent = ulasanCount;

                // Update progress percent berdasarkan data
                updateProgressPercent('progress-warga', wargaCount, 200);
                updateProgressPercent('progress-wisata', wisataCount, 50);
                updateProgressPercent('progress-user', userCount, 50);
                updateProgressPercent('progress-aktivitas', aktivitasCount, 50);
                updateProgressPercent('progress-homestay', homestayCount, 30);
                updateProgressPercent('progress-kamar', kamarCount, 100);
                updateProgressPercent('progress-booking', bookingCount, 50);
                updateProgressPercent('progress-ulasan', ulasanCount, 100);

                // Update total visitors badge
                const totalVisitors = [156, 189, 203, 178, 245, 312, 285].reduce((a, b) => a + b, 0);
                document.getElementById('total-visitors').textContent = totalVisitors.toLocaleString();
            }

            function updateProgressPercent(className, current, max) {
                const percent = Math.min((current / max) * 100, 100);
                const element = document.querySelector('.' + className);
                if (element) {
                    element.style.setProperty('--progress-percent', percent + '%');
                }
            }

            // Load recent activities dari database
            function loadRecentActivities() {
                // Data contoh aktivitas
                const activities = [
                    {
                        title: 'Warga Baru Terdaftar',
                        description: '2 warga baru ditambahkan hari ini',
                        icon: 'mdi mdi-account-plus',
                        color: 'linear-gradient(135deg, #667eea, #764ba2)',
                        percentage: '+12.99%',
                        time: '10:30 AM'
                    },
                    {
                        title: 'Destinasi Wisata Baru',
                        description: '1 destinasi wisata ditambahkan',
                        icon: 'mdi mdi-map-marker',
                        color: 'linear-gradient(135deg, #f093fb, #f5576c)',
                        percentage: '+8.3%',
                        time: '09:15 AM'
                    },
                    {
                        title: 'Homestay Baru',
                        description: '1 homestay baru terdaftar',
                        icon: 'mdi mdi-home',
                        color: 'linear-gradient(135deg, #4facfe, #00f2fe)',
                        percentage: '+7.8%',
                        time: '08:45 AM'
                    },
                    {
                        title: 'Booking Baru',
                        description: '3 booking homestay baru',
                        icon: 'mdi mdi-calendar-check',
                        color: 'linear-gradient(135deg, #a18cd1, #fbc2eb)',
                        percentage: '+15.4%',
                        time: 'Yesterday'
                    },
                    {
                        title: 'Ulasan Baru',
                        description: '5 ulasan wisata baru',
                        icon: 'mdi mdi-star-circle',
                        color: 'linear-gradient(135deg, #ffecd2, #fcb69f)',
                        percentage: '+6.7%',
                        time: 'Yesterday'
                    }
                ];

                const container = document.getElementById('recent-activities');
                if (!container) return;

                // Kosongkan kontainer
                container.innerHTML = '';

                // Tambahkan aktivitas
                activities.forEach(activity => {
                    const activityHTML = `
                        <div class="activity-item">
                            <div class="activity-icon" style="background: ${activity.color};">
                                <i class="${activity.icon}"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">${activity.title}</div>
                                <div class="activity-desc">${activity.description}</div>
                                <div class="activity-time">${activity.time}</div>
                            </div>
                            <div class="activity-percent trend-up">${activity.percentage}</div>
                        </div>
                    `;
                    container.innerHTML += activityHTML;
                });
            }

            // Initialize data
            updateCircularProgress();
            initVisitorChart();
            loadRecentActivities();

            // Auto refresh data setiap 30 detik
            setInterval(() => {
                updateCircularProgress();
                loadRecentActivities();
            }, 30000);

            // Period selector for chart
            document.querySelectorAll('[data-period]').forEach(button => {
                button.addEventListener('click', function() {
                    const period = this.getAttribute('data-period');

                    // Update active button
                    document.querySelectorAll('[data-period]').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');

                    // Update chart data based on period
                    updateChartData(period);
                });
            });

            function updateChartData(period) {
                const chartData = {
                    'minggu-ini': [156, 189, 203, 178, 245, 312, 285],
                    'minggu-lalu': [134, 165, 187, 156, 210, 278, 245],
                    'bulan-ini': [1456, 1678, 1890, 1765, 1987, 2245, 2100]
                };

                if (visitorChart && chartData[period]) {
                    if (period === 'bulan-ini') {
                        visitorChart.data.datasets[0].data = chartData[period];
                        visitorChart.data.datasets[1].data = [];
                        visitorChart.data.datasets[0].label = 'Bulan Ini';
                    } else {
                        visitorChart.data.datasets[0].data = chartData['minggu-ini'];
                        visitorChart.data.datasets[1].data = chartData['minggu-lalu'];
                        visitorChart.data.datasets[0].label = 'Minggu Ini';
                        visitorChart.data.datasets[1].label = 'Minggu Lalu';
                    }
                    visitorChart.update();
                }
            }

            // Initialize Bootstrap collapse with proper event handling
            $('.dropdown-toggle').on('click', function(e) {
                e.preventDefault();
                const target = $(this).attr('href');
                $(target).collapse('toggle');

                // Update aria-expanded attribute
                const isExpanded = $(this).attr('aria-expanded') === 'true';
                $(this).attr('aria-expanded', !isExpanded);
            });

            // Handle collapse events to update arrow icon
            $('#fiturUtama, #masterData').on('show.bs.collapse', function() {
                const toggle = $('[href="#' + this.id + '"]');
                toggle.attr('aria-expanded', 'true');
            }).on('hide.bs.collapse', function() {
                const toggle = $('[href="#' + this.id + '"]');
                toggle.attr('aria-expanded', 'false');
            });

            // Period button active state
            $('.btn-period').on('click', function() {
                $('.btn-period').removeClass('active');
                $(this).addClass('active');
            });

            // WhatsApp Floating Button Functionality
            const whatsappFloat = document.getElementById('whatsappFloat');

            if (whatsappFloat) {
                whatsappFloat.addEventListener('click', function() {
                    const phoneNumber = '6281234567890';
                    const defaultMessage =
                        'Halo Admin Pariwisata Desa! Saya perlu bantuan terkait sistem Pariwisata Desa. Bisa dibantu?';
                    const encodedMessage = encodeURIComponent(defaultMessage);
                    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
                    window.open(whatsappUrl, '_blank');
                });
            }

            // Developer Page Social Links Animation
            const socialLinks = document.querySelectorAll('.social-link-new');
            socialLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.1)';
                });

                link.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Add smooth hover effects untuk kartu
            document.querySelectorAll('.circular-progress-card, .chart-container, .activity-card, .developer-profile-new').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Detail item hover effects
            document.querySelectorAll('.detail-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                    this.style.boxShadow = '0 8px 20px rgba(0, 0, 0, 0.1)';
                });

                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                    this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.05)';
                });
            });

            // Simulate real-time data updates
            function simulateRealTimeUpdates() {
                setInterval(() => {
                    // Randomly update visitor count
                    const visitorBadge = document.getElementById('total-visitors');
                    if (visitorBadge) {
                        const current = parseInt(visitorBadge.textContent.replace(/,/g, ''));
                        const change = Math.floor(Math.random() * 10) - 3; // -3 to +6
                        const newValue = Math.max(1200, current + change);
                        visitorBadge.textContent = newValue.toLocaleString();
                    }
                }, 10000); // Update every 10 seconds
            }

            simulateRealTimeUpdates();
        });
    </script>
    <!-- ==================== END JS ==================== -->
</body>
</html>
