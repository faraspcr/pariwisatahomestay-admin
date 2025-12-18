@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

        {{-- ====================== START MAIN CONTENT ====================== --}}

        <!-- Header -->
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-pencil text-info mr-2"></i>
                Edit User
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Data User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
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

        <div class="row">
            <!-- Form Edit Data -->
            <div class="col-lg-6 mb-4">
                <div class="card card-edit">
                    <div class="card-header bg-info text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="mdi mdi-pencil-box mr-2"></i>Form Edit User</h5>
                            <a href="{{ route('user.index') }}" class="btn btn-light btn-sm">
                                <i class="mdi mdi-arrow-left mr-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update', $user->id) }}" method="POST" id="userForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <!-- Nama -->
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            <i class="mdi mdi-account text-primary mr-1"></i>
                                            Nama <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $user->name) }}"
                                            placeholder="Masukkan nama lengkap">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            <i class="mdi mdi-email text-primary mr-1"></i>
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $user->email) }}"
                                            placeholder="contoh: user@email.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <label for="password" class="form-label">
                                            <i class="mdi mdi-lock text-primary mr-1"></i>
                                            Password
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password"
                                                placeholder="Kosongkan jika tidak ingin mengubah">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="mdi mdi-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <!-- Konfirmasi Password -->
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="mdi mdi-lock-check text-primary mr-1"></i>
                                            Konfirmasi Password
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                id="password_confirmation" name="password_confirmation"
                                                placeholder="Ulangi password jika mengubah">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                                                    <i class="mdi mdi-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- ROLE - 3 PILIHAN -->
                                    <div class="form-group">
                                        <label for="role" class="form-label">
                                            <i class="mdi mdi-shield-account text-primary mr-1"></i>
                                            Role <span class="text-danger">*</span>
                                        </label>
                                        <select name="role" id="role" class="form-control form-control-sm @error('role') is-invalid @enderror">
                                            <option value="">Pilih Role</option>
                                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="pemilik" {{ old('role', $user->role) == 'pemilik' ? 'selected' : '' }}>Pemilik Homestay</option>
                                            <option value="warga" {{ old('role', $user->role) == 'warga' ? 'selected' : '' }}>Warga</option>
                                        </select>
                                        @error('role')
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
                                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-sm">
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

            <!-- Foto Profil -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow card-gallery">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="mdi mdi-camera mr-2"></i>Foto Profil User</h5>
                        <span class="badge bg-light text-dark">{{ $user->profile_picture ? 'Custom' : 'Default' }}</span>
                    </div>
                    <div class="card-body">
                        <!-- Current Photo Preview -->
                        <div class="main-photo-container mb-4">
                            <div class="main-photo-wrapper">
                                @if($user->profile_photo_url)
                                    <!-- Jika ada foto profil -->
                                    <img src="{{ $user->profile_photo_url }}"
                                         id="currentProfilePhoto"
                                         class="main-photo profile-photo"
                                         alt="Foto Profil {{ $user->name }}"
                                         onerror="handleProfileImageError(this)">
                                @else
                                    <!-- Placeholder ketika tidak ada foto -->
                                    <div class="placeholder-content">
                                        <div class="avatar-icon">
                                            <i class="mdi mdi-account-circle placeholder-icon"></i>
                                        </div>
                                        <h4 class="placeholder-title">Avatar Default</h4>
                                        <p class="placeholder-text">User belum mengupload foto profil</p>
                                    </div>
                                @endif
                            </div>
                            <div class="photo-info text-center mt-2">
                                <small id="profileName" class="text-truncate d-block">{{ $user->name }}</small>
                                <div class="photo-controls mt-2">
                                    @if($user->profile_photo_url && $user->profile_picture)
                                        <span class="badge bg-primary">Foto Custom</span>
                                    @else
                                        <span class="badge bg-secondary">Avatar Default</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Form Upload Foto Profil -->
                        <div class="upload-section mt-4 pt-4 border-top">
                            <h6 class="mb-3">
                                <i class="mdi mdi-cloud-upload text-primary mr-2"></i>
                                Upload Foto Profil Baru
                            </h6>

                            <!-- Foto Saat Ini -->
                            <div class="current-photo-section mb-4">
                                <h6 class="mb-3">
                                    <i class="mdi mdi-image text-primary mr-1"></i>
                                    Foto Saat Ini
                                </h6>
                                <div class="text-center">
                                    @if($user->profile_picture)
                                        <!-- Foto Custom -->
                                        <div class="position-relative d-inline-block mb-3">
                                            <img src="{{ $user->profile_photo_url }}"
                                                 alt="Profile {{ $user->name }}"
                                                 class="rounded-circle border shadow"
                                                 style="width: 120px; height: 120px; object-fit: cover;"
                                                 onerror="this.onerror=null; this.src='{{ $user->profile_photo_url }}'">
                                            <span class="badge bg-success position-absolute" style="bottom: 5px; right: 5px;">
                                                <i class="mdi mdi-check"></i> Custom
                                            </span>
                                        </div>
                                        <div class="form-check d-block">
                                            <input class="form-check-input" type="checkbox"
                                                   name="remove_photo"
                                                   id="remove_photo" value="1">
                                            <label class="form-check-label text-danger" for="remove_photo">
                                                <i class="mdi mdi-trash-can-outline mr-1"></i> Hapus foto custom
                                            </label>
                                            <small class="form-text text-muted d-block">
                                                Jika dihapus, akan kembali ke avatar default
                                            </small>
                                        </div>
                                    @else
                                        <!-- Default Avatar -->
                                        <div class="position-relative d-inline-block mb-3">
                                            <div class="default-avatar-placeholder rounded-circle border shadow d-flex align-items-center justify-content-center mx-auto"
                                                 style="width: 120px; height: 120px; background-color: #f8f9fa; border: 2px dashed #dee2e6 !important;">
                                                <img src="{{ $user->profile_photo_url }}"
                                                     alt="Default Avatar"
                                                     style="width: 60px; height: 60px;">
                                            </div>
                                            <span class="badge bg-secondary position-absolute" style="bottom: 5px; right: 5px;">
                                                <i class="mdi mdi-account"></i> Default
                                            </span>
                                        </div>
                                        <p class="text-muted mb-0">Avatar default</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Upload Foto Baru -->
                            <div class="upload-new-section">
                                <h6 class="mb-3">
                                    <i class="mdi mdi-camera-plus text-primary mr-1"></i>
                                    Upload Foto Baru
                                </h6>
                                <div class="custom-file-upload mb-3">
                                    <input type="file"
                                           class="form-control @error('profile_photo') is-invalid @enderror"
                                           id="profile_photo"
                                           name="profile_photo"
                                           accept="image/*"
                                           onchange="previewUploadFiles(this)">
                                    <label for="profile_photo" class="upload-label">
                                        <i class="mdi mdi-cloud-upload mr-2"></i>
                                        <span>Pilih Foto Profil</span>
                                    </label>
                                </div>
                                @error('profile_photo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    <i class="mdi mdi-information mr-1"></i>
                                    Format: JPG, JPEG, PNG, GIF, WEBP (Maks 2MB)
                                </small>

                                <!-- Upload Preview -->
                                <div id="uploadPreview" class="mb-3" style="display: none;">
                                    <h6 class="text-muted mb-2">Preview Foto Baru:</h6>
                                    <div id="previewContainer" class="row g-2"></div>
                                    <div class="mt-2 text-end">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearPreview()">
                                            <i class="mdi mdi-trash-can mr-1"></i> Clear Preview
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Status -->
                        <div class="status-section mt-4 pt-3 border-top">
                            <h6 class="mb-3">
                                <i class="mdi mdi-information-outline text-primary mr-2"></i>
                                Informasi Status
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="status-item mb-3">
                                        <small class="text-muted d-block">Verifikasi Email</small>
                                        @if($user->email_verified_at)
                                            <span class="badge badge-success">Terverifikasi</span>
                                        @else
                                            <span class="badge badge-secondary">Belum Verifikasi</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="status-item mb-3">
                                        <small class="text-muted d-block">Bergabung Sejak</small>
                                        <p class="mb-0">{{ $user->created_at->format('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ====================== END MAIN CONTENT ====================== --}}
    </div>
</div>

{{-- ====================== MODAL FULLSCREEN PROFILE PHOTO ====================== --}}
<div class="modal fade" id="profileFullscreenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h6 class="modal-title text-white">Foto Profil {{ $user->name }}</h6>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 d-flex align-items-center justify-content-center" style="min-height: 70vh;">
                <div class="image-container" style="width: 100%; height: 100%;">
                    @if($user->profile_photo_url)
                        <img id="fullscreenProfileImage" src="{{ $user->profile_photo_url }}"
                             class="img-fluid rounded-circle"
                             style="max-width: 400px; max-height: 400px; width: auto; height: auto; display: block; margin: 0 auto;"
                             alt="Foto Profil {{ $user->name }}">
                    @else
                        <div class="placeholder-content-fullscreen text-center py-5">
                            <i class="mdi mdi-account-circle text-white" style="font-size: 200px;"></i>
                            <h4 class="text-white mt-4">Avatar Default</h4>
                            <p class="text-muted">User belum mengupload foto profil</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                @if($user->profile_photo_url && $user->profile_picture)
                <button class="btn btn-light me-2" onclick="downloadProfilePhoto()">
                    <i class="mdi mdi-download mr-1"></i> Download
                </button>
                @endif
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
    const userId = {{ $user->id }};
    const userName = "{{ $user->name }}";
    const profilePhotoUrl = "{{ $user->profile_photo_url }}";
    const hasCustomPhoto = {{ $user->profile_picture ? 'true' : 'false' }};

    // Form Validation
    document.getElementById('confirmEdit').addEventListener('change', function() {
        document.getElementById('submitBtn').disabled = !this.checked;
    });

    // ============ FUNGSI HANDLE ERROR GAMBAR ============
    function handleProfileImageError(img) {
        console.error('Gagal memuat foto profil:', profilePhotoUrl);

        // Ganti dengan placeholder avatar default
        const placeholderHTML = `
            <div class="placeholder-content">
                <div class="avatar-icon">
                    <i class="mdi mdi-account-circle placeholder-icon"></i>
                </div>
                <h4 class="placeholder-title">Avatar Default</h4>
                <p class="placeholder-text">User belum mengupload foto profil</p>
            </div>`;

        const wrapper = img.parentElement;
        wrapper.innerHTML = placeholderHTML;

        // Update badge menjadi default
        const badgeElement = document.querySelector('.photo-controls .badge');
        if (badgeElement) {
            badgeElement.className = 'badge bg-secondary';
            badgeElement.textContent = 'Avatar Default';
        }
    }

    // ============ FUNGSI DOWNLOAD DAN FULLSCREEN ============
    function downloadProfilePhoto() {
        if (profilePhotoUrl && hasCustomPhoto) {
            // Buat link download secara dinamis
            const link = document.createElement('a');
            link.href = profilePhotoUrl;
            link.target = '_blank';
            link.download = `profile-${userName.toLowerCase().replace(/\s+/g, '-')}.jpg`;

            // Tambahkan ke body dan klik
            document.body.appendChild(link);
            link.click();

            // Hapus link setelah diklik
            setTimeout(() => {
                document.body.removeChild(link);
            }, 100);

            showToast('success', 'Download foto profil dimulai');
        } else {
            showToast('warning', 'Tidak ada foto profil custom untuk didownload');
        }
    }

    function openFullscreenProfile() {
        $('#profileFullscreenModal').modal('show');

        // Update image untuk fullscreen jika ada
        if (profilePhotoUrl) {
            const timestamp = new Date().getTime();
            const fullscreenImg = document.getElementById('fullscreenProfileImage');
            if (fullscreenImg) {
                fullscreenImg.src = profilePhotoUrl + (profilePhotoUrl.includes('?') ? '&' : '?') + 't=' + timestamp;
            }
        }
    }

    // ============ TOGGLE PASSWORD VISIBILITY ============
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('mdi-eye');
        this.querySelector('i').classList.toggle('mdi-eye-off');
    });

    document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmationInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('mdi-eye');
        this.querySelector('i').classList.toggle('mdi-eye-off');
    });

    // ============ UPLOAD PREVIEW FUNCTIONS ============
    function previewUploadFiles(input) {
        const previewContainer = document.getElementById('previewContainer');
        const uploadPreview = document.getElementById('uploadPreview');
        const removePhotoCheckbox = document.getElementById('remove_photo');

        previewContainer.innerHTML = '';

        if (input.files.length > 0) {
            uploadPreview.style.display = 'block';

            const file = input.files[0];

            // Check file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                showToast('error', `File ${file.name} melebihi 2MB`);
                input.value = '';
                uploadPreview.style.display = 'none';
                return;
            }

            // Validasi tipe file
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                showToast('error', 'Format file tidak didukung. Gunakan JPG, JPEG, PNG, GIF, atau WEBP.');
                input.value = '';
                uploadPreview.style.display = 'none';
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

            // Uncheck remove photo checkbox jika upload foto baru
            if (removePhotoCheckbox) {
                removePhotoCheckbox.checked = false;
            }
        } else {
            uploadPreview.style.display = 'none';
        }
    }

    function clearPreview() {
        const input = document.getElementById('profile_photo');
        input.value = '';
        previewUploadFiles(input);
    }

    // ============ CHECKBOX REMOVE PHOTO ============
    const removePhotoCheckbox = document.getElementById('remove_photo');
    const profilePhotoInput = document.getElementById('profile_photo');

    if (removePhotoCheckbox) {
        removePhotoCheckbox.addEventListener('change', function() {
            if (this.checked) {
                profilePhotoInput.disabled = true;
                profilePhotoInput.value = '';
                document.getElementById('uploadPreview').style.display = 'none';
                document.getElementById('previewContainer').innerHTML = '';

                // Tampilkan alert konfirmasi
                if (confirm('Yakin ingin menghapus foto profil? Foto akan diganti dengan avatar default.')) {
                    // Tetap centang
                } else {
                    this.checked = false;
                    profilePhotoInput.disabled = false;
                }
            } else {
                profilePhotoInput.disabled = false;
            }
        });
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
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const role = document.getElementById('role').value;
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        let isValid = true;
        let errorMessage = '';

        if (name.length < 3) {
            isValid = false;
            errorMessage += 'Nama minimal 3 karakter\n';
        }

        if (!email.includes('@') || !email.includes('.')) {
            isValid = false;
            errorMessage += 'Format email tidak valid\n';
        }

        if (!role) {
            isValid = false;
            errorMessage += 'Role harus dipilih\n';
        }

        if (password && password.length < 6) {
            isValid = false;
            errorMessage += 'Password minimal 6 karakter\n';
        }

        if (password && password !== passwordConfirmation) {
            isValid = false;
            errorMessage += 'Password dan Konfirmasi Password tidak sama\n';
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
        document.getElementById('userForm').addEventListener('submit', function(e) {
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
                window.location.href = "{{ route('user.index') }}";
            }
        });
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

/* ==================== CARD GALLERY STYLES ==================== */
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
    min-height: 300px;
    max-height: 350px;
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

.profile-photo {
    max-width: 100%;
    max-height: 300px;
    width: auto;
    height: auto;
    object-fit: contain;
    border-radius: 8px;
    transition: transform 0.5s ease;
    cursor: pointer;
}

.profile-photo:hover {
    transform: scale(1.03);
}

.photo-info {
    background: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-top: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
}

.photo-info #profileName {
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

/* ==================== PLACEHOLDER STYLES ==================== */
.placeholder-content {
    text-align: center;
    padding: 40px;
    max-width: 500px;
}

.avatar-icon {
    margin-bottom: 25px;
}

.placeholder-icon {
    font-size: 100px;
    color: #adb5bd;
    display: block;
    transition: all 0.5s ease;
    opacity: 0.6;
}

.main-photo-wrapper:hover .placeholder-icon {
    color: #4e73df;
    transform: scale(1.1);
    opacity: 0.8;
}

.placeholder-title {
    color: #495057;
    font-weight: 600;
    font-size: 1.4rem;
    margin-bottom: 15px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
}

.placeholder-text {
    color: #6c757d;
    font-size: 1rem;
    margin-bottom: 30px;
    line-height: 1.6;
}

.placeholder-content-fullscreen {
    width: 100%;
    padding: 40px;
}

/* ==================== CURRENT PHOTO STYLES ==================== */
.current-photo-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.current-photo-section h6 {
    color: #495057;
    font-weight: 600;
    font-size: 1rem;
}

.current-photo-section .rounded-circle {
    border: 3px solid #4e73df;
    box-shadow: 0 2px 4px rgba(78, 115, 223, 0.2);
    transition: all 0.3s ease;
}

.current-photo-section .rounded-circle:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(78, 115, 223, 0.3);
}

/* ✅ STYLE KHUSUS UNTUK DEFAULT AVATAR */
.default-avatar-placeholder {
    background-color: #f8f9fa;
    border: 2px dashed #dee2e6 !important;
    transition: all 0.3s ease;
}

.default-avatar-placeholder:hover {
    background-color: #e9ecef;
    border-color: #adb5bd !important;
}

/* ==================== UPLOAD STYLES ==================== */
.upload-section {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    border: 3px dashed #dee2e6;
    transition: all 0.3s ease;
}

.upload-section:hover {
    border-color: #4e73df;
    background: #f0f5ff;
}

.upload-new-section h6 {
    color: #495057;
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 15px;
}

.custom-file-upload {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
    margin-bottom: 10px;
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
    padding: 20px;
    background: white;
    border: 3px dashed #4e73df;
    border-radius: 12px;
    text-align: center;
    color: #4e73df;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
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

/* ==================== STATUS SECTION ==================== */
.status-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.status-section h6 {
    color: #495057;
    font-weight: 600;
    font-size: 1rem;
}

.status-item {
    padding: 10px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
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

/* ==================== BADGE STYLES ==================== */
.badge-success {
    background: linear-gradient(45deg, #28a745, #1e7e34);
}

.badge-secondary {
    background: linear-gradient(45deg, #6c757d, #545b62);
}

/* ==================== RESPONSIVE STYLES ==================== */
@media (max-width: 1200px) {
    .main-photo-wrapper {
        min-height: 280px;
        max-height: 320px;
    }

    .profile-photo {
        max-height: 280px;
    }
}

@media (max-width: 992px) {
    .card-edit, .card-gallery {
        margin-bottom: 25px;
    }

    .main-photo-wrapper {
        min-height: 250px;
        max-height: 300px;
    }

    .profile-photo {
        max-height: 250px;
    }

    .placeholder-icon {
        font-size: 80px;
    }

    .placeholder-title {
        font-size: 1.2rem;
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
        min-height: 220px;
        max-height: 250px;
    }

    .profile-photo {
        max-height: 220px;
    }

    .placeholder-content {
        padding: 30px;
    }

    .placeholder-icon {
        font-size: 70px;
    }

    .placeholder-title {
        font-size: 1.1rem;
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
        min-height: 200px;
        max-height: 220px;
    }

    .profile-photo {
        max-height: 200px;
    }

    .placeholder-content {
        padding: 20px;
    }

    .placeholder-icon {
        font-size: 60px;
    }

    .placeholder-title {
        font-size: 1rem;
    }

    .placeholder-text {
        font-size: 0.9rem;
    }

    .upload-label {
        padding: 15px;
        font-size: 0.9rem;
    }

    .photo-info #profileName {
        font-size: 0.9rem;
    }

    .photo-controls .badge {
        font-size: 0.8rem;
        padding: 6px 12px;
    }
}

@media (max-width: 400px) {
    .main-photo-wrapper {
        min-height: 180px;
        max-height: 200px;
        padding: 10px;
    }

    .placeholder-content {
        padding: 15px;
    }

    .placeholder-icon {
        font-size: 50px;
    }

    .placeholder-title {
        font-size: 0.9rem;
    }
}
</style>

@endsection
