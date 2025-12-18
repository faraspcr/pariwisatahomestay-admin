<!-- ==================== START HEADER ==================== -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
            <div class="d-flex align-items-center">
                <!-- LOGO di HEADER -->
                <div class="header-logo" style="width: 35px; height: 35px; margin-right: 10px;">
                    <img src="{{ asset('assets-admin/images/logopariwisata.png') }}"
                         alt="Logo"
                         onerror="this.onerror=null; this.src='{{ asset('images/logo-default.png') }}';"
                         style="width: 100%; height: 100%; object-fit: contain;">
                </div>
                <!-- TEKS PARIWISATA DESA -->
                <div class="header-logo-text" style="color: #28a745; font-size: 18px; font-weight: bold; white-space: nowrap;">
                    Pariwisata Desa
                </div>
            </div>
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
            <div class="header-logo" style="width: 30px; height: 30px;">
                <img src="{{ asset('assets-admin/images/logopariwisata.png') }}"
                     alt="Logo"
                     onerror="this.onerror=null; this.src='{{ asset('images/logo-default.png') }}';"
                     style="width: 100%; height: 100%; object-fit: contain;">
            </div>
        </a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between flex-grow-1">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <!-- SEARCH BAR - DI TENGAH -->
        <div class="search-field d-flex align-items-center justify-content-center flex-grow-1 mx-3" style="max-width: 400px;">
            <div class="input-group" style="background: #f8f9fa; border-radius: 8px; padding: 8px 15px; width: 100%;">
                <div class="input-group-prepend" style="border: none; background: transparent;">
                    <i class="mdi mdi-magnify" style="color: #6c757d; font-size: 20px;"></i>
                </div>
                <input type="text"
                       class="form-control border-0"
                       placeholder="Cari data..."
                       style="background: transparent; color: #495057; font-size: 14px; padding-left: 10px; outline: none;">
            </div>
        </div>

        <ul class="navbar-nav navbar-nav-right d-flex align-items-center">
            <!-- Notification Bell -->
            <li class="nav-item dropdown me-3">
                <a class="nav-link count-indicator dropdown-toggle p-0 position-relative"
                   id="notificationDropdown"
                   href="#"
                   data-toggle="dropdown">
                    <i class="mdi mdi-bell-outline" style="font-size: 24px; color: #495057;"></i>
                    <span class="count-symbol bg-danger"
                          style="position: absolute; top: -5px; right: -5px; width: 18px; height: 18px; font-size: 10px; display: flex; align-items: center; justify-content: center; border: 2px solid white; border-radius: 50%;">5</span>
                </a>
            </li>

            <!-- PROFILE SECTION -->
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center p-1"
                   id="profileDropdown"
                   href="#"
                   data-toggle="dropdown"
                   aria-expanded="false"
                   style="border-radius: 30px; background: #f8f9fa; min-width: 150px;">
                    <div class="nav-profile-img me-2">
                        <div class="profile-avatar"
                             style="width: 32px; height: 32px; background: linear-gradient(135deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 16px;">
                            <i class="mdi mdi-account"></i>
                        </div>
                    </div>
                    <div class="nav-profile-text d-flex align-items-center justify-content-between flex-grow-1">
                        <div class="text-start">
                            <p class="mb-0 text-black" style="font-size: 14px; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                {{ Auth::user()->name ?? 'Guest' }}
                            </p>
                        </div>
                        <i class="mdi mdi-chevron-down ms-1" style="color: #6c757d;"></i>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                     aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                    <div class="p-3 text-center bg-primary">
                        <div class="profile-avatar"
                             style="margin: 0 auto 15px; width: 70px; height: 70px; background: linear-gradient(135deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
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
                        <a class="dropdown-item py-2 d-flex align-items-center justify-content-between"
                           href="javascript:void(0)">
                            <span>Pengaturan</span>
                            <i class="mdi mdi-settings"></i>
                        </a>
                        <a class="dropdown-item py-2 d-flex align-items-center justify-content-between"
                           href="#" style="cursor: default;">
                            <span>Login Terakhir</span>
                            <span class="text-muted">{{ session('last_login') ?? now()->format('d/m/Y H:i') }}</span>
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

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ms-2" type="button"
                data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<!-- ==================== END HEADER ==================== -->
