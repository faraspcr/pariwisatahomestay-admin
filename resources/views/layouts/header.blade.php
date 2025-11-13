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
                        <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#fiturUtama" aria-expanded="false" aria-controls="fiturUtama">
                            <span class="icon-bg"><i class="mdi mdi-apps menu-icon"></i></span>
                            <span class="menu-title">Fitur Utama</span>
                        </a>
                        <div class="collapse" id="fiturUtama">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('destinasiwisata.index') }}">
                                        <i class="mdi mdi-map-marker menu-icon"></i>
                                        Destinasi Wisata
                                    </a>
                                </li>
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

                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#masterData" aria-expanded="false" aria-controls="masterData">
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
                            <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                                <i class="mdi mdi-logout"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
