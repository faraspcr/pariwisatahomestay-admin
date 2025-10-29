<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bina Desa</title>
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
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html">
                    <div
                        style="color: #28a745; font-size: 24px; font-weight: bold; display: flex; align-items: center; justify-content: center; width: 100%;">
                        <i class="mdi mdi-home-group mr-2"></i>BINA DESA
                    </div>
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.html">
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
                                placeholder="Cari produk">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item  dropdown d-none d-md-block">
                        <a class="nav-link dropdown-toggle" id="reportDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false"> Laporan </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="reportDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-file-pdf mr-2"></i>PDF </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-file-excel mr-2"></i>Excel </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-file-word mr-2"></i>Doc </a>
                        </div>
                    </li>
                    <li class="nav-item  dropdown d-none d-md-block">
                        <a class="nav-link dropdown-toggle" id="projectDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false"> Proyek </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="projectDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-eye-outline mr-2"></i>Lihat Proyek </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-pencil-outline mr-2"></i>Edit Proyek </a>
                        </div>
                    </li>
                    <li class="nav-item nav-language dropdown d-none d-md-block">
                        <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-language-icon">
                                <i class="flag-icon flag-icon-id" title="id" id="id"></i>
                            </div>
                            <div class="nav-language-text">
                                <p class="mb-1 text-black">Indonesia</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                            <a class="dropdown-item" href="#">
                                <div class="nav-language-icon mr-2">
                                    <i class="flag-icon flag-icon-ae" title="ae" id="ae"></i>
                                </div>
                                <div class="nav-language-text">
                                    <p class="mb-1 text-black">Arab</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <div class="nav-language-icon mr-2">
                                    <i class="flag-icon flag-icon-gb" title="GB" id="gb"></i>
                                </div>
                                <div class="nav-language-text">
                                    <p class="mb-1 text-black">Inggris</p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                            data-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{ asset('assets-admin/images/faces/face28.png') }}" alt="image">
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black" id="userName">Faras</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                            aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                            <div class="p-3 text-center bg-primary">
                                <img class="img-avatar img-avatar48 img-avatar-thumb"
                                    src="{{ asset('assets-admin/images/faces/face28.png') }}" alt="">
                            </div>
                            <div class="p-2">
                                <h5 class="dropdown-header text-uppercase pl-2 text-dark">Opsi Pengguna</h5>
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="#">
                                    <span>Kotak Masuk</span>
                                    <span class="p-0">
                                        <span class="badge badge-primary">3</span>
                                        <i class="mdi mdi-email-open-outline ml-1"></i>
                                    </span>
                                </a>
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="#">
                                    <span>Profil</span>
                                    <span class="p-0">
                                        <span class="badge badge-success">1</span>
                                        <i class="mdi mdi-account-outline ml-1"></i>
                                    </span>
                                </a>
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="javascript:void(0)">
                                    <span>Pengaturan</span>
                                    <i class="mdi mdi-settings"></i>
                                </a>
                                <div role="separator" class="dropdown-divider"></div>
                                <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Tindakan</h5>
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="#">
                                    <span>Kunci Akun</span>
                                    <i class="mdi mdi-lock ml-1"></i>
                                </a>
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span>Log out</span>
                                    <i class="mdi mdi-logout ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                            data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count-symbol bg-success"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">
                            <h6 class="p-3 mb-0 bg-primary text-white py-4">Pesan</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('assets-admin/images/faces/face4.jpg') }}" alt="image" class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark mengirim Anda pesan</h6>
                                    <p class="text-gray mb-0"> 1 Menit yang lalu </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('assets-admin/images/faces/face2.jpg') }}" alt="image" class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh mengirim Anda pesan</h6>
                                    <p class="text-gray mb-0"> 15 Menit yang lalu </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('assets-admin/images/faces/face3.jpg') }}" alt="image" class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Foto profil diperbarui</h6>
                                    <p class="text-gray mb-0"> 18 Menit yang lalu </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">4 pesan baru</h6>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0 bg-primary text-white py-4">Notifikasi</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-calendar"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Acara hari ini</h6>
                                    <p class="text-gray ellipsis mb-0"> Hanya pengingat bahwa Anda memiliki acara hari ini
                                    </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="mdi mdi-settings"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Pengaturan</h6>
                                    <p class="text-gray ellipsis mb-0"> Perbarui dashboard </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="mdi mdi-link-variant"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                                    <p class="text-gray ellipsis mb-0"> Admin baru wow! </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">Lihat semua notifikasi</h6>
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
                    <li class="nav-item nav-category">Utama</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <!-- MENU USER YANG SUDAH DITAMBAHKAN -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <span class="icon-bg"><i class="mdi mdi-account menu-icon"></i></span>
                            <span class="menu-title">User</span>
                        </a>
                    </li>

                    <!-- Menu Data Warga -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('warga.index') }}">
                            <span class="icon-bg"><i class="mdi mdi-account-multiple menu-icon"></i></span>
                            <span class="menu-title">Data Warga</span>
                        </a>
                    </li>

                    <!-- Menu Destinasi Wisata -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('destinasiwisata.index') }}">
                            <span class="icon-bg"><i class="mdi mdi-map-marker menu-icon"></i></span>
                            <span class="menu-title">Destinasi Wisata</span>
                        </a>
                    </li>

                    <li class="nav-item documentation-link">
                        <a class="nav-link"
                            href="http://www.bootstrapdash.com/demo/connect-plus-free/jquery/documentation/documentation.html"
                            target="_blank">
                            <span class="icon-bg">
                                <i class="mdi mdi-file-document-box menu-icon"></i>
                            </span>
                            <span class="menu-title">Dokumentasi</span>
                        </a>
                    </li>
                    <li class="nav-item sidebar-user-actions">
                        <div class="user-details">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="sidebar-profile-img">
                                            <img src="{{ asset('assets-admin/images/faces/face28.png') }}" alt="image">
                                        </div>
                                        <div class="sidebar-profile-text">
                                            <p class="mb-1" id="sidebarUserName">Faras</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="badge badge-danger">3</div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item sidebar-user-actions">
                        <div class="sidebar-user-menu">
                            <a href="#" class="nav-link"><i class="mdi mdi-settings menu-icon"></i>
                                <span class="menu-title">Pengaturan</span>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item sidebar-user-actions">
                        <div class="sidebar-user-menu">
                            <a href="#" class="nav-link"><i class="mdi mdi-speedometer menu-icon"></i>
                                <span class="menu-title">Tur</span></a>
                        </div>
                    </li>
                    <li class="nav-item sidebar-user-actions">
                        <div class="sidebar-user-menu">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                                <span class="menu-title">Log out</span></a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row" id="proBanner">
                        <div class="col-12">
                            <span class="d-flex align-items-center purchase-popup">
                                <p>Suka dengan yang Anda lihat? Lihat versi premium kami untuk lebih banyak.</p>
                                <a href="https://github.com/BootstrapDash/ConnectPlusAdmin-Free-Bootstrap-Admin-Template"
                                    target="_blank" class="btn ml-auto download-button">Unduh Versi Gratis</a>
                                <a href="http://www.bootstrapdash.com/demo/connect-plus/jquery/template/"
                                    target="_blank" class="btn purchase-button">Upgrade Ke Pro</a>
                                <i class="mdi mdi-close" id="bannerClose"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-xl-flex justify-content-between align-items-start">
                        <h2 class="text-dark font-weight-bold mb-2"> Ringkasan dashboard </h2>
                        <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
                            <div class="btn-group bg-white p-3" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-link text-light py-0 border-right">7
                                    Hari</button>
                                <button type="button" class="btn btn-link text-dark py-0 border-right">1
                                    Bulan</button>
                                <button type="button" class="btn btn-link text-light py-0">3 Bulan</button>
                            </div>
                            <div class="dropdown ml-0 ml-md-4 mt-2 mt-lg-0">
                                <button class="btn bg-white dropdown-toggle p-3 d-flex align-items-center"
                                    type="button" id="dropdownMenuButton1" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"> <i
                                        class="mdi mdi-calendar mr-1"></i>24 Mar 2023 - 24 Mar 2023 </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                                    <h6 class="dropdown-header">Pengaturan</h6>
                                    <a class="dropdown-item" href="#">Tindakan</a>
                                    <a class="dropdown-item" href="#">Tindakan lain</a>
                                    <a class="dropdown-item" href="#">Sesuatu yang lain di sini</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Tautan terpisah</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div
                                class="d-sm-flex justify-content-between align-items-center transaparent-tab-border {">
                                <ul class="nav nav-tabs tab-transparent" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#"
                                            role="tab" aria-selected="true">Pengguna</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="business-tab" data-toggle="tab"
                                            href="#business-1" role="tab" aria-selected="false">Bisnis</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="performance-tab" data-toggle="tab" href="#"
                                            role="tab" aria-selected="false">Kinerja</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="conversion-tab" data-toggle="tab" href="#"
                                            role="tab" aria-selected="false">Konversi</a>
                                    </li>
                                </ul>
                                <div class="d-md-block d-none">
                                    <a href="#" class="text-light p-1"><i
                                            class="mdi mdi-view-dashboard"></i></a>
                                    <a href="#" class="text-light p-1"><i
                                            class="mdi mdi-dots-vertical"></i></a>
                                </div>
                            </div>
                            <div class="tab-content tab-transparent-content">
                                <div class="tab-pane fade show active" id="business-1" role="tabpanel"
                                    aria-labelledby="business-tab">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5 class="mb-2 text-dark font-weight-normal">Total Warga</h5>
                                                    <h2 class="mb-4 text-dark font-weight-bold">{{ $totalWarga ?? 0 }}</h2>
                                                    <div
                                                        class="dashboard-progress dashboard-progress-1 d-flex align-items-center justify-content-center item-parent">
                                                        <i
                                                            class="mdi mdi-account-multiple icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <p class="mt-4 mb-0">Data Warga Terdaftar</p>
                                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">100%</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5 class="mb-2 text-dark font-weight-normal">Destinasi Wisata</h5>
                                                    <h2 class="mb-4 text-dark font-weight-bold">{{ $totalDestinasi ?? 0 }}</h2>
                                                    <div
                                                        class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent">
                                                        <i
                                                            class="mdi mdi-map-marker icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <p class="mt-4 mb-0">Tempat Wisata</p>
                                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">100%</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5 class="mb-2 text-dark font-weight-normal">Total User</h5>
                                                    <h2 class="mb-4 text-dark font-weight-bold">{{ $totalUser ?? 0 }}</h2>
                                                    <div
                                                        class="dashboard-progress dashboard-progress-3 d-flex align-items-center justify-content-center item-parent">
                                                        <i class="mdi mdi-account icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <p class="mt-4 mb-0">User Terdaftar</p>
                                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">100%</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5 class="mb-2 text-dark font-weight-normal">Pengikut</h5>
                                                    <h2 class="mb-4 text-dark font-weight-bold">4250k</h2>
                                                    <div
                                                        class="dashboard-progress dashboard-progress-4 d-flex align-items-center justify-content-center item-parent">
                                                        <i class="mdi mdi-cube icon-md absolute-center text-dark"></i>
                                                    </div>
                                                    <p class="mt-4 mb-0">Menurun sejak kemarin</p>
                                                    <h3 class="mb-0 font-weight-bold mt-2 text-dark">25%</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                                <h4 class="card-title mb-0">Aktivitas Terbaru</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-sm-4 grid-margin grid-margin-lg-0">
                                                            <div class="wrapper pb-5 border-bottom">
                                                                <div class="text-wrapper d-flex align-items-center justify-content-between mb-2">
                                                                    <p class="mb-0 text-dark">Total Keuntungan</p>
                                                                    <span class="text-success"><i class="mdi mdi-arrow-up"></i>2.95%</span>
                                                                </div>
                                                                <h3 class="mb-0 text-dark font-weight-bold">$ 92556</h3>
                                                                <canvas id="total-profit"></canvas>
                                                            </div>
                                                            <div class="wrapper pt-5">
                                                                <div class="text-wrapper d-flex align-items-center justify-content-between mb-2">
                                                                    <p class="mb-0 text-dark">Pengeluaran</p>
                                                                    <span class="text-success"><i class="mdi mdi-arrow-up"></i>52.95%</span>
                                                                </div>
                                                                <h3 class="mb-4 text-dark font-weight-bold">$ 59565</h3>
                                                                <canvas id="total-expences"></canvas>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9 col-sm-8 grid-margin grid-margin-lg-0">
                                                            <div class="pl-0 pl-lg-4 ">
                                                                <div class="d-xl-flex justify-content-between align-items-center mb-2">
                                                                    <div class="d-lg-flex align-items-center mb-lg-2 mb-xl-0">
                                                                        <h3 class="text-dark font-weight-bold mr-2 mb-0">Penjualan Perangkat</h3>
                                                                        <h5 class="mb-0">( pertumbuhan 62% )</h5>
                                                                    </div>
                                                                    <div class="d-lg-flex">
                                                                        <p class="mr-2 mb-0">Zona Waktu:</p>
                                                                        <p class="text-dark font-weight-bold mb-0">GMT-0400 Waktu Timur</p>
                                                                    </div>
                                                                </div>
                                                                <div class="graph-custom-legend clearfix" id="device-sales-legend"></div>
                                                                <canvas id="device-sales"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 grid-margin stretch-card">
                                            <div class="card card-danger-gradient">
                                                <div class="card-body mb-4">
                                                    <h4 class="card-title text-white">Retensi Akun</h4>
                                                    <canvas id="account-retension"></canvas>
                                                </div>
                                                <div class="card-body bg-white pt-4">
                                                    <div class="row pt-4">
                                                        <div class="col-sm-6">
                                                            <div class="text-center border-right border-md-0">
                                                                <h4>Konversi</h4>
                                                                <h1 class="text-dark font-weight-bold mb-md-3">$306</h1>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="text-center">
                                                                <h4>Pembatalan</h4>
                                                                <h1 class="text-dark font-weight-bold">$1,520</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-xl-flex justify-content-between mb-2">
                                                        <h4 class="card-title">Analitik Tampilan Halaman</h4>
                                                        <div class="graph-custom-legend primary-dot" id="pageViewAnalyticLengend"></div>
                                                    </div>
                                                    <canvas id="page-view-analytic"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="footer-inner-wraper">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Hak Cipta ©
                                bootstrapdash.com 2023</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Gratis <a
                                    href="https://www.bootstrapdash.com/" target="_blank">Template dashboard Bootstrap
                                    </a> dari Bootstrapdash.com</span>
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

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
        // Script untuk mengambil nama pengguna dari localStorage atau session
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil nama pengguna dari localStorage (contoh: dari halaman login)
            const userName = localStorage.getItem('userName') || 'Faras';

            // Update nama di navbar kanan atas
            document.getElementById('userName').textContent = userName;

            // Update nama di sidebar
            document.getElementById('sidebarUserName').textContent = userName;
        });
    </script>
</body>
</html>
