<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Bina Desa</title>

    <!-- {{-- Start CSS --}} -->
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets-admin/css/style.css') }}">
    <!-- End layout styles -->
    <style>
        .badge-gender-male {
            background: linear-gradient(45deg, #1976D2, #64B5F6);
            color: white;
        }
        .badge-gender-female {
            background: linear-gradient(45deg, #C2185B, #F48FB1);
            color: white;
        }
        .badge-religion {
            background: linear-gradient(45deg, #388E3C, #66BB6A);
            color: white;
        }
        .badge-job {
            background: linear-gradient(45deg, #F57C00, #FFB74D);
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(41, 98, 255, 0.05);
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }
        .action-buttons .btn {
            border-radius: 8px;
            margin: 2px;
        }
    </style>
    <!-- {{-- End CSS --}} -->
</head>
<body>
    <div class="container-scroller">

        <!-- {{-- start header --}} -->
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
                    <div style="color: #28a745; font-size: 24px; font-weight: bold; display: flex; align-items: center; justify-content: center; width: 100%;">
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
                            <input type="text" class="form-control bg-transparent border-0" placeholder="Cari warga...">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <div class="nav-profile-icon">
                                    <i class="mdi mdi-account" style="font-size: 24px; color: #6c757d;"></i>
                                </div>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{ Auth::user()->name ?? 'Faras' }}</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->
        <!-- {{-- end header --}} -->

        <div class="container-fluid page-body-wrapper">

            <!-- {{-- start sidebar --}} -->
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
                        <a class="nav-link" href="#">
                            <span class="icon-bg"><i class="mdi mdi-account menu-icon"></i></span>
                            <span class="menu-title">User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('warga.index') }}">
                            <span class="icon-bg"><i class="mdi mdi-account-multiple menu-icon"></i></span>
                            <span class="menu-title">Data Warga</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('destinasiwisata.index') }}">
                            <span class="icon-bg"><i class="mdi mdi-map-marker menu-icon"></i></span>
                            <span class="menu-title">Destinasi Wisata</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <!-- {{-- end sidebar --}} -->

            <div class="main-panel">
                <div class="content-wrapper">

                    <!-- {{-- start main content --}} -->
                    <!-- Header -->
                    <div class="page-header">
                        <h3 class="page-title">
                            <i class="mdi mdi-account-multiple text-primary mr-2"></i>
                            Data Warga
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Warga</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Alert Success -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-circle-outline mr-2"></i>
                            <strong>Sukses!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle-outline mr-2"></i>
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Card Data Warga -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title mb-0">Daftar Warga Terdaftar</h4>
                                <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Warga
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>No KTP</th>
                                            <th>Nama Lengkap</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                            <th class="text-center">Agama</th>
                                            <th class="text-center">Pekerjaan</th>
                                            <th>Telepon</th>
                                            <th>Email</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($warga as $item)
                                        <tr>
                                            <td class="text-center">
                                                <span class="badge badge-info">{{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-primary">{{ $item->no_ktp }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3">
                                                        <i class="mdi mdi-account-circle text-primary" style="font-size: 24px;"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold">{{ $item->nama }}</div>
                                                        <small class="text-muted">ID: {{ $item->warga_id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if($item->jenis_kelamin == 'L')
                                                    <span class="badge badge-gender-male py-2 px-3">
                                                        <i class="mdi mdi-gender-male mr-1"></i>Laki-laki
                                                    </span>
                                                @else
                                                    <span class="badge badge-gender-female py-2 px-3">
                                                        <i class="mdi mdi-gender-female mr-1"></i>Perempuan
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-religion py-2 px-3">
                                                    <i class="mdi mdi-church mr-1"></i>{{ $item->agama }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-job py-2 px-3">
                                                    <i class="mdi mdi-briefcase mr-1"></i>{{ $item->pekerjaan }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-phone mr-2 text-success"></i>
                                                    <span class="font-weight-bold">{{ $item->telp }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if($item->email)
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-email mr-2 text-warning"></i>
                                                        <span class="text-truncate" style="max-width: 150px;">{{ $item->email }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center action-buttons">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('warga.edit', $item->warga_id) }}"
                                                       class="btn btn-outline-info btn-sm"
                                                       data-toggle="tooltip"
                                                       title="Edit Data">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit"
                                                                class="btn btn-outline-danger btn-sm"
                                                                data-toggle="tooltip"
                                                                title="Hapus Data"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data warga {{ $item->nama }}?')">
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
                                                    <i class="mdi mdi-account-off-outline text-muted" style="font-size: 64px;"></i>
                                                    <h4 class="text-muted mt-3">Belum ada data warga</h4>
                                                    <p class="text-muted">Silakan tambah data warga terlebih dahulu</p>
                                                    <a href="{{ route('warga.create') }}" class="btn btn-primary mt-2">
                                                        <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Warga Pertama
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Info Summary -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-information-outline mr-2" style="font-size: 24px;"></i>
                                            <div>
                                                <h6 class="alert-heading mb-1">Total Data Warga: {{ $warga->count() }}</h6>
                                                <p class="mb-0">Data warga yang terdaftar dalam sistem Bina Desa</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- {{-- end main content --}} -->

                </div>
                <!-- content-wrapper ends -->

                <!-- {{-- start footer --}} -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="footer-inner-wraper">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Bina Desa 2023</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Sistem Administrasi Desa</span>
                        </div>
                    </div>
                </footer>
                <!-- partial -->
                <!-- {{-- end footer --}} -->

            </div>
        </div>
    </div>

    <!-- {{-- Start JS --}} -->
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
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    </script>
    <!-- {{-- End JS --}} -->
</body>
</html>
