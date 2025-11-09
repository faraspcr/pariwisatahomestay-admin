<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Wisata - Bina Desa</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets-admin/css/style.css') }}">
    <!-- End layout styles -->
    <style>
        .badge-price {
            background: linear-gradient(45deg, #FF6B35, #FF8E53);
            color: white;
            font-weight: bold;
        }

        .badge-time {
            background: linear-gradient(45deg, #4CAF50, #66BB6A);
            color: white;
        }

        .badge-location {
            background: linear-gradient(45deg, #2196F3, #64B5F6);
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(76, 175, 80, 0.05);
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }

        .destination-card {
            border-left: 4px solid #28a745;
        }

        .action-buttons .btn {
            border-radius: 8px;
            margin: 2px;
        }

        .description-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
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
                                placeholder="Cari destinasi...">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-profile-img">
                                <div class="nav-profile-icon">
                                    <i class="mdi mdi-account" style="font-size: 24px; color: #6c757d;"></i>
                                </div>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{ Auth::user()->name ?? 'Admin' }}</p>
                            </div>
                        </a>
                    </li>
                </ul>
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <span class="icon-bg"><i class="mdi mdi-account menu-icon"></i></span>
                            <span class="menu-title">User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('warga.index') }}">
                            <span class="icon-bg"><i class="mdi mdi-account-multiple menu-icon"></i></span>
                            <span class="menu-title">Data Warga</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('destinasiwisata.index') }}">
                            <span class="icon-bg"><i class="mdi mdi-map-marker menu-icon"></i></span>
                            <span class="menu-title">Destinasi Wisata</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->

            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Header -->
                    <div class="page-header">
                        <h3 class="page-title">
                            <i class="mdi mdi-map-marker text-success mr-2"></i>
                            Destinasi Wisata
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Destinasi Wisata</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Alert Success -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-circle-outline mr-2"></i>
                            <strong>Sukses!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle-outline mr-2"></i>
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Card Destinasi Wisata -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title mb-0">Daftar Destinasi Wisata</h4>
                                <a href="{{ route('destinasiwisata.create') }}" class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Destinasi
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama Destinasi</th>
                                            <th>Deskripsi</th>
                                            <th>Lokasi</th>
                                            <th class="text-center">RT/RW</th>
                                            <th class="text-center">Jam Buka</th>
                                            <th class="text-center">Tiket</th>
                                            <th>Kontak</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($destinasiWisata as $item)
                                            <tr class="destination-card">
                                                <td class="text-center">
                                                    <span class="badge badge-info">{{ $loop->iteration }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-3">
                                                            <i class="mdi mdi-map-marker-circle text-success"
                                                                style="font-size: 24px;"></i>
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bold text-success">
                                                                {{ $item->nama }}</div>
                                                            <small class="text-muted">ID:
                                                                {{ $item->destinasi_id }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="description-text" style="max-width: 200px;">
                                                        {{ $item->deskripsi }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-map-marker mr-2 text-primary"></i>
                                                        <span class="text-truncate"
                                                            style="max-width: 150px;">{{ $item->alamat }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-location py-2 px-3">
                                                        <i
                                                            class="mdi mdi-home-map-marker mr-1"></i>{{ $item->rt }}/{{ $item->rw }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-time py-2 px-3">
                                                        <i
                                                            class="mdi mdi-clock-outline mr-1"></i>{{ $item->jam_buka }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-price py-2 px-3">
                                                        <i class="mdi mdi-ticket mr-1"></i>Rp
                                                        {{ number_format($item->tiket, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-phone mr-2 text-warning"></i>
                                                        <span class="font-weight-bold">{{ $item->kontak }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-center action-buttons">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('destinasiwisata.edit', $item->destinasi_id) }}"
                                                            class="btn btn-outline-info btn-sm" data-toggle="tooltip"
                                                            title="Edit Data">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('destinasiwisata.show', $item->destinasi_id) }}"
                                                            class="btn btn-outline-primary btn-sm"
                                                            data-toggle="tooltip" title="Lihat Detail">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('destinasiwisata.destroy', $item->destinasi_id) }}"
                                                            method="POST" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm"
                                                                data-toggle="tooltip" title="Hapus Data"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi wisata {{ $item->nama }}?')">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-5">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <i class="mdi mdi-map-marker-off text-muted"
                                                            style="font-size: 64px;"></i>
                                                        <h4 class="text-muted mt-3">Belum ada data destinasi wisata
                                                        </h4>
                                                        <p class="text-muted">Silakan tambah destinasi wisata terlebih
                                                            dahulu</p>
                                                        <a href="{{ route('destinasiwisata.create') }}"
                                                            class="btn btn-success mt-2">
                                                            <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah
                                                            Destinasi Pertama
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @if ($destinasiWisata->hasPages())
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <div class="text-muted">
                                        Menampilkan {{ $destinasiWisata->firstItem() }} -
                                        {{ $destinasiWisata->lastItem() }} dari {{ $destinasiWisata->total() }}
                                        destinasi
                                    </div>
                                    <nav>
                                        {{ $destinasiWisata->links() }}
                                    </nav>
                                </div>
                            @endif

                            <!-- Info Summary -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-information-outline mr-2" style="font-size: 24px;"></i>
                                            <div>
                                                <h6 class="alert-heading mb-1">Total Destinasi Wisata:
                                                    {{ $destinasiWisata->count() }}</h6>
                                                <p class="mb-0">Destinasi wisata yang terdaftar dalam sistem Bina
                                                    Desa</p>
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
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                                Bina Desa 2023</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Sistem
                                Administrasi Desa</span>
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('assets-admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets-admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets-admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets-admin/js/misc.js') }}"></script>
    <!-- endinject -->

    <script>
        // Initialize tooltips
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    </script>
</body>

</html>
