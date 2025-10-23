<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destinasi Wisata - Sistem Administrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            background-color: #2c3e50;
            min-height: 100vh;
            color: white;
        }
        .sidebar .nav-link {
            color: white;
        }
        .sidebar .nav-link:hover {
            background-color: #34495e;
        }
        .sidebar .nav-link.active {
            background-color: #28a745;
        }
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-3">
                    <h4 class="text-white">Sistem Administrasi</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('warga.index') }}">
                            <i class="fas fa-users me-2"></i> Data Warga
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('destinasiwisata.index') }}">
                            <i class="fas fa-map-marker-alt me-2"></i> Destinasi Wisata
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-4 py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2>Edit Destinasi Wisata</h2>
                        <p class="mb-0 text-muted">Form untuk mengedit data destinasi wisata</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i>Admin
                        </button>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('destinasiwisata.index') }}">Destinasi Wisata</a></li>
                        <li class="breadcrumb-item active">Edit Data</li>
                    </ol>
                </nav>

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

                <!-- Form Edit Destinasi -->
                <div class="card form-container">
                    <div class="card-body">
                        <form action="{{ route('destinasiwisata.update', $dataDestinasi->destinasi_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <!-- Nama Destinasi -->
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Destinasi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                               id="nama" name="nama" value="{{ old('nama', $dataDestinasi->nama) }}"
                                               placeholder="Masukkan nama destinasi" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Deskripsi -->
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                                  id="deskripsi" name="deskripsi" rows="4"
                                                  placeholder="Masukkan deskripsi destinasi" required>{{ old('deskripsi', $dataDestinasi->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Alamat -->
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror"
                                                  id="alamat" name="alamat" rows="3"
                                                  placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $dataDestinasi->alamat) }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <!-- RT/RW -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="rt" class="form-label">RT</label>
                                                <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                                       id="rt" name="rt" value="{{ old('rt', $dataDestinasi->rt) }}"
                                                       placeholder="001" maxlength="3">
                                                @error('rt')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="rw" class="form-label">RW</label>
                                                <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                                       id="rw" name="rw" value="{{ old('rw', $dataDestinasi->rw) }}"
                                                       placeholder="002" maxlength="3">
                                                @error('rw')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Jam Buka -->
                                    <div class="mb-3">
                                        <label for="jam_buka" class="form-label">Jam Buka <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control @error('jam_buka') is-invalid @enderror"
                                               id="jam_buka" name="jam_buka" value="{{ old('jam_buka', $dataDestinasi->jam_buka) }}" required>
                                        @error('jam_buka')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tiket -->
                                    <div class="mb-3">
                                        <label for="tiket" class="form-label">Harga Tiket (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('tiket') is-invalid @enderror"
                                               id="tiket" name="tiket" value="{{ old('tiket', $dataDestinasi->tiket) }}"
                                               placeholder="Masukkan harga tiket" min="0" step="1000" required>
                                        @error('tiket')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Kontak -->
                                    <div class="mb-3">
                                        <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                               id="kontak" name="kontak" value="{{ old('kontak', $dataDestinasi->kontak) }}"
                                               placeholder="Masukkan nomor kontak" required maxlength="20">
                                        @error('kontak')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('destinasiwisata.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-arrow-left me-1"></i>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save me-1"></i>Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
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
