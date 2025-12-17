<!-- ==================== START SIDEBAR ==================== -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Kategori: Menu Utama -->
        <li class="nav-item nav-category">Menu Utama</li>

        <!-- Item Menu: Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="icon-bg"><i class="mdi mdi-view-dashboard menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <!-- Kategori: Fitur Utama -->
        <li class="nav-item nav-category">Fitur Utama</li>

        <!-- Menu Collapsible: Fitur Utama -->
        <li class="nav-item">
            <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#fiturUtama"
                aria-expanded="false" aria-controls="fiturUtama">
                <span class="icon-bg"><i class="mdi mdi-apps menu-icon"></i></span>
                <span class="menu-title">Fitur Utama</span>
            </a>
            <div class="collapse" id="fiturUtama">
                <ul class="nav flex-column sub-menu">
                    <!-- Sub-menu: Destinasi Wisata -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('destinasiwisata.index') }}">
                            <i class="mdi mdi-map-marker menu-icon"></i>
                            Destinasi Wisata
                        </a>
                    </li>

                    <!-- Sub-menu: HOMESTAY -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('homestay.index') }}">
                            <i class="mdi mdi-home menu-icon"></i>
                            Homestay
                        </a>
                    </li>

                    <!-- Sub-menu: KAMAR HOMESTAY -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kamar.my') }}">
                            <i class="mdi mdi-door-closed menu-icon"></i>
                            Kamar Homestay
                        </a>
                    </li>

                    <!-- Sub-menu: BOOKING -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking-homestay.index') }}">
                            <i class="mdi mdi-calendar-check menu-icon"></i>
                            Booking
                        </a>
                    </li>

                    <!-- Sub-menu: Ulasan Wisata -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ulasan_wisata.index') }}">
                            <i class="mdi mdi-star-circle menu-icon"></i>
                            Ulasan Wisata
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Kategori: Master Data -->
        <li class="nav-item nav-category">Master Data</li>

        <!-- Menu Collapsible: Master Data -->
        <li class="nav-item">
            <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#masterData"
                aria-expanded="false" aria-controls="masterData">
                <span class="icon-bg"><i class="mdi mdi-database menu-icon"></i></span>
                <span class="menu-title">Master Data</span>
            </a>
            <div class="collapse" id="masterData">
                <ul class="nav flex-column sub-menu">
                    <!-- Sub-menu: Manajemen User -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                            Manajemen User
                        </a>
                    </li>

                    <!-- Sub-menu: Data Warga -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('warga.index') }}">
                            <i class="mdi mdi-account-group menu-icon"></i>
                            Data Warga
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Bagian User & Settings di Bawah Sidebar -->
        <li class="nav-item sidebar-user-actions mt-4">
            <div class="settings-logout-section">
                <!-- Info User -->
                <div class="user-display-section">
                    <div class="user-avatar-small">
                        <i class="mdi mdi-account"></i>
                    </div>
                    <div class="user-info-small">
                        <h5>{{ Auth::user()->name ?? 'Guest' }}</h5>
                        <p>ADMIN PARIWISATA DESA</p>
                    </div>
                </div>

                <!-- Item Settings -->
                <div class="settings-item">
                    <i class="mdi mdi-cog"></i>
                    <span>Settings</span>
                </div>

                <!-- Item Logout -->
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
