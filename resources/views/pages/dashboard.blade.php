<!DOCTYPE html>
<html lang="id">

<head>
    <!-- ==================== START HEAD ==================== -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bina Desa - Admin</title>
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
            padding-left: 30px;
        }

        .nav-dropdown .nav-link {
            padding: 8px 15px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .nav-dropdown .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .dropdown-toggle {
            position: relative;
            cursor: pointer;
        }

        .dropdown-toggle::after {
            content: '\f140';
            font-family: 'Material Design Icons';
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.3s ease;
            border: none !important;
            width: auto;
            height: auto;
        }

        .dropdown-toggle[aria-expanded="true"]::after {
            transform: translateY(-50%) rotate(180deg);
        }

        /* Floating WhatsApp Button */
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
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f8f9fa;
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

        .activity-percent {
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Header Styles */
        .card-header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

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

        /* Profile Section Styles */
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
            background: rgba(0, 0, 0, 0.05);
            border-radius: 30px;
        }

        /* Responsive Design */
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
        }
    </style>
    <!-- ==================== END CSS ==================== -->
</head>
<!-- ==================== END HEAD ==================== -->

<body>
    <div class="container-scroller">

        <!-- ==================== START HEADER ==================== -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
                    <div
                        style="color: #28a745; font-size: 24px; font-weight: bold; display: flex; align-items: center; justify-content: center; width: 100%;">
                        <i class="mdi mdi-home-group mr-2"></i>BINA DESA
                    </div>
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
                    <div
                        style="color: #28a745; font-size: 18px; font-weight: bold; display: flex; align-items: center; justify-content: center;">
                        BD
                    </div>
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>

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
                            <span class="count-symbol bg-danger">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0 bg-primary text-white">Notifikasi</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-account-plus"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal">Warga Baru</h6>
                                    <p class="text-gray ellipsis mb-0">2 warga baru terdaftar</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="mdi mdi-map-marker"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal">Wisata Baru</h6>
                                    <p class="text-gray ellipsis mb-0">1 destinasi wisata ditambahkan</p>
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

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" id="profileDropdown"
                            href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img mr-3">
                                <div class="profile-avatar" style="width: 35px; height: 35px; font-size: 1.2rem;">
                                    <i class="mdi mdi-account"></i>
                                </div>
                            </div>
                            <div class="nav-profile-text d-flex align-items-center">
                                <p class="mb-0 text-black" id="userName">Faras Zakia</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                            aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                            <div class="p-3 text-center bg-primary">
                                <div class="profile-avatar"
                                    style="margin: 0 auto 15px; width: 70px; height: 70px; font-size: 2rem;">
                                    <i class="mdi mdi-account"></i>
                                </div>
                                <p class="mt-2 mb-0 text-white" style="font-weight: 700;">Faras Zakia</p>
                                <small class="text-white">Administrator</small>
                            </div>
                            <div class="p-2">
                                <h5 class="dropdown-header text-uppercase pl-2 text-dark">Akun Pengguna</h5>
                                <a class="dropdown-item py-2 d-flex align-items-center justify-content-between"
                                    href="#">
                                    <span>Profil Saya</span>
                                    <i class="mdi mdi-account-outline ml-1"></i>
                                </a>
                                <a class="dropdown-item py-2 d-flex align-items-center justify-content-between"
                                    href="javascript:void(0)">
                                    <span>Pengaturan</span>
                                    <i class="mdi mdi-settings"></i>
                                </a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item py-2 d-flex align-items-center justify-content-between"
                                    href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span>Logout</span>
                                    <i class="mdi mdi-logout ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
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

                                <!-- HOMESTAY BARU -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('homestay.index') }}">
                                        <i class="mdi mdi-home menu-icon"></i>
                                        Homestay
                                    </a>
                                </li>
                                  <!-- KAMAR HOMESTAY -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kamar_homestay.index') }}">
                            <i class="mdi mdi-bed menu-icon"></i>
                            Kamar Homestay
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

                    <!-- User Profile Section -->
                    <li class="nav-item sidebar-user-actions mt-3">
                        <div class="profile-display">
                            <div class="profile-avatar">
                                <i class="mdi mdi-account"></i>
                            </div>
                            <div class="profile-info">
                                <h5>Faras Zakia</h5>
                                <p>Administrator</p>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item sidebar-user-actions">
                        <div class="sidebar-user-menu">
                            <a href="#" class="logout-btn"
                                onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                                <i class="mdi mdi-logout"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- ==================== END SIDEBAR ==================== -->

            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Dashboard Header -->
                    <div class="card-header-section">
                        <div>
                            <h1 class="card-title">Dashboard Overview</h1>
                            <p class="card-subtitle">Selamat datang di dashboard Bina Desa</p>
                        </div>
                        <div class="period-selector">
                            <div class="btn-group" role="group" aria-label="Period selector">
                                <button type="button" class="btn btn-period active">7 Hari</button>
                                <button type="button" class="btn btn-period">1 Bulan</button>
                                <button type="button" class="btn btn-period">3 Bulan</button>
                            </div>
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

                    <!-- Charts and Additional Data -->
                    <div class="row">
                        <!-- Left Column - Charts -->
                        <div class="col-md-8 grid-margin">
                            <!-- Performance Chart -->
                            <div class="chart-container">
                                <div class="chart-header">
                                    <h3 class="chart-title">Statistik Pengunjung</h3>
                                    <div class="period-selector">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-period active"
                                                data-period="minggu-ini">Minggu Ini</button>
                                            <button type="button" class="btn btn-period"
                                                data-period="minggu-lalu">Minggu Lalu</button>
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
                                <h3 class="chart-title mb-4">Aktivitas Terbaru</h3>
                                <div id="recent-activities">
                                    <!-- Data akan diisi oleh JavaScript secara dinamis -->
                                    <div class="text-center text-muted py-4">
                                        <i class="mdi mdi-loading mdi-spin" style="font-size: 24px;"></i>
                                        <p>Memuat aktivitas...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ==================== START FOOTER ==================== -->
                <footer class="footer">
                    <div class="footer-inner-wraper">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                                &copy; 2024 Bina Desa - Sistem Manajemen Desa
                            </span>
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                                Versi 2.1.0 | Terakhir update: <span id="currentDate"></span>
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

    <!-- Form untuk logout -->
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
            // Set user name
            const userName = "Faras Zakia";
            document.getElementById('userName').textContent = userName;

            // Set current date
            const now = new Date();
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', options);

            // Initialize Chart.js
            let visitorChart = null;

            function initVisitorChart() {
                const ctx = document.getElementById('visitorChart').getContext('2d');

                // Data contoh untuk grafik
                const chartData = {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    data: [65, 59, 80, 81, 56, 55, 40]
                };

                visitorChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: chartData.labels,
                        datasets: [{
                            label: 'Jumlah Pengunjung',
                            data: chartData.data,
                            borderColor: '#667eea',
                            backgroundColor: 'rgba(102, 126, 234, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false
                                },
                                ticks: {
                                    stepSize: 20
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // Update circular progress based on data
            function updateCircularProgress() {
                // Data dari controller (akan di-pass melalui Laravel)
                const wargaCount = {{ $totalWarga ?? 0 }};
                const wisataCount = {{ $totalDestinasi ?? 0 }};
                const userCount = {{ $totalUser ?? 0 }};
                const aktivitasCount = {{ $totalAktivitas ?? 25 }};

                // Update nilai di circular progress
                document.getElementById('warga-count').textContent = wargaCount;
                document.getElementById('wisata-count').textContent = wisataCount;
                document.getElementById('user-count').textContent = userCount;
                document.getElementById('aktivitas-count').textContent = aktivitasCount;

                // Update progress percent berdasarkan data
                updateProgressPercent('progress-warga', wargaCount, 100);
                updateProgressPercent('progress-wisata', wisataCount, 50);
                updateProgressPercent('progress-user', userCount, 20);
                updateProgressPercent('progress-aktivitas', aktivitasCount, 30);
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
                // Simulasi data dari database
                const activities = [{
                        title: 'Warga Baru Terdaftar',
                        description: '2 warga baru ditambahkan hari ini',
                        icon: 'mdi mdi-account-plus',
                        color: 'linear-gradient(135deg, #667eea, #764ba2)',
                        percentage: '+12.99%'
                    },
                    {
                        title: 'Destinasi Wisata Baru',
                        description: '1 destinasi wisata ditambahkan',
                        icon: 'mdi mdi-map-marker',
                        color: 'linear-gradient(135deg, #f093fb, #f5576c)',
                        percentage: '+8.3%'
                    },
                    {
                        title: 'User Baru',
                        description: '1 user administrator baru',
                        icon: 'mdi mdi-account',
                        color: 'linear-gradient(135deg, #4facfe, #00f2fe)',
                        percentage: '+5.2%'
                    }
                ];

                const container = document.getElementById('recent-activities');
                container.innerHTML = '';

                activities.forEach(activity => {
                    const activityHTML = `
                        <div class="activity-item">
                            <div class="activity-icon" style="background: ${activity.color};">
                                <i class="${activity.icon}"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">${activity.title}</div>
                                <div class="activity-desc">${activity.description}</div>
                            </div>
                            <div class="activity-percent text-success">${activity.percentage}</div>
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
                // Data contoh berdasarkan periode
                let data;
                if (period === 'minggu-ini') {
                    data = [65, 59, 80, 81, 56, 55, 40];
                } else {
                    data = [45, 49, 60, 71, 46, 45, 30];
                }

                if (visitorChart) {
                    visitorChart.data.datasets[0].data = data;
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
                        'Halo Admin Bina Desa! Saya perlu bantuan terkait sistem Bina Desa. Bisa dibantu?';
                    const encodedMessage = encodeURIComponent(defaultMessage);
                    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
                    window.open(whatsappUrl, '_blank');
                });
            }
        });
    </script>
    <!-- ==================== END JS ==================== -->
</body>

</html>
