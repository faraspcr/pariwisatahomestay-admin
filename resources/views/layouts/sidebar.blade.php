{{-- ====================== START SIDEBAR ====================== --}}
<!-- {{-- start sidebar --}} -->
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Utama</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}" data-no-spa>
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}" data-no-spa>
                <span class="icon-bg"><i class="mdi mdi-account menu-icon"></i></span>
                <span class="menu-title">User</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('warga.index') }}" data-no-spa>
                <span class="icon-bg"><i class="mdi mdi-account-multiple menu-icon"></i></span>
                <span class="menu-title">Data Warga</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('destinasiwisata.index') }}" data-no-spa>
                <span class="icon-bg"><i class="mdi mdi-map-marker menu-icon"></i></span>
                <span class="menu-title">Destinasi Wisata</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('ulasan_wisata.index') }}" data-no-spa>
                <span class="icon-bg"><i class="mdi mdi-account-group menu-icon"></i></span>
                <span class="menu-title">Ulasan Wisata</span>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->
<!-- {{-- end sidebar --}} -->
{{-- ====================== END SIDEBAR ====================== --}}
