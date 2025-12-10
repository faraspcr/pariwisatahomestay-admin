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
                <div class="card card-edit">
                    <div class="card-header bg-info text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="mdi mdi-pencil-box mr-2"></i>Form Edit Destinasi Wisata</h5>
                            <a href="{{ route('destinasiwisata.index') }}" class="btn btn-light btn-sm">
                                <i class="mdi mdi-arrow-left mr-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('destinasiwisata.update', $destinasi->destinasi_id) }}" method="POST" id="destinasiForm">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <!-- Nama Destinasi -->
                                    <div class="form-group">
                                        <label for="nama" class="form-label">
                                            <i class="mdi mdi-map-marker text-primary mr-1"></i>
                                            Nama Destinasi <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama', $destinasi->nama) }}"
                                            placeholder="Masukkan nama destinasi">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Deskripsi -->
                                    <div class="form-group">
                                        <label for="deskripsi" class="form-label">
                                            <i class="mdi mdi-text-box text-primary mr-1"></i>
                                            Deskripsi <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control form-control-sm @error('deskripsi') is-invalid @enderror"
                                            id="deskripsi" name="deskripsi" rows="4"
                                            placeholder="Masukkan deskripsi destinasi">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Minimal 10 karakter</small>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="form-group">
                                        <label for="alamat" class="form-label">
                                            <i class="mdi mdi-home-map-marker text-primary mr-1"></i>
                                            Alamat Lengkap <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control form-control-sm @error('alamat') is-invalid @enderror"
                                            id="alamat" name="alamat" rows="3"
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
                                                <label for="rt" class="form-label">
                                                    <i class="mdi mdi-numeric-1-box text-primary mr-1"></i>
                                                    RT <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm @error('rt') is-invalid @enderror"
                                                    id="rt" name="rt" value="{{ old('rt', $destinasi->rt) }}"
                                                    placeholder="001" maxlength="3">
                                                @error('rt')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="rw" class="form-label">
                                                    <i class="mdi mdi-numeric-2-box text-primary mr-1"></i>
                                                    RW <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control form-control-sm @error('rw') is-invalid @enderror"
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
                                        <label for="jam_buka" class="form-label">
                                            <i class="mdi mdi-clock-outline text-primary mr-1"></i>
                                            Jam Buka <span class="text-danger">*</span>
                                        </label>
                                        <input type="time" class="form-control form-control-sm @error('jam_buka') is-invalid @enderror"
                                            id="jam_buka" name="jam_buka" value="{{ old('jam_buka', $destinasi->jam_buka) }}">
                                        @error('jam_buka')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tiket -->
                                    <div class="form-group">
                                        <label for="tiket" class="form-label">
                                            <i class="mdi mdi-ticket text-primary mr-1"></i>
                                            Harga Tiket (Rp) <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control @error('tiket') is-invalid @enderror"
                                                id="tiket" name="tiket" value="{{ old('tiket', $destinasi->tiket) }}"
                                                placeholder="Masukkan harga tiket" min="0" step="100">
                                        </div>
                                        @error('tiket')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Kontak -->
                                    <div class="form-group">
                                        <label for="kontak" class="form-label">
                                            <i class="mdi mdi-phone text-primary mr-1"></i>
                                            Kontak <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control form-control-sm @error('kontak') is-invalid @enderror"
                                            id="kontak" name="kontak" value="{{ old('kontak', $destinasi->kontak) }}"
                                            placeholder="Masukkan nomor kontak" maxlength="15">
                                        @error('kontak')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="row mt-4 pt-3 border-top">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="confirmEdit">
                                            <label class="form-check-label text-muted" for="confirmEdit">
                                                Saya yakin data yang diubah sudah benar
                                            </label>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('destinasiwisata.index') }}" class="btn btn-outline-secondary btn-sm">
                                                <i class="mdi mdi-close mr-1"></i>Batal
                                            </a>
                                            <button type="submit" class="btn btn-primary btn-sm" id="submitBtn" disabled>
                                                <i class="mdi mdi-content-save mr-1"></i>Simpan Perubahan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- File Pendukung -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow card-gallery">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="mdi mdi-camera mr-2"></i>Galeri Foto Destinasi</h5>
                        <span class="badge bg-light text-dark">{{ count($files) }} File</span>
                    </div>
                    <div class="card-body">
                        @if(count($files) > 0)
                            <!-- Gallery Navigation -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="gallery-nav">
                                        <button class="btn btn-sm btn-outline-primary" onclick="showAllPhotos()">
                                            <i class="mdi mdi-view-grid"></i> Semua File
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="downloadAll()">
                                            <i class="mdi mdi-download"></i> Download Semua
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Main Photo Preview - DIPERBESAR -->
                            <div class="main-photo-container mb-4">
                                <div class="main-photo-wrapper">
                                    @php
                                        $firstFile = $files[0];
                                        $isImage = str_contains($firstFile->mime_type, 'image');
                                        $isPDF = str_contains($firstFile->mime_type, 'pdf');
                                        $isDocument = str_contains($firstFile->mime_type, 'word') || str_contains($firstFile->mime_type, 'document') ||
                                                      str_contains($firstFile->mime_type, 'excel') || str_contains($firstFile->mime_type, 'sheet') ||
                                                      str_contains($firstFile->mime_type, 'text');
                                        $imageUrl = $isImage ? asset('storage/' . $firstFile->file_name) : '#';
                                        $previewUrl = route('destinasiwisata.show-file', [$destinasi->destinasi_id, $firstFile->media_id]);
                                        $fileNameDisplay = basename($firstFile->file_name);
                                    @endphp

                                    @if($isImage)
                                        <!-- Gambar - DIPERBESAR -->
                                        <img src="{{ asset('storage/' . $firstFile->file_name) }}"
                                             id="currentMainPhoto"
                                             class="main-photo"
                                             alt="Foto Utama"
                                             onerror="handleImageError(this, '{{ $firstFile->file_name }}')">
                                    @elseif($isPDF)
                                        <!-- PDF Preview -->
                                        <div class="pdf-preview-container text-center py-4" id="pdfPreviewContainer">
                                            <i class="mdi mdi-file-pdf-box text-danger" style="font-size: 100px;"></i>
                                            <h5 class="mt-3">{{ $fileNameDisplay }}</h5>
                                            <p class="text-muted">PDF Document</p>
                                            <div class="mt-4">
                                                <a href="{{ $previewUrl }}"
                                                   class="btn btn-primary btn-sm"
                                                   target="_blank"
                                                   data-toggle="tooltip"
                                                   title="Buka PDF">
                                                    <i class="mdi mdi-eye mr-1"></i> Lihat PDF
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Dokumen lain -->
                                        <div class="document-preview text-center py-4">
                                            @if(str_contains($firstFile->mime_type, 'word') || str_contains($firstFile->mime_type, 'document'))
                                                <i class="mdi mdi-file-word-box text-primary" style="font-size: 100px;"></i>
                                            @elseif(str_contains($firstFile->mime_type, 'excel') || str_contains($firstFile->mime_type, 'sheet'))
                                                <i class="mdi mdi-file-excel-box text-success" style="font-size: 100px;"></i>
                                            @elseif(str_contains($firstFile->mime_type, 'text'))
                                                <i class="mdi mdi-file-document-box text-info" style="font-size: 100px;"></i>
                                            @else
                                                <i class="mdi mdi-file-document-box text-secondary" style="font-size: 100px;"></i>
                                            @endif
                                            <h5 class="mt-3">{{ $fileNameDisplay }}</h5>
                                            <p class="text-muted">{{ $firstFile->mime_type }}</p>
                                        </div>
                                    @endif
                                    <div class="photo-overlay">
                                        @if($isImage)
                                            <button class="btn btn-light btn-sm" onclick="downloadCurrentPhoto()"
                                                    data-toggle="tooltip" title="Download">
                                                <i class="mdi mdi-download"></i>
                                            </button>
                                            <button class="btn btn-light btn-sm" onclick="openFullscreenImage()"
                                                    data-toggle="tooltip" title="Fullscreen">
                                                <i class="mdi mdi-fullscreen"></i>
                                            </button>
                                        @elseif($isPDF)
                                            <a href="{{ route('destinasiwisata.download-file', [$destinasi->destinasi_id, $firstFile->media_id]) }}"
                                               class="btn btn-light btn-sm"
                                               target="_blank"
                                               data-toggle="tooltip" title="Download PDF">
                                                <i class="mdi mdi-download"></i>
                                            </a>
                                            <a href="{{ $previewUrl }}"
                                               class="btn btn-light btn-sm"
                                               target="_blank"
                                               data-toggle="tooltip" title="Buka PDF">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('destinasiwisata.download-file', [$destinasi->destinasi_id, $firstFile->media_id]) }}"
                                               class="btn btn-light btn-sm"
                                               target="_blank"
                                               data-toggle="tooltip" title="Download">
                                                <i class="mdi mdi-download"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="photo-info text-center mt-2">
                                    <small id="currentPhotoName" class="text-truncate d-block">{{ $fileNameDisplay }}</small>
                                    <div class="photo-controls mt-2">
                                        <span class="badge bg-primary" id="photoCounter">1 / {{ count($files) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Thumbnail Gallery -->
                            <h6 class="border-bottom pb-2 mb-3">
                                <i class="mdi mdi-image-multiple mr-2"></i>Daftar File
                            </h6>

                            <div class="row g-2" id="thumbnailGallery">
                                @foreach($files as $index => $file)
                                    @php
                                        $isImage = str_contains($file->mime_type, 'image');
                                        $isPDF = str_contains($file->mime_type, 'pdf');
                                        $fileIcon = 'mdi-file-document-box';
                                        $fileColor = 'text-secondary';
                                        $fileNameDisplay = basename($file->file_name);
                                        $previewUrl = route('destinasiwisata.show-file', [$destinasi->destinasi_id, $file->media_id]);

                                        if($isPDF) {
                                            $fileIcon = 'mdi-file-pdf-box';
                                            $fileColor = 'text-danger';
                                        } elseif(str_contains($file->mime_type, 'word') || str_contains($file->mime_type, 'document')) {
                                            $fileIcon = 'mdi-file-word-box';
                                            $fileColor = 'text-primary';
                                        } elseif(str_contains($file->mime_type, 'excel') || str_contains($file->mime_type, 'sheet')) {
                                            $fileIcon = 'mdi-file-excel-box';
                                            $fileColor = 'text-success';
                                        } elseif($isImage) {
                                            $fileIcon = 'mdi-image';
                                            $fileColor = 'text-info';
                                        }
                                    @endphp

                                    <div class="col-md-3 col-4">
                                        <div class="thumbnail-card {{ $index === 0 ? 'active' : '' }}"
                                             onclick="changeMainPhoto('{{ $file->file_name }}', {{ $index }}, '{{ $file->mime_type }}', '{{ $file->media_id }}', '{{ $fileNameDisplay }}')"
                                             data-index="{{ $index }}"
                                             data-id="{{ $file->media_id }}"
                                             data-type="{{ $file->mime_type }}"
                                             data-filename="{{ $fileNameDisplay }}"
                                             data-preview-url="{{ $isPDF ? $previewUrl : '#' }}">

                                            @if($isImage)
                                                <img src="{{ asset('storage/' . $file->file_name) }}"
                                                     class="thumbnail-img"
                                                     alt="Thumbnail {{ $index + 1 }}"
                                                     onerror="handleThumbnailError(this, '{{ $fileNameDisplay }}')">
                                            @else
                                                <div class="file-thumbnail text-center py-3">
                                                    <i class="mdi {{ $fileIcon }} {{ $fileColor }}" style="font-size: 40px;"></i>
                                                    <small class="d-block text-truncate mt-1">{{ pathinfo($file->file_name, PATHINFO_EXTENSION) }}</small>
                                                </div>
                                            @endif

                                            <div class="thumbnail-overlay">
                                                <form action="{{ route('destinasiwisata.delete-file', [$destinasi->destinasi_id, $file->media_id]) }}"
                                                      method="POST"
                                                      class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger btn-sm delete-thumbnail"
                                                            onclick="return confirmDelete(event, '{{ $fileNameDisplay }}')"
                                                            data-toggle="tooltip"
                                                            title="Hapus File">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('destinasiwisata.download-file', [$destinasi->destinasi_id, $file->media_id]) }}"
                                                   class="btn btn-info btn-sm download-thumbnail"
                                                   target="_blank"
                                                   data-toggle="tooltip"
                                                   title="Download File">
                                                    <i class="mdi mdi-download"></i>
                                                </a>
                                                @if($isPDF)
                                                <a href="{{ $previewUrl }}"
                                                   class="btn btn-warning btn-sm view-thumbnail"
                                                   target="_blank"
                                                   data-toggle="tooltip"
                                                   title="Lihat PDF">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                                @endif
                                                <span class="badge badge-order">{{ $index + 1 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5 empty-gallery">
                                <i class="mdi mdi-image-off fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada file yang diupload</h5>
                                <p class="text-muted">Upload file untuk menampilkan galeri destinasi</p>
                            </div>
                        @endif

                        <!-- Upload Form -->
                        <div class="upload-section mt-4 pt-4 border-top">
                            <h6 class="mb-3">
                                <i class="mdi mdi-cloud-upload text-primary mr-2"></i>
                                Upload File Baru
                            </h6>
                            <form action="{{ route('destinasiwisata.upload-files', $destinasi->destinasi_id) }}"
                                  method="POST"
                                  enctype="multipart/form-data"
                                  id="uploadForm">
                                @csrf
                                <div class="mb-3">
                                    <div class="custom-file-upload">
                                        <input type="file"
                                               class="form-control @error('foto_destinasi') is-invalid @enderror"
                                               id="foto_destinasi"
                                               name="foto_destinasi[]"
                                               multiple
                                               accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.xls,.xlsx,.txt,.csv"
                                               onchange="previewUploadFiles(this)">
                                        <label for="foto_destinasi" class="upload-label">
                                            <i class="mdi mdi-cloud-upload mr-2"></i>
                                            <span>Pilih File (Multiple)</span>
                                        </label>
                                    </div>
                                    @error('foto_destinasi')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        <i class="mdi mdi-information mr-1"></i>
                                        Pilih multiple file (JPG, PNG, GIF, WEBP, PDF, DOC, DOCX, XLS, XLSX, TXT, CSV). Maksimal 5MB per file.
                                    </small>
                                </div>

                                <!-- Upload Preview -->
                                <div id="uploadPreview" class="mb-3" style="display: none;">
                                    <h6 class="text-muted mb-2">Preview File yang akan diupload:</h6>
                                    <div id="previewContainer" class="row g-2"></div>
                                    <div class="mt-2 text-end">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearPreview()">
                                            <i class="mdi mdi-trash-can mr-1"></i> Clear Preview
                                        </button>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success w-100 upload-btn" id="uploadBtn">
                                    <i class="mdi mdi-cloud-upload mr-1"></i> Upload File
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ====================== END MAIN CONTENT ====================== --}}
    </div>
</div>

{{-- ====================== MODAL FULLSCREEN GAMBAR ====================== --}}
<div class="modal fade" id="imageFullscreenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h6 class="modal-title text-white" id="imageFullscreenTitle"></h6>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 d-flex align-items-center justify-content-center" style="min-height: 80vh;">
                <div class="image-container" style="width: 100%; height: 100%;">
                    <img id="fullscreenImage" src=""
                         class="img-fluid"
                         style="max-width: 100%; max-height: 80vh; width: auto; height: auto; display: block; margin: 0 auto;"
                         onerror="handleFullscreenImageError(this)">
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button class="btn btn-light me-2" onclick="downloadFullscreenPhoto()" id="fullscreenDownloadBtn">
                    <i class="mdi mdi-download mr-1"></i> Download
                </button>
                <button class="btn btn-light" data-dismiss="modal">
                    <i class="mdi mdi-fullscreen-exit mr-1"></i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ====================== MODAL FULLSCREEN PDF ====================== --}}
<div class="modal fade" id="pdfFullscreenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h6 class="modal-title text-white" id="pdfFullscreenTitle"></h6>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="pdfFullscreenIframe" src=""
                        style="width: 100%; height: calc(100vh - 120px); border: none;"></iframe>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button class="btn btn-light me-2" onclick="downloadFullscreenPhoto()" id="pdfFullscreenDownloadBtn">
                    <i class="mdi mdi-download mr-1"></i> Download
                </button>
                <button class="btn btn-light me-2" onclick="openPDFInNewTab()">
                    <i class="mdi mdi-open-in-new mr-1"></i> Buka di Tab Baru
                </button>
                <button class="btn btn-light" data-dismiss="modal">
                    <i class="mdi mdi-fullscreen-exit mr-1"></i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ====================== START JS TAMBAHAN ====================== --}}
<script>
    // Variables
    let currentPhotoIndex = 0;
    let photos = @json($files);
    let currentFileName = photos.length > 0 ? photos[0].file_name : '';
    let currentFileType = photos.length > 0 ? photos[0].mime_type : '';
    let currentFileId = photos.length > 0 ? photos[0].media_id : '';
    let currentFileDisplayName = photos.length > 0 ? basename(photos[0].file_name) : '';
    let currentPDFPreviewUrl = '';
    const destinasiId = {{ $destinasi->destinasi_id }};
    const baseImagePath = '{{ asset("storage/") }}/';

    // Helper functions
    function basename(path) {
        return path.split('/').pop();
    }

    function getDownloadUrl(fileId) {
        return '{{ route("destinasiwisata.download-file", [$destinasi->destinasi_id, "FILE_ID"]) }}'.replace('FILE_ID', fileId);
    }

    function getPreviewUrl(fileId) {
        return '{{ route("destinasiwisata.show-file", [$destinasi->destinasi_id, "FILE_ID"]) }}'.replace('FILE_ID', fileId);
    }

    // Form Validation
    document.getElementById('confirmEdit').addEventListener('change', function() {
        document.getElementById('submitBtn').disabled = !this.checked;
    });

    // Auto format untuk input RT dan RW (hanya angka)
    document.getElementById('rt').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 3) {
            this.value = this.value.substring(0, 3);
        }
    });

    document.getElementById('rw').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 3) {
            this.value = this.value.substring(0, 3);
        }
    });

    // Auto format untuk input kontak (hanya angka dan +)
    document.getElementById('kontak').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9+]/g, '');
    });

    // Format harga tiket saat input
    document.getElementById('tiket').addEventListener('input', function(e) {
        let value = this.value.replace(/[^0-9]/g, '');
        if (value) {
            this.value = parseInt(value).toLocaleString('id-ID');
        }
    });

    // Format harga tiket saat focus out
    document.getElementById('tiket').addEventListener('blur', function(e) {
        let value = this.value.replace(/[^0-9]/g, '');
        if (value) {
            this.value = parseInt(value).toLocaleString('id-ID');
        }
    });

    // Format harga tiket saat focus in
    document.getElementById('tiket').addEventListener('focus', function(e) {
        let value = this.value.replace(/[^0-9]/g, '');
        if (value) {
            this.value = value;
        }
    });

    // ============ FUNGSI HANDLE ERROR GAMBAR ============
    function handleImageError(img, fileName) {
        console.error('Gagal memuat gambar:', fileName);

        // Coba load dengan URL yang benar
        const correctPath = 'storage/' + fileName;
        const correctUrl = "{{ asset('') }}" + correctPath;

        // Coba load lagi dengan teknik cache busting
        const timestamp = new Date().getTime();
        const retryUrl = correctUrl + '?t=' + timestamp;

        // Coba load dengan URL baru
        img.src = retryUrl;

        // Jika masih error, tampilkan placeholder
        img.onerror = function() {
            // Tampilkan placeholder yang lebih baik
            const svg = `
                <svg xmlns="http://www.w3.org/2000/svg" width="800" height="500" viewBox="0 0 800 500">
                    <rect width="800" height="500" fill="#f8f9fa"/>
                    <circle cx="400" cy="200" r="60" fill="#dee2e6"/>
                    <path d="M370 180 L430 180 L430 220 L370 220 Z" fill="#adb5bd" opacity="0.5"/>
                    <text x="400" y="320" font-family="Arial" font-size="20" fill="#6c757d" text-anchor="middle">
                        File: ${fileName.split('/').pop()}
                    </text>
                    <text x="400" y="350" font-family="Arial" font-size="16" fill="#adb5bd" text-anchor="middle">
                        Pastikan file ada di storage
                    </text>
                </svg>`;

            img.src = 'data:image/svg+xml;utf8,' + encodeURIComponent(svg);
            img.style.cursor = 'default';

            // Tampilkan pesan toast
            showToast('error', `Gagal memuat: ${fileName.split('/').pop()}`);
        };
    }

    function handleThumbnailError(img, fileName) {
        console.error('Gagal memuat thumbnail:', fileName);

        const svg = `
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
                <rect width="100" height="100" fill="#f8f9fa"/>
                <circle cx="50" cy="40" r="20" fill="#dee2e6"/>
                <path d="M40 30 L60 30 L60 50 L40 50 Z" fill="#adb5bd" opacity="0.5"/>
                <text x="50" y="80" font-family="Arial" font-size="8" fill="#6c757d" text-anchor="middle">
                    Error
                </text>
            </svg>`;

        img.src = 'data:image/svg+xml;utf8,' + encodeURIComponent(svg);
    }

    function handleFullscreenImageError(img) {
        console.error('Gagal memuat gambar fullscreen');

        const svg = `
            <svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
                <rect width="800" height="600" fill="#1a1a1a"/>
                <circle cx="400" cy="250" r="80" fill="#343a40"/>
                <path d="M370 230 L430 230 L430 270 L370 270 Z" fill="#495057" opacity="0.5"/>
                <text x="400" y="380" font-family="Arial" font-size="24" fill="#dee2e6" text-anchor="middle">
                    Gambar tidak dapat ditampilkan
                </text>
                <text x="400" y="420" font-family="Arial" font-size="16" fill="#adb5bd" text-anchor="middle">
                    Periksa koneksi atau path file
                </text>
            </svg>`;

        img.src = 'data:image/svg+xml;utf8,' + encodeURIComponent(svg);
    }

    // ============ GALLERY FUNCTIONS ============
    function changeMainPhoto(fileName, index, mimeType, fileId, displayName) {
        currentPhotoIndex = index;
        currentFileName = fileName;
        currentFileType = mimeType;
        currentFileId = fileId;
        currentFileDisplayName = displayName || fileName.split('/').pop();

        const isImage = mimeType.includes('image');
        const isPDF = mimeType.includes('pdf');
        const isDocument = mimeType.includes('word') || mimeType.includes('document') ||
                          mimeType.includes('excel') || mimeType.includes('sheet') ||
                          mimeType.includes('text');

        // Update main photo
        const mainPhoto = document.getElementById('currentMainPhoto');
        const pdfPreviewContainer = document.querySelector('.pdf-preview-container');
        const docPreview = document.querySelector('.document-preview');
        const photoName = document.getElementById('currentPhotoName');
        const photoCounter = document.getElementById('photoCounter');

        // Hide semua preview terlebih dahulu
        mainPhoto.style.display = 'none';
        if (pdfPreviewContainer) pdfPreviewContainer.style.display = 'none';
        if (docPreview) docPreview.style.display = 'none';

        // Tampilkan preview sesuai jenis file
        if (isImage) {
            // Tampilkan gambar
            const timestamp = new Date().getTime();
            const fullPath = 'storage/' + fileName;
            mainPhoto.src = "{{ asset('') }}" + fullPath + '?t=' + timestamp;
            mainPhoto.style.display = 'block';

            // Update juga untuk fullscreen modal
            document.getElementById('fullscreenImage').src = "{{ asset('') }}" + fullPath + '?t=' + timestamp;
            document.getElementById('imageFullscreenTitle').textContent = currentFileDisplayName;
            currentPDFPreviewUrl = '';
        } else if (isPDF) {
            // Tampilkan preview PDF
            currentPDFPreviewUrl = getPreviewUrl(fileId);

            // Update container PDF
            const pdfContainer = document.querySelector('.pdf-preview-container') || createPDFPreview();
            pdfContainer.style.display = 'block';

            // Update fullscreen untuk PDF
            document.getElementById('pdfFullscreenTitle').textContent = currentFileDisplayName + ' (PDF)';
        } else {
            // Tampilkan preview dokumen lain
            let icon = 'mdi-file-document-box';
            let color = 'text-secondary';

            if (mimeType.includes('word') || mimeType.includes('document')) {
                icon = 'mdi-file-word-box';
                color = 'text-primary';
            } else if (mimeType.includes('excel') || mimeType.includes('sheet')) {
                icon = 'mdi-file-excel-box';
                color = 'text-success';
            } else if (mimeType.includes('text')) {
                icon = 'mdi-file-document-box';
                color = 'text-info';
            }

            const newDocPreview = document.createElement('div');
            newDocPreview.className = 'document-preview text-center py-4';
            newDocPreview.innerHTML = `
                <i class="mdi ${icon} ${color}" style="font-size: 100px;"></i>
                <h5 class="mt-3">${currentFileDisplayName}</h5>
                <p class="text-muted">${mimeType}</p>
            `;

            const mainPhotoWrapper = document.querySelector('.main-photo-wrapper');
            const existingDocPreview = mainPhotoWrapper.querySelector('.document-preview');
            if (existingDocPreview) {
                existingDocPreview.remove();
            }
            mainPhotoWrapper.insertBefore(newDocPreview, mainPhotoWrapper.firstChild);
            currentPDFPreviewUrl = '';
        }

        photoName.textContent = currentFileDisplayName;
        photoCounter.textContent = `${index + 1} / ${photos.length}`;

        // Update active thumbnail
        document.querySelectorAll('.thumbnail-card').forEach(card => {
            card.classList.remove('active');
        });
        document.querySelector(`.thumbnail-card[data-index="${index}"]`).classList.add('active');
    }

    function createPDFPreview() {
        const mainPhotoWrapper = document.querySelector('.main-photo-wrapper');
        const pdfContainer = document.createElement('div');
        pdfContainer.className = 'pdf-preview-container text-center py-4';
        pdfContainer.id = 'pdfPreviewContainer';
        pdfContainer.innerHTML = `
            <i class="mdi mdi-file-pdf-box text-danger" style="font-size: 100px;"></i>
            <h5 class="mt-3">${currentFileDisplayName}</h5>
            <p class="text-muted">PDF Document</p>
            <div class="mt-4">
                <a href="${currentPDFPreviewUrl}"
                   class="btn btn-primary btn-sm"
                   target="_blank"
                   data-toggle="tooltip"
                   title="Buka PDF">
                    <i class="mdi mdi-eye mr-1"></i> Lihat PDF
                </a>
            </div>
        `;
        mainPhotoWrapper.insertBefore(pdfContainer, mainPhotoWrapper.firstChild);
        return pdfContainer;
    }

    // ============ DOWNLOAD FUNCTIONS ============
    function downloadCurrentPhoto() {
        if (currentFileId) {
            const downloadUrl = getDownloadUrl(currentFileId);
            console.log('Download current file:', downloadUrl);
            window.open(downloadUrl, '_blank');
        }
    }

    function downloadFullscreenPhoto() {
        if (currentFileId) {
            const downloadUrl = getDownloadUrl(currentFileId);
            console.log('Download fullscreen file:', downloadUrl);
            window.open(downloadUrl, '_blank');
        }
    }

    function downloadAll() {
        if (photos.length === 0) {
            showToast('warning', 'Tidak ada file untuk didownload');
            return;
        }

        showToast('info', `Memulai download ${photos.length} file...`);

        // Download semua file dengan delay
        photos.forEach((photo, index) => {
            setTimeout(() => {
                const downloadUrl = getDownloadUrl(photo.media_id);
                console.log(`Downloading ${index + 1}/${photos.length}:`, downloadUrl);

                // Buat link download secara dinamis
                const link = document.createElement('a');
                link.href = downloadUrl;
                link.target = '_blank';
                link.download = basename(photo.file_name);

                // Tambahkan ke body dan klik
                document.body.appendChild(link);
                link.click();

                // Hapus link setelah diklik
                setTimeout(() => {
                    document.body.removeChild(link);
                }, 100);

            }, index * 1500); // Jarak 1.5 detik antar download
        });

        // Tampilkan pesan selesai
        setTimeout(() => {
            showToast('success', 'Semua file telah ditambahkan ke antrian download');
        }, photos.length * 1500 + 1000);
    }

    // ============ FULLSCREEN FUNCTIONS ============
    function openFullscreenImage() {
        const isImage = currentFileType.includes('image');
        const isPDF = currentFileType.includes('pdf');

        if (isImage) {
            // Tampilkan gambar di modal fullscreen khusus gambar
            $('#imageFullscreenModal').modal('show');

            // Atur gambar agar benar-benar fullscreen
            const img = document.getElementById('fullscreenImage');
            img.style.maxWidth = '100%';
            img.style.maxHeight = '80vh';
            img.style.width = 'auto';
            img.style.height = 'auto';
            img.style.display = 'block';
            img.style.margin = '0 auto';

        } else if (isPDF) {
            // Tampilkan PDF di modal fullscreen khusus PDF
            const pdfIframe = document.getElementById('pdfFullscreenIframe');
            pdfIframe.src = currentPDFPreviewUrl;
            $('#pdfFullscreenModal').modal('show');
        } else {
            // Untuk dokumen lain, langsung download
            downloadCurrentPhoto();
        }
    }

    function openPDFInNewTab() {
        if (currentPDFPreviewUrl) {
            window.open(currentPDFPreviewUrl, '_blank');
        }
    }

    function showAllPhotos() {
        document.getElementById('thumbnailGallery').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    function confirmDelete(event, fileName) {
        if (!confirm(`Yakin ingin menghapus file ${fileName}?`)) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    // ============ UPLOAD PREVIEW FUNCTIONS ============
    function previewUploadFiles(input) {
        const previewContainer = document.getElementById('previewContainer');
        const uploadPreview = document.getElementById('uploadPreview');
        const uploadBtn = document.getElementById('uploadBtn');

        previewContainer.innerHTML = '';

        if (input.files.length > 0) {
            uploadPreview.style.display = 'block';
            uploadBtn.disabled = false;

            Array.from(input.files).forEach((file, index) => {
                // Check file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    showToast('error', `File ${file.name} melebihi 5MB`);
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-6 col-md-3';

                    if (file.type.startsWith('image/')) {
                        col.innerHTML = `
                            <div class="upload-preview-card">
                                <img src="${e.target.result}"
                                     class="upload-preview-img"
                                     alt="Preview ${index + 1}">
                                <div class="upload-preview-info">
                                    <small class="text-truncate d-block">${file.name}</small>
                                    <small class="text-muted">${(file.size / 1024).toFixed(1)} KB</small>
                                </div>
                            </div>
                        `;
                    } else if (file.type.includes('pdf')) {
                        col.innerHTML = `
                            <div class="upload-preview-card">
                                <div class="upload-preview-doc text-center py-3">
                                    <i class="mdi mdi-file-pdf-box text-danger" style="font-size: 40px;"></i>
                                </div>
                                <div class="upload-preview-info">
                                    <small class="text-truncate d-block">${file.name}</small>
                                    <small class="text-muted">PDF - ${(file.size / 1024).toFixed(1)} KB</small>
                                </div>
                            </div>
                        `;
                    } else {
                        let icon = 'mdi-file-document-box';
                        let color = 'text-secondary';

                        if (file.type.includes('word') || file.type.includes('document')) {
                            icon = 'mdi-file-word-box';
                            color = 'text-primary';
                        } else if (file.type.includes('excel') || file.type.includes('sheet')) {
                            icon = 'mdi-file-excel-box';
                            color = 'text-success';
                        }

                        col.innerHTML = `
                            <div class="upload-preview-card">
                                <div class="upload-preview-doc text-center py-3">
                                    <i class="mdi ${icon} ${color}" style="font-size: 40px;"></i>
                                </div>
                                <div class="upload-preview-info">
                                    <small class="text-truncate d-block">${file.name}</small>
                                    <small class="text-muted">${(file.size / 1024).toFixed(1)} KB</small>
                                </div>
                            </div>
                        `;
                    }

                    previewContainer.appendChild(col);
                };
                reader.readAsDataURL(file);
            });

            showToast('info', `Menampilkan preview ${input.files.length} file`);
        } else {
            uploadPreview.style.display = 'none';
            uploadBtn.disabled = true;
        }
    }

    function clearPreview() {
        const input = document.getElementById('foto_destinasi');
        input.value = '';
        previewUploadFiles(input);
    }

    // ============ TOAST NOTIFICATION ============
    function showToast(type, message) {
        // Hapus toast sebelumnya
        const existingToasts = document.querySelectorAll('.toast-notification');
        existingToasts.forEach(toast => toast.remove());

        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.innerHTML = `
            <div class="toast-content">
                <i class="mdi mdi-${type === 'success' ? 'check-circle' : type === 'error' ? 'alert-circle' : 'information'} mr-2"></i>
                <span>${message}</span>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
        `;

        document.body.appendChild(toast);

        // Auto remove after 3 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 3000);
    }

    // ============ FORM VALIDATION ============
    function validateForm() {
        const nama = document.getElementById('nama').value.trim();
        const deskripsi = document.getElementById('deskripsi').value.trim();
        const alamat = document.getElementById('alamat').value.trim();
        const rt = document.getElementById('rt').value.trim();
        const rw = document.getElementById('rw').value.trim();
        const jamBuka = document.getElementById('jam_buka').value;
        const tiket = document.getElementById('tiket').value.replace(/[^0-9]/g, '');
        const kontak = document.getElementById('kontak').value.trim();

        let isValid = true;
        let errorMessage = '';

        if (nama.length < 3) {
            isValid = false;
            errorMessage += 'Nama destinasi minimal 3 karakter\n';
        }

        if (deskripsi.length < 10) {
            isValid = false;
            errorMessage += 'Deskripsi minimal 10 karakter\n';
        }

        if (alamat.length < 10) {
            isValid = false;
            errorMessage += 'Alamat minimal 10 karakter\n';
        }

        if (rt.length !== 3) {
            isValid = false;
            errorMessage += 'RT harus 3 digit\n';
        }

        if (rw.length !== 3) {
            isValid = false;
            errorMessage += 'RW harus 3 digit\n';
        }

        if (!jamBuka) {
            isValid = false;
            errorMessage += 'Jam buka harus diisi\n';
        }

        if (!tiket || parseInt(tiket) < 0) {
            isValid = false;
            errorMessage += 'Harga tiket harus diisi dan minimal 0\n';
        }

        if (kontak.length < 10) {
            isValid = false;
            errorMessage += 'Kontak minimal 10 digit\n';
        }

        if (!isValid) {
            alert('Perbaiki kesalahan berikut:\n\n' + errorMessage);
            return false;
        }

        return true;
    }

    // ============ INITIALIZATION ============
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Auto dismiss alerts setelah 5 detik
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);

        // Add form validation
        document.getElementById('destinasiForm').addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                return false;
            }

            // Show loading
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-1"></i> Menyimpan...';
            submitBtn.disabled = true;

            return true;
        });

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl+S untuk save
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                document.getElementById('submitBtn').click();
            }

            // Esc untuk cancel
            if (e.key === 'Escape') {
                window.location.href = "{{ route('destinasiwisata.index') }}";
            }
        });

        // Format tiket on load
        const tiketInput = document.getElementById('tiket');
        if (tiketInput.value) {
            let value = tiketInput.value.replace(/[^0-9]/g, '');
            if (value) {
                tiketInput.value = parseInt(value).toLocaleString('id-ID');
            }
        }

        // Initialize fullscreen image
        if (photos.length > 0 && photos[0].mime_type.includes('image')) {
            const firstFile = photos[0];
            const timestamp = new Date().getTime();
            const fullPath = 'storage/' + firstFile.file_name;
            document.getElementById('fullscreenImage').src = "{{ asset('') }}" + fullPath + '?t=' + timestamp;
            document.getElementById('imageFullscreenTitle').textContent = basename(firstFile.file_name);
        }

        // Tambahkan console log untuk debugging
        console.log('Files loaded:', photos);
        console.log('Destinasi ID:', destinasiId);
    });
</script>

<style>
/* ==================== EDIT FORM STYLES ==================== */
.card-edit {
    border-radius: 15px;
    overflow: hidden;
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
}

.card-edit:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.card-edit .card-header {
    border-bottom: 3px solid rgba(255,255,255,0.2);
}

.card-edit .form-label {
    font-weight: 600;
    color: #495057;
    font-size: 0.9rem;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
}

.card-edit .form-control-sm {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 10px 12px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.card-edit .form-control-sm:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    transform: translateY(-1px);
}

.card-edit .form-control-sm.is-invalid {
    border-color: #e74a3b;
    background-image: none;
}

.card-edit .form-control-sm.is-invalid:focus {
    box-shadow: 0 0 0 0.2rem rgba(231, 74, 59, 0.25);
}

.card-edit .invalid-feedback {
    font-size: 0.8rem;
    margin-top: 4px;
}

.card-edit .input-group-sm .input-group-text {
    background-color: #f8f9fa;
    border-color: #ddd;
    font-weight: 600;
    color: #495057;
}

/* ==================== GALLERY STYLES ==================== */
.card-gallery {
    border-radius: 15px;
    overflow: hidden;
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.card-gallery .card-header {
    border-bottom: 3px solid rgba(255,255,255,0.2);
    padding: 15px 20px;
}

.gallery-nav {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.gallery-nav .btn {
    border-radius: 8px;
    padding: 8px 15px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    font-weight: 600;
}

.gallery-nav .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.gallery-nav .btn-outline-primary:hover {
    background-color: #4e73df;
    color: white;
}

.gallery-nav .btn-outline-info:hover {
    background-color: #17a2b8;
    color: white;
}

/* PERBAIKAN BESAR: Main photo container lebih besar */
.main-photo-container {
    position: relative;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 25px;
    border-radius: 15px;
    border: 2px solid #e0e0e0;
    margin-bottom: 25px;
}

.main-photo-wrapper {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    min-height: 500px;
    max-height: 600px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.main-photo-wrapper:hover {
    box-shadow: 0 12px 30px rgba(0,0,0,0.2);
}

/* PERBAIKAN BESAR: Main photo lebih besar */
.main-photo {
    max-width: 100%;
    max-height: 550px;
    width: auto;
    height: auto;
    object-fit: contain;
    transition: transform 0.5s ease;
    cursor: pointer;
}

.main-photo:hover {
    transform: scale(1.03);
}

/* Styling khusus untuk PDF Preview */
.pdf-preview-container {
    width: 100%;
    padding: 40px 30px;
    background: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.pdf-preview-container i {
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.pdf-preview-container:hover i {
    opacity: 1;
}

.pdf-preview-container h5 {
    font-weight: 600;
    color: #495057;
    margin-top: 15px !important;
}

.pdf-preview-container .btn {
    margin: 5px;
}

.document-preview {
    width: 100%;
    padding: 40px 30px;
    background: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.document-preview i {
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.document-preview:hover i {
    opacity: 1;
}

.document-preview h5 {
    font-weight: 600;
    color: #495057;
    margin-top: 15px !important;
}

.photo-overlay {
    position: absolute;
    top: 20px;
    right: 20px;
    display: flex;
    gap: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 10;
}

.main-photo-wrapper:hover .photo-overlay {
    opacity: 1;
}

.photo-overlay .btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    background: white;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.photo-overlay .btn:hover {
    transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.photo-overlay .btn-light:hover {
    background-color: #4e73df;
    color: white;
    border-color: #4e73df;
}

.photo-info {
    background: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-top: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
}

.photo-info #currentPhotoName {
    font-size: 1rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 10px;
}

.photo-controls .badge {
    font-size: 0.9rem;
    padding: 8px 15px;
    border-radius: 20px;
    background: linear-gradient(135deg, #4e73df, #224abe);
    font-weight: 600;
}

/* ==================== THUMBNAIL STYLES ==================== */
.thumbnail-card {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    height: 130px;
    border: 3px solid transparent;
    background: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.thumbnail-card.active {
    border-color: #4e73df;
    transform: scale(1.08);
    box-shadow: 0 8px 20px rgba(78, 115, 223, 0.4);
}

.thumbnail-card:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.thumbnail-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.thumbnail-card:hover .thumbnail-img {
    transform: scale(1.15);
}

.file-thumbnail {
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 15px;
}

.file-thumbnail i {
    opacity: 0.8;
    transition: transform 0.3s ease;
}

.thumbnail-card:hover .file-thumbnail i {
    transform: scale(1.2);
    opacity: 1;
}

.thumbnail-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.8));
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    opacity: 0;
    transition: opacity 0.3s ease;
    padding: 15px;
}

.thumbnail-card:hover .thumbnail-overlay {
    opacity: 1;
}

.delete-thumbnail, .download-thumbnail, .view-thumbnail {
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: none;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.delete-thumbnail:hover {
    background-color: #dc3545 !important;
    transform: scale(1.15);
    box-shadow: 0 4px 10px rgba(220, 53, 69, 0.4);
}

.download-thumbnail:hover {
    background-color: #17a2b8 !important;
    transform: scale(1.15);
    box-shadow: 0 4px 10px rgba(23, 162, 184, 0.4);
}

.view-thumbnail:hover {
    background-color: #ffc107 !important;
    transform: scale(1.15);
    box-shadow: 0 4px 10px rgba(255, 193, 7, 0.4);
}

.badge-order {
    position: absolute;
    top: 8px;
    left: 8px;
    background: rgba(0,0,0,0.8);
    color: white;
    font-size: 11px;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-weight: bold;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
}

/* ==================== FULLSCREEN MODAL STYLES ==================== */
/* Modal untuk Gambar */
#imageFullscreenModal .modal-dialog {
    max-width: 95%;
    margin: 10px auto;
}

#imageFullscreenModal .modal-body {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.9);
    min-height: 85vh;
    padding: 0;
}

#imageFullscreenModal .modal-content {
    background: transparent;
    border: none;
}

#fullscreenImage {
    max-width: 100%;
    max-height: 85vh;
    width: auto;
    height: auto;
    object-fit: contain;
    display: block;
    margin: 0 auto;
}

#imageFullscreenModal .modal-header {
    background: rgba(0, 0, 0, 0.7);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding: 15px 20px;
}

#imageFullscreenModal .modal-footer {
    background: rgba(0, 0, 0, 0.7);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding: 15px 20px;
}

/* Modal untuk PDF */
#pdfFullscreenModal .modal-content {
    background: rgba(0, 0, 0, 0.95);
}

#pdfFullscreenModal .modal-header {
    background: rgba(0, 0, 0, 0.8);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

#pdfFullscreenModal .modal-footer {
    background: rgba(0, 0, 0, 0.8);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

#pdfFullscreenIframe {
    background: white;
}

.modal-footer .btn-light {
    background: rgba(255, 255, 255, 0.9);
    border: none;
    font-weight: 600;
    padding: 10px 20px;
    transition: all 0.3s ease;
}

.modal-footer .btn-light:hover {
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
}

/* ==================== UPLOAD STYLES ==================== */
.upload-section {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    margin-top: 30px;
    border: 3px dashed #dee2e6;
    transition: all 0.3s ease;
}

.upload-section:hover {
    border-color: #4e73df;
    background: #f0f5ff;
}

.custom-file-upload {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
    margin-bottom: 20px;
}

.custom-file-upload input[type="file"] {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.upload-label {
    display: block;
    padding: 25px;
    background: white;
    border: 3px dashed #4e73df;
    border-radius: 12px;
    text-align: center;
    color: #4e73df;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1.1rem;
}

.upload-label:hover {
    background: #4e73df;
    color: white;
    border-color: #4e73df;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(78, 115, 223, 0.3);
}

.upload-preview-card {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    height: 140px;
    border: 3px solid #e0e0e0;
    background: white;
    transition: all 0.3s ease;
}

.upload-preview-card:hover {
    border-color: #4e73df;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(78, 115, 223, 0.2);
}

.upload-preview-img {
    width: 100%;
    height: 100px;
    object-fit: cover;
}

.upload-preview-doc {
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.upload-preview-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 5px 8px;
    font-size: 11px;
}

.upload-btn {
    padding: 15px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
    background: linear-gradient(135deg, #4CAF50, #66BB6A);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.upload-btn:hover:not(:disabled) {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
    background: linear-gradient(135deg, #43A047, #5CB85C);
}

.upload-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

/* ==================== EMPTY GALLERY ==================== */
.empty-gallery {
    padding: 80px 20px;
    background: #f8f9fa;
    border-radius: 15px;
    border: 3px dashed #dee2e6;
    margin: 30px 0;
}

.empty-gallery i {
    opacity: 0.5;
    transition: opacity 0.3s ease;
    font-size: 5rem;
}

.empty-gallery:hover i {
    opacity: 0.8;
}

.empty-gallery h5 {
    font-size: 1.5rem;
    margin: 20px 0 10px;
}

.empty-gallery p {
    font-size: 1.1rem;
}

/* ==================== TOAST NOTIFICATION ==================== */
.toast-notification {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: white;
    border-radius: 12px;
    padding: 18px 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-width: 350px;
    max-width: 450px;
    z-index: 9999;
    animation: slideIn 0.3s ease;
    border-left: 5px solid;
}

.toast-success {
    border-left-color: #4CAF50;
}

.toast-error {
    border-left-color: #f44336;
}

.toast-info {
    border-left-color: #2196F3;
}

.toast-warning {
    border-left-color: #FF9800;
}

.toast-content {
    display: flex;
    align-items: center;
    flex: 1;
}

.toast-content i {
    font-size: 24px;
    margin-right: 12px;
}

.toast-success .toast-content i {
    color: #4CAF50;
}

.toast-error .toast-content i {
    color: #f44336;
}

.toast-info .toast-content i {
    color: #2196F3;
}

.toast-warning .toast-content i {
    color: #FF9800;
}

.toast-close {
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    color: #999;
    padding: 0;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.toast-close:hover {
    background: #f0f0f0;
    color: #333;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* ==================== BUTTON STYLES ==================== */
.btn-primary {
    background: linear-gradient(135deg, #4e73df, #224abe);
    border: none;
    font-weight: 600;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #3a56c4, #1d3ca8);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(78, 115, 223, 0.4);
}

.btn-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    border: none;
    color: #212529;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #e0a800, #d39e00);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
}

/* ==================== FORM CHECK STYLES ==================== */
.form-check-input:checked {
    background-color: #4e73df;
    border-color: #4e73df;
}

.form-check-input:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

/* ==================== ANIMATIONS ==================== */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card-edit, .card-gallery {
    animation: fadeIn 0.5s ease;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

.main-photo.pulsing {
    animation: pulse 2s infinite;
}

/* ==================== RESPONSIVE STYLES ==================== */
@media (max-width: 1200px) {
    .main-photo-wrapper {
        min-height: 450px;
        max-height: 500px;
    }

    .main-photo {
        max-height: 500px;
    }

    #imageFullscreenModal .modal-dialog {
        max-width: 100%;
        margin: 5px auto;
    }
}

@media (max-width: 992px) {
    .card-edit, .card-gallery {
        margin-bottom: 25px;
    }

    .main-photo-wrapper {
        min-height: 400px;
        max-height: 450px;
    }

    .main-photo {
        max-height: 450px;
    }

    .thumbnail-card {
        height: 120px;
    }

    .gallery-nav {
        justify-content: center;
    }

    .gallery-nav .btn {
        flex: 1;
        min-width: 140px;
        margin-bottom: 8px;
    }

    #imageFullscreenModal .modal-body {
        min-height: 80vh;
    }

    #fullscreenImage {
        max-height: 80vh;
    }
}

@media (max-width: 768px) {
    .card-edit .form-label {
        font-size: 0.9rem;
    }

    .card-edit .form-control-sm {
        padding: 10px;
        font-size: 0.9rem;
    }

    .main-photo-wrapper {
        min-height: 350px;
        max-height: 400px;
    }

    .main-photo {
        max-height: 400px;
    }

    .thumbnail-card {
        height: 100px;
    }

    .photo-overlay {
        opacity: 1;
        top: 15px;
        right: 15px;
        gap: 8px;
    }

    .photo-overlay .btn {
        width: 35px;
        height: 35px;
        font-size: 16px;
    }

    .gallery-nav .btn {
        padding: 7px 12px;
        font-size: 0.85rem;
        min-width: 120px;
    }

    .toast-notification {
        min-width: 280px;
        max-width: 320px;
        left: 50%;
        right: auto;
        transform: translateX(-50%);
        bottom: 20px;
    }

    #imageFullscreenModal .modal-body {
        min-height: 70vh;
    }

    #fullscreenImage {
        max-height: 70vh;
    }
}

@media (max-width: 576px) {
    .main-photo-wrapper {
        min-height: 300px;
        max-height: 350px;
    }

    .main-photo {
        max-height: 350px;
    }

    .thumbnail-card {
        height: 90px;
    }

    .thumbnail-overlay {
        padding: 10px;
        gap: 6px;
    }

    .delete-thumbnail, .download-thumbnail, .view-thumbnail {
        width: 28px;
        height: 28px;
        font-size: 14px;
    }

    .photo-info #currentPhotoName {
        font-size: 0.9rem;
    }

    .photo-controls .badge {
        font-size: 0.8rem;
        padding: 6px 12px;
    }

    .upload-label {
        padding: 20px;
        font-size: 1rem;
    }

    .upload-btn {
        padding: 12px;
        font-size: 0.95rem;
    }

    #imageFullscreenModal .modal-body {
        min-height: 60vh;
    }

    #fullscreenImage {
        max-height: 60vh;
    }
}

@media (max-width: 400px) {
    .main-photo-wrapper {
        min-height: 250px;
        max-height: 300px;
    }

    .main-photo {
        max-height: 300px;
    }

    .thumbnail-card {
        height: 80px;
    }

    .gallery-nav .btn {
        min-width: 100%;
        margin-bottom: 5px;
    }

    #imageFullscreenModal .modal-body {
        min-height: 50vh;
    }

    #fullscreenImage {
        max-height: 50vh;
    }
}
</style>

@endsection
