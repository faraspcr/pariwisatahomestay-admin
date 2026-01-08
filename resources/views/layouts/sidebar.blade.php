<!-- ==================== START SIDEBAR ==================== -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Kategori: Menu Utama -->
        <li class="nav-item nav-category">Menu Utama</li>

        <!-- Item Menu: Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}" data-route="dashboard">
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
                        @php
                            $user = Auth::user();
                            $role = $user->role ?? 'admin';
                        @endphp

                        @if($role === 'admin')
                            <a class="nav-link" href="{{ route('admin.destinasiwisata.index') }}" data-route="admin.destinasiwisata.index">
                        @elseif($role === 'pemilik')
                            <a class="nav-link" href="{{ route('pemilik.destinasi.index') }}" data-route="pemilik.destinasi.index">
                        @elseif($role === 'warga')
                            <a class="nav-link" href="{{ route('warga.destinasi.index') }}" data-route="warga.destinasi.index">
                        @else
                            <a class="nav-link" href="{{ route('view.destinasi.index') }}" data-route="view.destinasi.index">
                        @endif
                            <i class="mdi mdi-map-marker menu-icon"></i>
                            Destinasi Wisata
                        </a>
                    </li>

                    <!-- Sub-menu: HOMESTAY -->
                    <li class="nav-item">
                        @if($role === 'admin')
                            <a class="nav-link" href="{{ route('admin.homestay.index') }}" data-route="admin.homestay.index">
                        @elseif($role === 'pemilik')
                            <a class="nav-link" href="{{ route('pemilik.homestay.index') }}" data-route="pemilik.homestay.index">
                        @elseif($role === 'warga')
                            <a class="nav-link" href="{{ route('warga.homestay.index') }}" data-route="warga.homestay.index">
                        @else
                            <a class="nav-link" href="{{ route('view.homestay.index') }}" data-route="view.homestay.index">
                        @endif
                            <i class="mdi mdi-home menu-icon"></i>
                            Homestay
                        </a>
                    </li>

                    <!-- Sub-menu: KAMAR HOMESTAY -->
                    <li class="nav-item">
                        @if($role === 'admin')
                            <a class="nav-link" href="{{ route('admin.kamarhomestay.index') }}" data-route="admin.kamarhomestay.index">
                        @elseif($role === 'pemilik')
                            <a class="nav-link" href="{{ route('pemilik.kamar.index') }}" data-route="pemilik.kamar.index">
                        @elseif($role === 'warga')
                            <a class="nav-link" href="{{ route('warga.kamar.index') }}" data-route="warga.kamar.index">
                        @else
                            <a class="nav-link" href="{{ route('view.kamar.index') }}" data-route="view.kamar.index">
                        @endif
                            <i class="mdi mdi-door-closed menu-icon"></i>
                            Kamar Homestay
                        </a>
                    </li>

                    <!-- Sub-menu: BOOKING -->
                    <li class="nav-item">
                        @if($role === 'admin')
                            <a class="nav-link" href="{{ route('admin.booking-homestay.index') }}" data-route="admin.booking-homestay.index">
                        @elseif($role === 'pemilik')
                            <a class="nav-link" href="{{ route('pemilik.booking.index') }}" data-route="pemilik.booking.index">
                        @elseif($role === 'warga')
                            <a class="nav-link" href="{{ route('warga.booking.index') }}" data-route="warga.booking.index">
                        @endif
                            <i class="mdi mdi-calendar-check menu-icon"></i>
                            Booking
                        </a>
                    </li>

                    <!-- Sub-menu: Ulasan Wisata -->
                    <li class="nav-item">
                        @if($role === 'admin')
                            <a class="nav-link" href="{{ route('admin.ulasan_wisata.index') }}" data-route="admin.ulasan_wisata.index">
                        @elseif($role === 'pemilik')
                            <a class="nav-link" href="{{ route('pemilik.ulasan.index') }}" data-route="pemilik.ulasan.index">
                        @elseif($role === 'warga')
                            <a class="nav-link" href="{{ route('warga.ulasan.index') }}" data-route="warga.ulasan.index">
                        @endif
                            <i class="mdi mdi-star-circle menu-icon"></i>
                            Ulasan Wisata
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Kategori: Master Data -->
        @if($role === 'admin')
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
                        <a class="nav-link" href="{{ route('admin.user.index') }}" data-route="admin.user.index">
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                            Manajemen User
                        </a>
                    </li>

                    <!-- Sub-menu: Data Warga -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.warga.index') }}" data-route="admin.warga.index">
                            <i class="mdi mdi-account-group menu-icon"></i>
                            Data Warga
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endif

        <!-- Bagian User & Settings di Bawah Sidebar -->
        <li class="nav-item sidebar-user-actions mt-4">
            <div class="settings-logout-section">
                @php
                    $user = Auth::user();
                    $hasProfilePicture = !empty($user->profile_picture);
                @endphp

                <!-- Info User -->
                <div class="user-display-section">
                    <div class="user-avatar-small {{ $hasProfilePicture ? 'has-image' : '' }}">
                        @if($hasProfilePicture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                 alt="{{ $user->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="mdi mdi-account"></i>
                        @endif
                    </div>
                    <div class="user-info-small">
                        <h5>{{ $user->name ?? 'Guest' }}</h5>
                        <p>{{ strtoupper($user->role ?? 'ADMIN') }} PARIWISATA DESA</p>
                    </div>
                </div>

                <!-- Item Settings -->
                <a class="settings-item" href="{{ route('user.my-profile') }}">
                    <i class="mdi mdi-cog"></i>
                    <span>Settings</span>
                </a>

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

<!-- Logout Form untuk Sidebar -->
<form id="sidebar-logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<style>
/* ==================== CSS SIDEBAR LENGKAP ==================== */

.sidebar-logo-title {
    font-size: 16px !important;
    font-weight: 700 !important;
    color: white !important;
    margin: 5px 0 !important;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3) !important;
    letter-spacing: 0.5px !important;
}

.sidebar-logo-subtitle {
    font-size: 11px !important;
    color: rgba(255, 255, 255, 0.8) !important;
    margin: 0 !important;
    line-height: 1.3 !important;
    font-weight: 300 !important;
}

/* Sidebar Menu Items - DIUBAH UKURAN SEPERTI TEMPLATE LAMA */
.nav {
    padding: 0 5px;
}

.nav-category {
    margin-top: 30px !important;
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
    transition: all 0.3s ease !important;
}

.nav-item .nav-link:hover {
    background: rgba(255, 255, 255, 0.1) !important;
}

/* ACTIVE MENU STYLE */
.nav-item .nav-link.active {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.2), rgba(32, 201, 151, 0.1)) !important;
    border: 1px solid rgba(40, 167, 69, 0.3) !important;
    box-shadow: 0 2px 10px rgba(40, 167, 69, 0.2) !important;
}

.nav-item .nav-link.active .menu-icon {
    color: white !important;
}

.nav-item .nav-link.active .menu-title {
    color: white !important;
    font-weight: 600 !important;
}

/* Sub-menu Active State */
.sub-menu .nav-link.active {
    background: rgba(40, 167, 69, 0.15) !important;
    border-left: 3px solid #28a745 !important;
    padding-left: 13px !important;
}

.sub-menu .nav-link.active i {
    color: #28a745 !important;
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
    transition: color 0.3s ease !important;
}

.nav-item .nav-link .menu-title {
    font-size: 13px !important;
    font-weight: 500 !important;
    color: rgba(255, 255, 255, 0.9) !important;
    transition: color 0.3s ease !important;
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
    transition: all 0.3s ease !important;
}

.sub-menu .nav-link:hover {
    background: rgba(255, 255, 255, 0.05) !important;
}

.sub-menu .nav-link i {
    font-size: 12px !important;
    margin-right: 6px !important;
    width: 16px !important;
    text-align: center !important;
    color: rgba(255, 255, 255, 0.7) !important;
    transition: color 0.3s ease !important;
}

.sub-menu .nav-link {
    color: rgba(255, 255, 255, 0.8) !important;
}

/* User Display & Settings di Sidebar - DIUBAH SEPERTI TEMPLATE LAMA */
.sidebar-user-actions {
    margin-top: 15px !important;
    padding: 10px 5px !important;
    border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
}

/* User Avatar dengan Foto */
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

/* Dropdown Toggle Animation */
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

/* ==================== DEVELOPER IDENTITY & SETTINGS CSS ==================== */
.settings-logout-section {
    margin-top: 15px;
    padding: 10px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.1);
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

.settings-item {
    display: flex;
    align-items: center;
    padding: 8px 10px;
    border-radius: 6px;
    margin-bottom: 6px;
    transition: all 0.3s ease;
    cursor: pointer;
    background: rgba(255, 255, 255, 0.05);
    text-decoration: none;
}

.settings-item:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateX(3px);
    text-decoration: none;
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

/* Smooth Collapse Animation */
.collapse {
    transition: height 0.35s ease;
}

/* Responsive Design untuk Sidebar */
@media (max-width: 768px) {
    /* Sidebar Logo Responsive */
    .sidebar-logo {
        width: 50px !important;
        height: 50px !important;
    }

    .sidebar-logo img {
        width: 50px !important;
        height: 50px !important;
    }

    .sidebar-logo-title {
        font-size: 14px !important;
    }

    .sidebar-logo-subtitle {
        font-size: 10px !important;
    }
}
</style>

<script>
// ==================== JAVASCRIPT UNTUK ACTIVE MENU ====================
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap collapse dengan event handling yang benar
    $('.dropdown-toggle').on('click', function(e) {
        e.preventDefault();
        const target = $(this).attr('href');
        $(target).collapse('toggle');

        // Update aria-expanded attribute
        const isExpanded = $(this).attr('aria-expanded') === 'true';
        $(this).attr('aria-expanded', !isExpanded);
    });

    // Handle collapse events untuk update arrow icon
    $('#fiturUtama, #masterData').on('show.bs.collapse', function() {
        const toggle = $('[href="#' + this.id + '"]');
        toggle.attr('aria-expanded', 'true');
    }).on('hide.bs.collapse', function() {
        const toggle = $('[href="#' + this.id + '"]');
        toggle.attr('aria-expanded', 'false');
    });

    // ========== ACTIVE MENU DETECTION ==========
    function setActiveMenu() {
        const currentPath = window.location.pathname;
        const allMenuLinks = document.querySelectorAll('.sidebar .nav-link');

        // Reset semua active class
        allMenuLinks.forEach(link => {
            link.classList.remove('active');
        });

        // Cek route name dari Laravel
        const currentRoute = getCurrentRouteName();

        // Cari link yang sesuai dengan route
        allMenuLinks.forEach(link => {
            const routeName = link.getAttribute('data-route');

            if (routeName && routeName === currentRoute) {
                link.classList.add('active');

                // Jika ada parent dropdown, buka dropdownnya
                const parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    $(parentCollapse).collapse('show');
                    const toggle = document.querySelector(`[href="#${parentCollapse.id}"]`);
                    if (toggle) {
                        toggle.setAttribute('aria-expanded', 'true');
                    }
                }
            }
        });

        // Fallback: jika tidak ada route match, coba match URL
        if (!document.querySelector('.sidebar .nav-link.active')) {
            allMenuLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && currentPath.includes(href.replace(window.location.origin, ''))) {
                    link.classList.add('active');

                    // Jika ada parent dropdown, buka dropdownnya
                    const parentCollapse = link.closest('.collapse');
                    if (parentCollapse) {
                        $(parentCollapse).collapse('show');
                        const toggle = document.querySelector(`[href="#${parentCollapse.id}"]`);
                        if (toggle) {
                            toggle.setAttribute('aria-expanded', 'true');
                        }
                    }
                }
            });
        }
    }

    // Fungsi untuk mendapatkan current route name
    function getCurrentRouteName() {
        // Jika menggunakan Laravel, bisa dapat dari meta tag
        const metaRoute = document.querySelector('meta[name="current-route"]');
        if (metaRoute) {
            return metaRoute.getAttribute('content');
        }

        // Fallback: ekstrak dari URL
        const path = window.location.pathname;

        // Mapping path ke route name berdasarkan role
        const userRole = '{{ Auth::user()->role ?? "admin" }}';

        // Daftar mapping route berdasarkan role
        const routeMappings = {
            'admin': {
                '/admin/destinasiwisata': 'admin.destinasiwisata.index',
                '/admin/homestay': 'admin.homestay.index',
                '/admin/kamarhomestay': 'admin.kamarhomestay.index',
                '/admin/booking-homestay': 'admin.booking-homestay.index',
                '/admin/ulasan_wisata': 'admin.ulasan_wisata.index',
                '/admin/user': 'admin.user.index',
                '/admin/warga': 'admin.warga.index',
                '/dashboard': 'dashboard'
            },
            'pemilik': {
                '/pemilik/destinasi': 'pemilik.destinasi.index',
                '/pemilik/homestay': 'pemilik.homestay.index',
                '/pemilik/kamar': 'pemilik.kamar.index',
                '/pemilik/booking': 'pemilik.booking.index',
                '/pemilik/ulasan': 'pemilik.ulasan.index',
                '/pemilik/dashboard': 'pemilik.dashboard'
            },
            'warga': {
                '/warga/destinasi': 'warga.destinasi.index',
                '/warga/homestay': 'warga.homestay.index',
                '/warga/kamar': 'warga.kamar.index',
                '/warga/booking': 'warga.booking.index',
                '/warga/ulasan': 'warga.ulasan.index',
                '/warga/dashboard': 'warga.dashboard'
            }
        };

        const mappings = routeMappings[userRole] || routeMappings['admin'];

        for (const [pathPattern, routeName] of Object.entries(mappings)) {
            if (path.includes(pathPattern)) {
                return routeName;
            }
        }

        return null;
    }

    // Set active menu saat pertama kali load
    setActiveMenu();

    // Update active menu saat klik menu (untuk SPA-like behavior)
    const menuLinks = document.querySelectorAll('.sidebar .nav-link');
    menuLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Hanya untuk link internal
            const href = this.getAttribute('href');
            if (href && (href.startsWith('/') || href.startsWith('{{ url('') }}'))) {
                // Hapus semua active class
                menuLinks.forEach(l => l.classList.remove('active'));

                // Tambah active class ke link yang diklik
                this.classList.add('active');

                // Jika adalah sub-menu, buka parent collapse
                if (this.closest('.sub-menu')) {
                    const parentCollapse = this.closest('.collapse');
                    if (parentCollapse) {
                        $(parentCollapse).collapse('show');
                    }
                }
            }
        });
    });

    // Simulasi route change (untuk SPA)
    window.addEventListener('popstate', function() {
        setActiveMenu();
    });
});
</script>
