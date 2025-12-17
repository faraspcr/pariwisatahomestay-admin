<!-- ==================== START HEADER ==================== -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
            <div style="color: #28a745; font-size: 24px; font-weight: bold; display: flex; align-items: center; justify-content: center; width: 100%;">
                <i class="mdi mdi-home-group mr-2"></i>BINA DESA
            </div>
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
            <div style="color: #28a745; font-size: 18px; font-weight: bold; display: flex; align-items: center; justify-content: center;">
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
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Cari data...">
                </div>
            </form>
        </div>

        <ul class="navbar-nav navbar-nav-right">
            <!-- Notification Bell -->
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="count-symbol bg-danger">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0 bg-primary text-white">Notifikasi</h6>
                    <div class="dropdown-divider"></div>
                    <!-- Notifikasi items -->
                </div>
            </li>

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img mr-3">
                        <div class="profile-avatar" style="width: 35px; height: 35px; font-size: 1.2rem;">
                            <i class="mdi mdi-account"></i>
                        </div>
                    </div>
                    <div class="nav-profile-text d-flex align-items-center">
                        <p class="mb-0 text-black">{{ Auth::user()->name ?? 'Guest' }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                    <div class="p-3 text-center bg-primary">
                        <div class="profile-avatar" style="margin: 0 auto 15px; width: 70px; height: 70px; font-size: 2rem;">
                            <i class="mdi mdi-account"></i>
                        </div>
                        <p class="mt-2 mb-0 text-white" style="font-weight: 700;">{{ Auth::user()->name ?? 'Guest' }}</p>
                        <small class="text-white">{{ Auth::user()->email ?? 'admin@example.com' }}</small>
                    </div>
                    <div class="p-2">
                        <h5 class="dropdown-header text-uppercase pl-2 text-dark">Akun Pengguna</h5>
                        <a class="dropdown-item py-2 d-flex align-items-center justify-content-between" href="#">
                            <span>Profil Saya</span>
                            <i class="mdi mdi-account-outline ml-1"></i>
                        </a>
                        <a class="dropdown-item py-2 d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            <span>Pengaturan</span>
                            <i class="mdi mdi-settings"></i>
                        </a>
                        <a class="dropdown-item py-2 d-flex align-items-center justify-content-between" href="#" style="cursor: default;">
                            <span>Login Terakhir</span>
                            <span class="text-muted">{{ session('last_login') ?? now()->format('d/m/Y H:i') }}</span>
                        </a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item py-2 d-flex align-items-center justify-content-between" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span>Logout</span>
                            <i class="mdi mdi-logout ml-1"></i>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<!-- ==================== END HEADER ==================== -->
