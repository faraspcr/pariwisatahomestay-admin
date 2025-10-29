<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Warga - Bina Desa</title>

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
        .error-list {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .error-list ul {
            margin: 0;
            padding-left: 20px;
        }
        .error-list li {
            color: #721c24;
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
                            <i class="mdi mdi-account-plus text-primary mr-2"></i>
                            Tambah Warga
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('warga.index') }}">Data Warga</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Warga</li>
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

                    <!-- Form Tambah Warga -->
                    <div class="card form-container">
                        <div class="card-body">
                            <form action="{{ route('warga.store') }}" method="POST" id="wargaForm">
                                @csrf

                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <!-- No KTP -->
                                        <div class="mb-3">
                                            <label for="no_ktp" class="form-label">No KTP <span class="required-star">*</span></label>
                                            <input type="text" class="form-control @error('no_ktp') field-error @enderror"
                                                   id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}"
                                                   placeholder="Masukkan 16 digit No KTP" maxlength="16">
                                            @error('no_ktp')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Nama Lengkap -->
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap <span class="required-star">*</span></label>
                                            <input type="text" class="form-control @error('nama') field-error @enderror"
                                                   id="nama" name="nama" value="{{ old('nama') }}"
                                                   placeholder="Masukkan nama lengkap">
                                            @error('nama')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Jenis Kelamin -->
                                        <div class="mb-3">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="required-star">*</span></label>
                                            <select class="form-control @error('jenis_kelamin') field-error @enderror"
                                                    id="jenis_kelamin" name="jenis_kelamin">
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <!-- Agama -->
                                        <div class="mb-3">
                                            <label for="agama" class="form-label">Agama <span class="required-star">*</span></label>
                                            <select class="form-control @error('agama') field-error @enderror"
                                                    id="agama" name="agama">
                                                <option value="">-- Pilih Agama --</option>
                                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                            @error('agama')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Pekerjaan -->
                                        <div class="mb-3">
                                            <label for="pekerjaan" class="form-label">Pekerjaan <span class="required-star">*</span></label>
                                            <input type="text" class="form-control @error('pekerjaan') field-error @enderror"
                                                   id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}"
                                                   placeholder="Masukkan pekerjaan">
                                            @error('pekerjaan')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Telepon -->
                                        <div class="mb-3">
                                            <label for="telp" class="form-label">No. Telepon <span class="required-star">*</span></label>
                                            <input type="text" class="form-control @error('telp') field-error @enderror"
                                                   id="telp" name="telp" value="{{ old('telp') }}"
                                                   placeholder="Masukkan nomor HP" maxlength="15">
                                            @error('telp')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') field-error @enderror"
                                                   id="email" name="email" value="{{ old('email') }}"
                                                   placeholder="Contoh: nama@email.com">
                                            @error('email')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">
                                                <i class="mdi mdi-arrow-left mr-1"></i>Kembali
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-content-save mr-1"></i>Simpan Data
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
        // Auto format untuk input telepon
        document.getElementById('telp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });

        // Auto format untuk input NIK (hanya angka)
        document.getElementById('no_ktp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    </script>
    <!-- {{-- End JS --}} -->
</body>
</html>
