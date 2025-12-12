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
                                <!-- ==== TAMBAHKAN INI: Nama user dari Auth ==== -->
                                <p class="mb-0 text-black">{{ Auth::user()->name ?? 'Guest' }}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                            aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                            <div class="p-3 text-center bg-primary">
                                <div class="profile-avatar"
                                    style="margin: 0 auto 15px; width: 70px; height: 70px; font-size: 2rem;">
                                    <i class="mdi mdi-account"></i>
                                </div>
                                <!-- ==== TAMBAHKAN INI: Nama dan email user ==== -->
                                <p class="mt-2 mb-0 text-white" style="font-weight: 700;">{{ Auth::user()->name ?? 'Guest' }}</p>
                                <small class="text-white">{{ Auth::user()->email ?? 'admin@example.com' }}</small>
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

                                <!-- ==== TAMBAHKAN INI: Waktu login terakhir ==== -->
                                <a class="dropdown-item py-2 d-flex align-items-center justify-content-between" href="#" style="cursor: default;">
                                    <span>Login Terakhir</span>
                                    <span class="text-muted">{{ session('last_login') ?? 'Belum ada data' }}</span>
                                </a>

                                <div role="separator" class="dropdown-divider"></div>

                                <!-- ==== TAMBAHKAN INI: Route logout ==== -->
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
