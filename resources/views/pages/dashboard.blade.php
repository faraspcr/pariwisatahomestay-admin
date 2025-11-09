<!DOCTYPE html>
<html lang="id">

<head>
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
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
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
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                            data-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{ asset('assets-admin/images/faces/face28.png') }}" alt="image">
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black" id="userName">Admin</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                            aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                            <div class="p-3 text-center bg-primary">
                                <img class="img-avatar img-avatar48 img-avatar-thumb"
                                    src="{{ asset('assets-admin/images/faces/face28.png') }}" alt="">
                            </div>
                            <div class="p-2">
                                <h5 class="dropdown-header text-uppercase pl-2 text-dark">Akun Pengguna</h5>
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="#">
                                    <span>Profil Saya</span>
                                    <i class="mdi mdi-account-outline ml-1"></i>
                                </a>
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="javascript:void(0)">
                                    <span>Pengaturan</span>
                                    <i class="mdi mdi-settings"></i>
                                </a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span>Log out</span>
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
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
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

                    <!-- Dropdown Menu untuk Fitur Utama -->
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#fiturUtama"
                           aria-expanded="false" aria-controls="fiturUtama">
                            <span class="icon-bg"><i class="mdi mdi-apps menu-icon"></i></span>
                            <span class="menu-title">Fitur Utama</span>
                        </a>
                        <div class="collapse" id="fiturUtama">
                            <ul class="nav flex-column sub-menu">
                                <!-- Modul A - Pengelolaan Wisata -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('destinasiwisata.index') }}">
                                        <i class="mdi mdi-map-marker menu-icon"></i>
                                        Pengelolaan Wisata
                                    </a>
                                </li>

                                <!-- Modul B - Layanan Desa -->
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="mdi mdi-handshake menu-icon"></i>
                                        Layanan Desa
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item nav-category">Master Data</li>

                    <!-- Dropdown Menu untuk Master Data -->
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
                        <div class="user-details">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="sidebar-profile-img">
                                            <img src="{{ asset('assets-admin/images/faces/face28.png') }}" alt="image">
                                        </div>
                                        <div class="sidebar-profile-text">
                                            <p class="mb-1" id="sidebarUserName">Admin</p>
                                            <small class="text-muted">Administrator</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item sidebar-user-actions">
                        <div class="sidebar-user-menu">
                            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                                <i class="mdi mdi-logout menu-icon"></i>
                                <span class="menu-title">Keluar</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="d-xl-flex justify-content-between align-items-start">
                        <h2 class="text-dark font-weight-bold mb-2">Dashboard Overview</h2>
                        <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
                            <div class="btn-group bg-white p-3" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-link text-light py-0 border-right">7 Hari</button>
                                <button type="button" class="btn btn-link text-dark py-0 border-right">1 Bulan</button>
                                <button type="button" class="btn btn-link text-light py-0">3 Bulan</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="mb-2 text-dark font-weight-normal">Total Warga</h5>
                                            <h2 class="mb-4 text-dark font-weight-bold">{{ $totalWarga ?? 0 }}</h2>
                                            <div class="dashboard-progress dashboard-progress-1 d-flex align-items-center justify-content-center item-parent">
                                                <i class="mdi mdi-account-multiple icon-md absolute-center text-dark"></i>
                                            </div>
                                            <p class="mt-4 mb-0">Warga Terdaftar</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="mb-2 text-dark font-weight-normal">Destinasi Wisata</h5>
                                            <h2 class="mb-4 text-dark font-weight-bold">{{ $totalDestinasi ?? 0 }}</h2>
                                            <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent">
                                                <i class="mdi mdi-map-marker icon-md absolute-center text-dark"></i>
                                            </div>
                                            <p class="mt-4 mb-0">Tempat Wisata</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="mb-2 text-dark font-weight-normal">Total User</h5>
                                            <h2 class="mb-4 text-dark font-weight-bold">{{ $totalUser ?? 0 }}</h2>
                                            <div class="dashboard-progress dashboard-progress-3 d-flex align-items-center justify-content-center item-parent">
                                                <i class="mdi mdi-account icon-md absolute-center text-dark"></i>
                                            </div>
                                            <p class="mt-4 mb-0">User Sistem</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="mb-2 text-dark font-weight-normal">Aktivitas</h5>
                                            <h2 class="mb-4 text-dark font-weight-bold">25</h2>
                                            <div class="dashboard-progress dashboard-progress-4 d-flex align-items-center justify-content-center item-parent">
                                                <i class="mdi mdi-calendar-check icon-md absolute-center text-dark"></i>
                                            </div>
                                            <p class="mt-4 mb-0">Aktivitas Bulan Ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Selamat Datang di Sistem Bina Desa</h4>
                                            <p class="card-description">
                                                Sistem manajemen untuk pengelolaan data warga dan destinasi wisata desa.
                                            </p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Fitur Utama:</h5>
                                                    <ul>
                                                        <li>Manajemen Data Warga</li>
                                                        <li>Pengelolaan Destinasi Wisata</li>
                                                        <li>Manajemen User Sistem</li>
                                                        <li>Layanan Desa Terintegrasi</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Statistik Cepat:</h5>
                                                    <div class="d-flex justify-content-between">
                                                        <span>Warga Terdaftar:</span>
                                                        <strong>{{ $totalWarga ?? 0 }} orang</strong>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <span>Destinasi Wisata:</span>
                                                        <strong>{{ $totalDestinasi ?? 0 }} tempat</strong>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <span>User Aktif:</span>
                                                        <strong>{{ $totalUser ?? 0 }} user</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="footer-inner-wraper">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                                &copy; 2024 Bina Desa - Sistem Manajemen Desa
                            </span>
                        </div>
                    </div>
                </footer>
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

    <!-- plugins:js -->
    <script src="{{ asset('assets-admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets-admin/vendors/chart.js/Chart.min.js')}}"></script>
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
            const userName = localStorage.getItem('userName') || 'Admin';
            document.getElementById('userName').textContent = userName;
            document.getElementById('sidebarUserName').textContent = userName;

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

            // WhatsApp Floating Button Functionality
            const whatsappFloat = document.getElementById('whatsappFloat');

            if (whatsappFloat) {
                whatsappFloat.addEventListener('click', function() {
                    // GANTI NOMOR INI DENGAN NOMOR WHATSAPP ADMIN YANG SEBENARNYA
                    const phoneNumber = '6281234567890'; // Format: 62 untuk Indonesia

                    // Pesan default yang akan dikirim
                    const defaultMessage = 'Halo Admin Bina Desa! Saya perlu bantuan terkait sistem Bina Desa. Bisa dibantu?';

                    // Encode message untuk URL
                    const encodedMessage = encodeURIComponent(defaultMessage);

                    // Buat URL WhatsApp
                    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

                    // Buka WhatsApp di tab baru
                    window.open(whatsappUrl, '_blank');
                });

                // Optional: Show/hide based on scroll
                let lastScrollTop = 0;
                window.addEventListener('scroll', function() {
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                    if (scrollTop > lastScrollTop) {
                        // Scrolling down - hide button
                        whatsappFloat.style.transform = 'translateY(100px)';
                    } else {
                        // Scrolling up - show button
                        whatsappFloat.style.transform = 'translateY(0)';
                    }
                    lastScrollTop = scrollTop;
                });
            }
        });
    </script>
</body>
</html>
