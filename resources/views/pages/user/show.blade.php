@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

        {{-- ====================== START MAIN CONTENT ====================== --}}

        <!-- Header -->
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-eye text-primary mr-2"></i>
                Detail User
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Data User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail User</li>
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

        <div class="row">
            <!-- Informasi User -->
            <div class="col-lg-5 mb-4">
                <div class="card card-detail">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="mdi mdi-information mr-2"></i>Informasi User</h5>
                    </div>
                    <div class="card-body">
                        <div class="detail-info">
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-account text-primary"></i>
                                    <span>Nama User</span>
                                </div>
                                <div class="detail-value">{{ $user->name }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-email text-primary"></i>
                                    <span>Email</span>
                                </div>
                                <div class="detail-value">{{ $user->email }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-shield-account text-primary"></i>
                                    <span>Role</span>
                                </div>
                                <div class="detail-value">
                                    @if($user->role == 'admin')
                                        <span class="badge-danger">Admin</span>
                                    @elseif($user->role == 'pemilik')
                                        <span class="badge-warning">Pemilik Homestay</span>
                                    @else
                                        <span class="badge-primary">Warga</span>
                                    @endif
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-check-circle text-primary"></i>
                                    <span>Status Email</span>
                                </div>
                                <div class="detail-value">
                                    @if($user->email_verified_at)
                                        <span class="badge-hijau">Terverifikasi</span>
                                    @else
                                        <span class="badge-orange">Belum Verifikasi</span>
                                    @endif
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-camera text-primary"></i>
                                    <span>Foto Profil</span>
                                </div>
                                <div class="detail-value">
                                    @if($user->profile_picture)
                                        <span class="badge-hijau">Custom</span>
                                    @else
                                        <span class="badge-biru">Default</span>
                                    @endif
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-identifier text-primary"></i>
                                    <span>ID User</span>
                                </div>
                                <div class="detail-value">
                                    <span class="badge bg-secondary">#{{ $user->id }}</span>
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-calendar text-primary"></i>
                                    <span>Bergabung</span>
                                </div>
                                <div class="detail-value">{{ $user->created_at->format('d F Y H:i') }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-update text-primary"></i>
                                    <span>Terakhir Update</span>
                                </div>
                                <div class="detail-value">{{ $user->updated_at->format('d F Y H:i') }}</div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex mt-4 pt-3 border-top">
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning me-2 btn-action">
                                <i class="mdi mdi-pencil mr-1"></i> Edit Data
                            </a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-action"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    <i class="mdi mdi-delete mr-1"></i> Hapus
                                </button>
                            </form>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary ms-auto btn-action">
                                <i class="mdi mdi-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Foto Profil User -->
            <div class="col-lg-7 mb-4">
                <div class="card border-0 shadow card-gallery">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="mdi mdi-camera mr-2"></i>Foto Profil User</h5>
                        <span class="badge bg-light text-dark">1 File</span>
                    </div>
                    <div class="card-body">
                        <!-- Main Photo Preview - SAMA PERSIS DENGAN SHOW DESTINASI -->
                        <div class="main-photo-container mb-4">
                            <div class="main-photo-wrapper">
                                @if($user->profile_photo_url && $user->profile_picture)
                                    <!-- Jika ada foto profil custom -->
                                    <img src="{{ $user->profile_photo_url }}"
                                         id="currentMainPhoto"
                                         class="main-photo"
                                         alt="Foto Profil {{ $user->name }}"
                                         onerror="handleImageError(this, '{{ $user->name }}')">
                                    <div class="photo-overlay">
                                        <button class="btn btn-light btn-sm" onclick="downloadCurrentPhoto()"
                                                data-toggle="tooltip" title="Download">
                                            <i class="mdi mdi-download"></i>
                                        </button>
                                        <button class="btn btn-light btn-sm" onclick="openFullscreenImage()"
                                                data-toggle="tooltip" title="Fullscreen">
                                            <i class="mdi mdi-fullscreen"></i>
                                        </button>
                                    </div>
                                @else
                                    <!-- PLACEHOLDER YANG SAMA DENGAN KODINGAN USER ANDA -->
                                    <div class="placeholder-wrapper">
                                        <div class="placeholder-content">
                                            <img src="{{ $user->profile_photo_url }}"
                                                 alt="Profile {{ $user->name }}"
                                                 class="rounded-circle mb-3"
                                                 style="width: 180px; height: 180px; object-fit: cover;
                                                        @if(!$user->profile_picture) background-color: #f8f9fa; border: 4px dashed #dee2e6; @else border: 4px solid #4e73df; @endif"
                                                 onerror="this.onerror=null; this.src='{{ $user->profile_photo_url }}'">

                                            @if($user->profile_picture)
                                                <span class="badge bg-success mb-2">
                                                    <i class="mdi mdi-check mr-1"></i> Foto Custom
                                                </span>
                                            @else
                                                <span class="badge bg-secondary mb-2">
                                                    <i class="mdi mdi-account mr-1"></i> Avatar Default
                                                </span>
                                            @endif

                                            <h4 class="mb-1">{{ $user->name }}</h4>

                                            @if($user->role == 'admin')
                                                <span class="badge badge-danger py-2 px-3 mb-2">
                                                    <i class="mdi mdi-shield-account mr-1"></i>Admin
                                                </span>
                                            @elseif($user->role == 'pemilik')
                                                <span class="badge badge-warning py-2 px-3 mb-2">
                                                    <i class="mdi mdi-home-account mr-1"></i>Pemilik
                                                </span>
                                            @else
                                                <span class="badge badge-primary py-2 px-3 mb-2">
                                                    <i class="mdi mdi-account mr-1"></i>Warga
                                                </span>
                                            @endif

                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                            <small class="text-muted">ID: {{ $user->id }}</small>

                                            <div class="placeholder-actions mt-3">
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="mdi mdi-camera mr-1"></i> Upload Foto
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="photo-info text-center mt-2">
                                @if($user->profile_photo_url && $user->profile_picture)
                                    <small id="currentPhotoName" class="text-truncate d-block">Foto Profil {{ $user->name }}</small>
                                @else
                                    <small id="currentPhotoName" class="text-truncate d-block">Avatar Default</small>
                                @endif
                                <div class="photo-controls mt-2">
                                    @if($user->profile_photo_url && $user->profile_picture)
                                        <span class="badge bg-primary" id="photoCounter">Foto Custom</span>
                                    @else
                                        <span class="badge bg-secondary" id="photoCounter">Avatar Default</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnail Gallery - Untuk Konsep yang Sama -->
                        <h6 class="border-bottom pb-2 mb-3">
                            <i class="mdi mdi-image-multiple mr-2"></i>Detail Foto Profil
                        </h6>

                        <div class="row g-2" id="thumbnailGallery">
                            <div class="col-md-3 col-4">
                                <div class="thumbnail-card active"
                                     onclick="changeMainPhoto('{{ $user->profile_photo_url }}', 0, 'image/jpeg', '{{ $user->id }}', 'Foto Profil')">
                                    @if($user->profile_photo_url && $user->profile_picture)
                                        <img src="{{ $user->profile_photo_url }}"
                                             class="thumbnail-img"
                                             alt="Foto Profil"
                                             onerror="handleThumbnailError(this, 'Foto Profil')">
                                    @else
                                        <div class="file-thumbnail text-center py-3">
                                            <i class="mdi mdi-account text-info" style="font-size: 40px;"></i>
                                            <small class="d-block text-truncate mt-1">Avatar</small>
                                        </div>
                                    @endif
                                    <div class="thumbnail-overlay">
                                        @if($user->profile_photo_url && $user->profile_picture)
                                            <a href="{{ $user->profile_photo_url }}"
                                               class="btn btn-info btn-sm download-thumbnail"
                                               target="_blank"
                                               data-toggle="tooltip"
                                               title="Download Foto">
                                                <i class="mdi mdi-download"></i>
                                            </a>
                                        @endif
                                        <span class="badge badge-order">1</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Form -->
                        <div class="upload-section mt-4 pt-4 border-top">
                            <h6 class="mb-3">
                                <i class="mdi mdi-cloud-upload text-primary mr-2"></i>
                                Upload Foto Profil Baru
                            </h6>
                            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <div class="custom-file-upload">
                                        <input type="file"
                                               class="form-control @error('profile_picture') is-invalid @enderror"
                                               id="profile_picture"
                                               name="profile_picture"
                                               accept=".jpg,.jpeg,.png,.gif,.webp"
                                               onchange="previewUploadFiles(this)">
                                        <label for="profile_picture" class="upload-label">
                                            <i class="mdi mdi-cloud-upload mr-2"></i>
                                            <span>Pilih Foto Profil</span>
                                        </label>
                                    </div>
                                    @error('profile_picture')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        <i class="mdi mdi-information mr-1"></i>
                                        Pilih file gambar (JPG, PNG, GIF, WEBP). Maksimal 5MB.
                                    </small>
                                </div>

                                <!-- Upload Preview -->
                                <div id="uploadPreview" class="mb-3" style="display: none;">
                                    <h6 class="text-muted mb-2">Preview Foto yang akan diupload:</h6>
                                    <div id="previewContainer" class="row g-2"></div>
                                    <div class="mt-2 text-end">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearPreview()">
                                            <i class="mdi mdi-trash-can mr-1"></i> Clear Preview
                                        </button>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success w-100 upload-btn" id="uploadBtn">
                                    <i class="mdi mdi-cloud-upload mr-1"></i> Upload Foto
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

{{-- ====================== START JS TAMBAHAN ====================== --}}
<script>
    // Variables
    let currentPhotoIndex = 0;
    let currentFileName = "{{ $user->profile_photo_url ?: '' }}";
    let currentFileType = "image/jpeg";
    let currentFileId = "{{ $user->id }}";
    let currentFileDisplayName = "Foto Profil {{ $user->name }}";

    // Helper functions
    function getDownloadUrl() {
        return "{{ $user->profile_photo_url ?: '#' }}";
    }

    // ============ FUNGSI HANDLE ERROR GAMBAR ============
    function handleImageError(img, userName) {
        console.error('Gagal memuat foto profil:', userName);

        // Tampilkan placeholder dari kodingan user Anda
        const placeholderHTML = `
            <div class="placeholder-wrapper">
                <div class="placeholder-content">
                    <div class="rounded-circle mb-3"
                         style="width: 180px; height: 180px; background-color: #f8f9fa; border: 4px dashed #dee2e6; display: flex; align-items: center; justify-content: center;">
                        <i class="mdi mdi-account" style="font-size: 80px; color: #adb5bd;"></i>
                    </div>

                    <span class="badge bg-secondary mb-2">
                        <i class="mdi mdi-account mr-1"></i> Avatar Default
                    </span>

                    <h4 class="mb-1">${userName}</h4>

                    @if($user->role == 'admin')
                        <span class="badge badge-danger py-2 px-3 mb-2">
                            <i class="mdi mdi-shield-account mr-1"></i>Admin
                        </span>
                    @elseif($user->role == 'pemilik')
                        <span class="badge badge-warning py-2 px-3 mb-2">
                            <i class="mdi mdi-home-account mr-1"></i>Pemilik
                        </span>
                    @else
                        <span class="badge badge-primary py-2 px-3 mb-2">
                            <i class="mdi mdi-account mr-1"></i>Warga
                        </span>
                    @endif

                    <p class="text-muted mb-0">{{ $user->email }}</p>
                    <small class="text-muted">ID: {{ $user->id }}</small>

                    <div class="placeholder-actions mt-3">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-camera mr-1"></i> Upload Foto
                        </a>
                    </div>
                </div>
            </div>`;

        const wrapper = img.parentElement;
        wrapper.innerHTML = placeholderHTML;
    }

    function handleThumbnailError(img, fileName) {
        console.error('Gagal memuat thumbnail:', fileName);

        const placeholderHTML = `
            <div class="file-thumbnail text-center py-3">
                <div class="rounded-circle mb-2"
                     style="width: 60px; height: 60px; background-color: #f8f9fa; border: 2px dashed #dee2e6; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                    <i class="mdi mdi-account" style="font-size: 30px; color: #adb5bd;"></i>
                </div>
                <small class="d-block text-truncate mt-1">Avatar</small>
            </div>`;

        const thumbnailCard = img.parentElement;
        thumbnailCard.innerHTML = placeholderHTML;
    }

    function handleFullscreenImageError(img) {
        console.error('Gagal memuat gambar fullscreen');

        const placeholderHTML = `
            <div class="placeholder-content-fullscreen text-center py-5">
                <div class="rounded-circle mb-4"
                     style="width: 200px; height: 200px; background-color: #343a40; border: 4px solid #495057; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                    <i class="mdi mdi-account text-white" style="font-size: 100px;"></i>
                </div>
                <h4 class="text-white mt-4">{{ $user->name }}</h4>
                <p class="text-muted">Foto profil tidak dapat ditampilkan</p>
            </div>`;

        img.parentElement.innerHTML = placeholderHTML;
    }

    // ============ GALLERY FUNCTIONS ============
    function changeMainPhoto(fileName, index, mimeType, fileId, displayName) {
        currentPhotoIndex = index;
        currentFileName = fileName;
        currentFileType = mimeType;
        currentFileId = fileId;
        currentFileDisplayName = displayName;

        const mainPhoto = document.getElementById('currentMainPhoto');
        const photoName = document.getElementById('currentPhotoName');
        const photoCounter = document.getElementById('photoCounter');

        if (fileName) {
            const timestamp = new Date().getTime();
            mainPhoto.src = fileName + '?t=' + timestamp;
            document.getElementById('fullscreenImage').src = fileName + '?t=' + timestamp;
            document.getElementById('imageFullscreenTitle').textContent = displayName;

            // Tampilkan overlay controls
            const photoOverlay = document.querySelector('.photo-overlay');
            if (photoOverlay) photoOverlay.style.display = 'flex';
        }

        photoName.textContent = displayName;
        photoCounter.textContent = "Foto Custom";

        // Update active thumbnail
        document.querySelectorAll('.thumbnail-card').forEach(card => {
            card.classList.remove('active');
        });
        document.querySelector('.thumbnail-card').classList.add('active');
    }

    // ============ DOWNLOAD FUNCTIONS ============
    function downloadCurrentPhoto() {
        const downloadUrl = getDownloadUrl();
        if (downloadUrl && downloadUrl !== '#') {
            window.open(downloadUrl, '_blank');
        }
    }

    function downloadFullscreenPhoto() {
        const downloadUrl = getDownloadUrl();
        if (downloadUrl && downloadUrl !== '#') {
            window.open(downloadUrl, '_blank');
        }
    }

    // ============ FULLSCREEN FUNCTIONS ============
    function openFullscreenImage() {
        const hasPhoto = currentFileName && currentFileName !== '#';

        if (hasPhoto) {
            $('#imageFullscreenModal').modal('show');

            const img = document.getElementById('fullscreenImage');
            img.style.maxWidth = '100%';
            img.style.maxHeight = '80vh';
            img.style.width = 'auto';
            img.style.height = 'auto';
            img.style.display = 'block';
            img.style.margin = '0 auto';
        } else {
            showToast('info', 'Tidak ada foto profil untuk ditampilkan fullscreen');
        }
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

            const file = input.files[0];

            // Check file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                showToast('error', `File ${file.name} melebihi 5MB`);
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-12';

                if (file.type.startsWith('image/')) {
                    col.innerHTML = `
                        <div class="upload-preview-card">
                            <img src="${e.target.result}"
                                 class="upload-preview-img"
                                 alt="Preview Foto Profil">
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

            showToast('info', 'Preview foto profil baru');
        } else {
            uploadPreview.style.display = 'none';
            uploadBtn.disabled = true;
        }
    }

    function clearPreview() {
        const input = document.getElementById('profile_picture');
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

    // ============ INITIALIZATION ============
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Auto dismiss alerts setelah 5 detik
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);

        // Initialize fullscreen image jika ada foto
        @if($user->profile_photo_url && $user->profile_picture)
            const firstFile = "{{ $user->profile_photo_url }}";
            const timestamp = new Date().getTime();
            document.getElementById('fullscreenImage').src = firstFile + '?t=' + timestamp;
            document.getElementById('imageFullscreenTitle').textContent = 'Foto Profil {{ $user->name }}';
        @endif

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Esc untuk keluar dari fullscreen
            if (e.key === 'Escape') {
                if ($('#imageFullscreenModal').hasClass('show')) {
                    $('#imageFullscreenModal').modal('hide');
                }
            }

            // F untuk fullscreen
            if (e.key === 'f' && !e.target.matches('input, textarea, button, a')) {
                e.preventDefault();
                openFullscreenImage();
            }
        });
    });
</script>

{{-- ====================== CSS SAMA PERSIS DENGAN SHOW DESTINASI ====================== --}}
<style>
/* ==================== DETAIL STYLES ==================== */
.card-detail {
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.card-detail:hover {
    transform: translateY(-5px);
}

.detail-info {
    padding: 10px 0;
}

.detail-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.detail-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.detail-label {
    min-width: 150px;
    display: flex;
    align-items: center;
    font-weight: 600;
    color: #555;
}

.detail-label i {
    font-size: 18px;
    margin-right: 10px;
    width: 24px;
}

.detail-value {
    flex: 1;
    color: #333;
    line-height: 1.5;
}

/* ==================== BADGE STYLES ==================== */
.badge-biru {
    background: linear-gradient(45deg, #2196F3, #64B5F6);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
}

.badge-hijau {
    background: linear-gradient(45deg, #4CAF50, #66BB6A);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
}

.badge-orange {
    background: linear-gradient(45deg, #FF6B35, #FF8E53);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
}

.badge-danger {
    background: linear-gradient(45deg, #DC3545, #E74C3C);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
}

.badge-warning {
    background: linear-gradient(45deg, #FFC107, #E0A800);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
}

.badge-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
}

.badge-secondary {
    background: linear-gradient(45deg, #6C757D, #868E96);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
}

/* ==================== CARD GALLERY STYLES ==================== */
.card-gallery {
    border-radius: 15px;
    overflow: hidden;
}

/* ==================== MAIN PHOTO CONTAINER ==================== */
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

.download-thumbnail {
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

.download-thumbnail:hover {
    background-color: #17a2b8 !important;
    transform: scale(1.15);
    box-shadow: 0 4px 10px rgba(23, 162, 184, 0.4);
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

/* ==================== PLACEHOLDER STYLES (DARI KODINGAN USER ANDA) ==================== */
.placeholder-wrapper {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 500px;
    max-height: 600px;
    border: 3px dashed #dee2e6;
    transition: all 0.3s ease;
    width: 100%;
}

.placeholder-wrapper:hover {
    border-color: #4e73df;
    background: linear-gradient(135deg, #f0f5ff 0%, #e3e9ff 100%);
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(78, 115, 223, 0.15);
}

.placeholder-content {
    text-align: center;
    padding: 40px;
    max-width: 500px;
}

.placeholder-content .rounded-circle {
    transition: all 0.5s ease;
    opacity: 0.6;
}

.placeholder-wrapper:hover .placeholder-content .rounded-circle {
    opacity: 0.8;
    transform: scale(1.05);
}

.placeholder-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 20px;
}

.placeholder-actions .btn {
    padding: 10px 25px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.placeholder-actions .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(78, 115, 223, 0.25);
}

.placeholder-content-fullscreen {
    width: 100%;
    padding: 40px;
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

/* ==================== BUTTON ACTIONS ==================== */
.btn-action {
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* ==================== ANIMATIONS ==================== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.card-detail, .card-gallery {
    animation: fadeIn 0.5s ease;
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 1200px) {
    .main-photo-wrapper {
        min-height: 450px;
        max-height: 500px;
    }

    .main-photo {
        max-height: 500px;
    }

    .placeholder-wrapper {
        min-height: 450px;
        max-height: 500px;
    }
}

@media (max-width: 992px) {
    .card-detail, .card-gallery {
        margin-bottom: 25px;
    }

    .main-photo-wrapper {
        min-height: 400px;
        max-height: 450px;
    }

    .main-photo {
        max-height: 450px;
    }

    .placeholder-wrapper {
        min-height: 400px;
        max-height: 450px;
    }

    .thumbnail-card {
        height: 120px;
    }

    .detail-label {
        min-width: 120px;
    }
}

@media (max-width: 768px) {
    .detail-item {
        flex-direction: column;
    }

    .detail-label {
        min-width: auto;
        margin-bottom: 5px;
    }

    .main-photo-wrapper {
        min-height: 350px;
        max-height: 400px;
    }

    .main-photo {
        max-height: 400px;
    }

    .placeholder-wrapper {
        min-height: 350px;
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

    .toast-notification {
        min-width: 280px;
        max-width: 320px;
        left: 50%;
        right: auto;
        transform: translateX(-50%);
        bottom: 20px;
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

    .placeholder-wrapper {
        min-height: 300px;
        max-height: 350px;
    }

    .thumbnail-card {
        height: 90px;
    }

    .thumbnail-overlay {
        padding: 10px;
        gap: 6px;
    }

    .download-thumbnail {
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
}

@media (max-width: 400px) {
    .main-photo-wrapper {
        min-height: 250px;
        max-height: 300px;
    }

    .main-photo {
        max-height: 300px;
    }

    .placeholder-wrapper {
        min-height: 250px;
        max-height: 300px;
    }

    .thumbnail-card {
        height: 80px;
    }
}
</style>

@endsection
