@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

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

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle-outline mr-2"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Error List -->
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

        <!-- Card Form Tambah Destinasi Wisata -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Form Tambah Destinasi Wisata</h4>
                    <a href="{{ route('destinasiwisata.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="mdi mdi-arrow-left mr-1"></i>Kembali ke Destinasi Wisata
                    </a>
                </div>

                <form action="{{ route('destinasiwisata.store') }}" method="POST" id="destinasiForm" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <!-- Nama Destinasi -->
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Destinasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                       id="nama" name="nama" value="{{ old('nama') }}"
                                       placeholder="Masukkan nama destinasi wisata">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group">
                                <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                          id="deskripsi" name="deskripsi" rows="3"
                                          placeholder="Masukkan deskripsi destinasi">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror"
                                          id="alamat" name="alamat" rows="2"
                                          placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <!-- RT & RW -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                               id="rt" name="rt" value="{{ old('rt') }}"
                                               placeholder="Contoh: 001" maxlength="3">
                                        @error('rt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                               id="rw" name="rw" value="{{ old('rw') }}"
                                               placeholder="Contoh: 002" maxlength="3">
                                        @error('rw')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Jam Buka -->
                            <div class="form-group">
                                <label for="jam_buka" class="form-label">Jam Buka <span class="text-danger">*</span></label>
                                <input type="time" class="form-control @error('jam_buka') is-invalid @enderror"
                                       id="jam_buka" name="jam_buka" value="{{ old('jam_buka') }}">
                                @error('jam_buka')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Harga Tiket -->
                            <div class="form-group">
                                <label for="tiket" class="form-label">Harga Tiket (Rp) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('tiket') is-invalid @enderror"
                                       id="tiket" name="tiket" value="{{ old('tiket') }}"
                                       placeholder="Masukkan harga tiket" min="0" step="0.01">
                                @error('tiket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kontak -->
                            <div class="form-group">
                                <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                       id="kontak" name="kontak" value="{{ old('kontak') }}"
                                       placeholder="Masukkan nomor kontak" maxlength="15">
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Upload File -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="mdi mdi-camera mr-2"></i>Upload Foto Destinasi
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="foto_destinasi" class="form-label">
                                            Foto Destinasi (Multiple)
                                            <span class="text-muted">(Maksimal 5MB per file, format: jpeg, png, jpg, gif, webp)</span>
                                        </label>
                                        <input type="file"
                                               class="form-control-file @error('foto_destinasi.*') is-invalid @enderror"
                                               id="foto_destinasi"
                                               name="foto_destinasi[]"
                                               multiple
                                               accept="image/*">

                                        @error('foto_destinasi.*')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror

                                        <small class="form-text text-muted">
                                            Bisa memilih lebih dari satu foto. Foto akan ditampilkan sebagai galeri destinasi.
                                        </small>
                                    </div>

                                    <!-- Preview Area -->
                                    <div class="preview-area mt-3" id="previewArea" style="display: none;">
                                        <h6 class="mb-2">Preview Foto:</h6>
                                        <div class="row" id="imagePreview"></div>
                                    </div>
                                </div>
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
    </div>
</div>

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

    // Preview Image Upload
    document.getElementById('foto_destinasi').addEventListener('change', function(e) {
        const previewArea = document.getElementById('previewArea');
        const imagePreview = document.getElementById('imagePreview');
        const files = e.target.files;

        imagePreview.innerHTML = '';

        if (files.length > 0) {
            previewArea.style.display = 'block';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const colDiv = document.createElement('div');
                    colDiv.className = 'col-md-3 mb-3';

                    colDiv.innerHTML = `
                        <div class="card">
                            <img src="${e.target.result}" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body p-2">
                                <p class="card-text small text-truncate mb-0">${file.name}</p>
                                <p class="card-text small text-muted mb-0">${(file.size / 1024).toFixed(2)} KB</p>
                            </div>
                        </div>
                    `;

                    imagePreview.appendChild(colDiv);
                }

                reader.readAsDataURL(file);
            }
        } else {
            previewArea.style.display = 'none';
        }
    });

    // Auto dismiss alerts setelah 5 detik
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
</script>
@endsection
