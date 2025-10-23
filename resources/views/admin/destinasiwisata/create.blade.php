<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Destinasi Wisata - Sistem Administrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar min-vh-100">
                <div class="position-sticky pt-3">
                    <div class="p-3">
                        <h4 class="text-white">Sistem Administrasi</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('warga.index') }}">
                                <i class="fas fa-users me-2"></i> Data Warga
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white active" href="{{ route('destinasiwisata.index') }}">
                                <i class="fas fa-map-marker-alt me-2"></i> Destinasi Wisata
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Tambah Destinasi Wisata</h2>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i>Admin
                        </button>
                    </div>
                </div>

                <!-- Alert Success/Error -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Form -->
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('destinasiwisata.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Nama -->
                                    <div class="mb-3">
                                        <label class="form-label">Nama Destinasi <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                               value="{{ old('nama') }}" required>
                                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <!-- Deskripsi -->
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                                  rows="3" required>{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <!-- Alamat -->
                                    <div class="mb-3">
                                        <label class="form-label">Alamat <span class="text-danger">*</span></label>
                                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                                  rows="2" required>{{ old('alamat') }}</textarea>
                                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- RT & RW -->
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">RT <span class="text-danger">*</span></label>
                                                <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror"
                                                       value="{{ old('rt') }}" maxlength="3" required>
                                                @error('rt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">RW <span class="text-danger">*</span></label>
                                                <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror"
                                                       value="{{ old('rw') }}" maxlength="3" required>
                                                @error('rw')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Jam Buka -->
                                    <div class="mb-3">
                                        <label class="form-label">Jam Buka <span class="text-danger">*</span></label>
                                        <input type="time" name="jam_buka" class="form-control @error('jam_buka') is-invalid @enderror"
                                               value="{{ old('jam_buka') }}" required>
                                        @error('jam_buka')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <!-- Tiket -->
                                    <div class="mb-3">
                                        <label class="form-label">Harga Tiket (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" name="tiket" class="form-control @error('tiket') is-invalid @enderror"
                                               value="{{ old('tiket') }}" min="0" step="0.01" required>
                                        @error('tiket')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <!-- Kontak -->
                                    <div class="mb-3">
                                        <label class="form-label">Kontak <span class="text-danger">*</span></label>
                                        <input type="text" name="kontak" class="form-control @error('kontak') is-invalid @enderror"
                                               value="{{ old('kontak') }}" maxlength="20" required>
                                        @error('kontak')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('destinasiwisata.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
