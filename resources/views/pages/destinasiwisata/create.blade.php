<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Destinasi Wisata - Bina Desa</title>

    <!-- {{-- Start CSS --}} -->
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets-admin/css/style.css') }}">
    <!-- End layout styles -->
    <style>
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: 600;
            color: #2c3e50;
        }
        .required-star {
            color: #e74c3c;
        }
        .field-error {
            border-color: #e74c3c !important;
            background-color: #fdf2f2;
        }
        .error-message {
            color: #e74c3c;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }
    </style>
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
                            <input type="text" class="form-control bg-transparent border-0" placeholder="Cari destinasi...">
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
                                <p class="mb-1 text-black">{{ Auth::user()->name ?? 'Admin' }}</p>
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
            <!-- {{-- end sidebar --}} -->

            <div class="main-panel">
                <div class="content-wrapper">

                    <!-- {{-- start main content --}} -->
                    <!-- Header -->
                    <div class="page-header">
                        <h3 class="page-title">
                            <i class="mdi mdi-map-marker-plus text-primary mr-2"></i>
                            Tambah Destinasi Wisata
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('destinasiwisata.index') }}">Destinasi Wisata</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Destinasi</li>
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

                    <!-- Error List di Atas Form -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle-outline mr-2"></i>
                            <strong>Terjadi kesalahan!</strong> Silakan perbaiki data berikut:
                            <ul class="mt-2 mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Form Tambah Destinasi Wisata -->
                    <div class="card form-container">
                        <div class="card-body">
                            <form action="{{ route('destinasiwisata.store') }}" method="POST" id="destinasiForm">
                                @csrf

                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <!-- Nama Destinasi -->
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Destinasi <span class="required-star">*</span></label>
                                            <input type="text" class="form-control @error('nama') field-error @enderror"
                                                   id="nama" name="nama" value="{{ old('nama') }}"
                                                   placeholder="Masukkan nama destinasi wisata">
                                            @error('nama')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Deskripsi -->
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi <span class="required-star">*</span></label>
                                            <textarea class="form-control @error('deskripsi') field-error @enderror"
                                                      id="deskripsi" name="deskripsi" rows="3"
                                                      placeholder="Masukkan deskripsi destinasi">{{ old('deskripsi') }}</textarea>
                                            @error('deskripsi')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Alamat -->
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat <span class="required-star">*</span></label>
                                            <textarea class="form-control @error('alamat') field-error @enderror"
                                                      id="alamat" name="alamat" rows="2"
                                                      placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                            @error('alamat')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <!-- RT & RW -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="rt" class="form-label">RT <span class="required-star">*</span></label>
                                                    <input type="text" class="form-control @error('rt') field-error @enderror"
                                                           id="rt" name="rt" value="{{ old('rt') }}"
                                                           placeholder="Contoh: 001" maxlength="3">
                                                    @error('rt')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="rw" class="form-label">RW <span class="required-star">*</span></label>
                                                    <input type="text" class="form-control @error('rw') field-error @enderror"
                                                           id="rw" name="rw" value="{{ old('rw') }}"
                                                           placeholder="Contoh: 002" maxlength="3">
                                                    @error('rw')
                                                        <div class="error-message">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Jam Buka -->
                                        <div class="mb-3">
                                            <label for="jam_buka" class="form-label">Jam Buka <span class="required-star">*</span></label>
                                            <input type="time" class="form-control @error('jam_buka') field-error @enderror"
                                                   id="jam_buka" name="jam_buka" value="{{ old('jam_buka') }}">
                                            @error('jam_buka')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Harga Tiket -->
                                        <div class="mb-3">
                                            <label for="tiket" class="form-label">Harga Tiket (Rp) <span class="required-star">*</span></label>
                                            <input type="number" class="form-control @error('tiket') field-error @enderror"
                                                   id="tiket" name="tiket" value="{{ old('tiket') }}"
                                                   placeholder="Masukkan harga tiket" min="0" step="0.01">
                                            @error('tiket')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Kontak -->
                                        <div class="mb-3">
                                            <label for="kontak" class="form-label">Kontak <span class="required-star">*</span></label>
                                            <input type="text" class="form-control @error('kontak') field-error @enderror"
                                                   id="kontak" name="kontak" value="{{ old('kontak') }}"
                                                   placeholder="Masukkan nomor kontak" maxlength="15">
                                            @error('kontak')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('destinasiwisata.index') }}" class="btn btn-outline-secondary">
                                                <i class="mdi mdi-arrow-left mr-1"></i>Kembali
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-content-save mr-1"></i>Simpan Destinasi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
        // Auto format untuk input RT dan RW (hanya angka)
        document.getElementById('rt').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        document.getElementById('rw').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Auto format untuk input kontak (hanya angka dan +)
        document.getElementById('kontak').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });

        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    </script>
    <!-- {{-- End JS --}} -->
</body>
</html>
