@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

        {{-- ====================== START MAIN CONTENT ====================== --}}

        <!-- Header -->
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-pencil text-info mr-2"></i>
                Edit Destinasi Wisata
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('destinasiwisata.index') }}">Destinasi Wisata</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
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

        <!-- Error List di Atas Form -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle-outline mr-2"></i>
                <strong>Terjadi kesalahan!</strong> Silakan perbaiki data berikut:
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <!-- Form Edit Data -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title mb-0">Form Edit Destinasi Wisata</h4>
                            <a href="{{ route('destinasiwisata.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="mdi mdi-arrow-left mr-1"></i>Kembali ke Destinasi Wisata
                            </a>
                        </div>

                        <form action="{{ route('destinasiwisata.update', $destinasi->destinasi_id) }}" method="POST" id="destinasiForm">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <!-- Nama Destinasi -->
                                    <div class="form-group">
                                        <label for="nama" class="form-label">Nama Destinasi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama', $destinasi->nama) }}"
                                            placeholder="Masukkan nama destinasi">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Deskripsi -->
                                    <div class="form-group">
                                        <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                            rows="4" placeholder="Masukkan deskripsi destinasi">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Alamat -->
                                    <div class="form-group">
                                        <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                            placeholder="Masukkan alamat lengkap">{{ old('alamat', $destinasi->alamat) }}</textarea>
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
                                            <div class="form-group">
                                                <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                                    id="rt" name="rt" value="{{ old('rt', $destinasi->rt) }}"
                                                    placeholder="001" maxlength="3">
                                                @error('rt')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                                    id="rw" name="rw" value="{{ old('rw', $destinasi->rw) }}"
                                                    placeholder="002" maxlength="3">
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
                                            id="jam_buka" name="jam_buka" value="{{ old('jam_buka', $destinasi->jam_buka) }}">
                                        @error('jam_buka')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tiket -->
                                    <div class="form-group">
                                        <label for="tiket" class="form-label">Harga Tiket (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('tiket') is-invalid @enderror"
                                            id="tiket" name="tiket" value="{{ old('tiket', $destinasi->tiket) }}"
                                            placeholder="Masukkan harga tiket" min="0" step="1000">
                                        @error('tiket')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Kontak -->
                                    <div class="form-group">
                                        <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                            id="kontak" name="kontak" value="{{ old('kontak', $destinasi->kontak) }}"
                                            placeholder="Masukkan nomor kontak" maxlength="15">
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
                                            <i class="mdi mdi-arrow-left mr-1"></i>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save mr-1"></i>Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- File Pendukung -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="mdi mdi-camera mr-2"></i>Foto Destinasi</h5>
                    </div>
                    <div class="card-body">
                        <!-- Form Upload -->
                        <form action="{{ route('destinasiwisata.upload-files', $destinasi->destinasi_id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                            @csrf

                            <div class="mb-3">
                                <label for="foto_destinasi" class="form-label fw-bold">Upload Foto Tambahan</label>
                                <input type="file" class="form-control @error('foto_destinasi') is-invalid @enderror"
                                       id="foto_destinasi" name="foto_destinasi[]" multiple
                                       accept=".jpg,.jpeg,.png,.gif,.webp">
                                @error('foto_destinasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="mdi mdi-information mr-1"></i>
                                    Pilih multiple file (JPG, PNG, GIF, WEBP). Maksimal 5MB per file.
                                </div>
                            </div>

                            <!-- File Preview -->
                            <div id="file-preview" class="mb-3" style="display: none;">
                                <h6 class="text-muted">File Terpilih:</h6>
                                <div id="preview-list" class="list-group"></div>
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="mdi mdi-cloud-upload mr-1"></i> Upload Foto
                            </button>
                        </form>

                        <!-- Daftar File -->
                        <h6 class="border-bottom pb-2">
                            <i class="mdi mdi-image-multiple mr-2"></i>Foto Terupload
                            <span class="badge bg-primary">{{ count($files) }}</span>
                        </h6>

                        @if(count($files) > 0)
                            <div class="row">
                                @foreach($files as $file)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                          <img src="{{ asset('storage/destinasi_wisata/' . $file->file_name) }}"
                                                 class="card-img-top"
                                                 style="height: 150px; object-fit: cover;"
                                                 alt="Foto Destinasi">
                                            <div class="card-body p-2">
                                                <div class="d-flex justify-content-between">
                                                    <small class="text-truncate">{{ $file->file_name }}</small>
                                                    <form action="{{ route('destinasiwisata.delete-file', [$destinasi->destinasi_id, $file->media_id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Hapus foto ini?')"
                                                                data-toggle="tooltip" title="Hapus Foto">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="mdi mdi-image-off fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada foto yang diupload.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ====================== END MAIN CONTENT ====================== --}}
    </div>
</div>

{{-- ====================== START JS TAMBAHAN ====================== --}}
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

    // ============ PREVIEW FILE UPLOAD ============
    document.getElementById('foto_destinasi').addEventListener('change', function(e) {
        const preview = document.getElementById('file-preview');
        const previewList = document.getElementById('preview-list');
        const files = e.target.files;

        previewList.innerHTML = '';

        if (files.length > 0) {
            preview.style.display = 'block';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const listItem = document.createElement('div');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';

                let icon = 'mdi mdi-file';
                let iconColor = 'text-secondary';

                if (file.type.startsWith('image/')) {
                    icon = 'mdi mdi-image';
                    iconColor = 'text-primary';
                }

                listItem.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="${icon} ${iconColor} me-2"></i>
                        <span class="small">${file.name}</span>
                    </div>
                    <small class="text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                `;

                previewList.appendChild(listItem);
            }
        } else {
            preview.style.display = 'none';
        }
    });

    // Auto dismiss alerts setelah 5 detik
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
</script>
{{-- ====================== END JS TAMBAHAN ====================== --}}
@endsection
