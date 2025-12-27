@extends('layouts.app')
@section('content')

{{-- ====================== START MAIN CONTENT ====================== --}}

<!-- Header -->
<div class="page-header">
    <h3 class="page-title">
        <i class="mdi mdi-account-plus text-primary mr-2"></i>
        Tambah User
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Data User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
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

<!-- Card Form Tambah User -->
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title mb-0">Form Tambah User</h4>
            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="mdi mdi-arrow-left mr-1"></i>Kembali ke Data User
            </a>
        </div>

        <form action="{{ route('user.store') }}" method="POST" id="userForm" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <!-- Nama -->
                    <div class="form-group">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}"
                               placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}"
                               placeholder="contoh: user@email.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- ROLE - 3 PILIHAN -->
                    <div class="form-group">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pemilik" {{ old('role') == 'pemilik' ? 'selected' : '' }}>Pemilik Homestay</option>
                            <option value="warga" {{ old('role') == 'warga' ? 'selected' : '' }}>Warga</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <!-- ✅ Profile Photo dengan Info Default Avatar -->
                    <div class="form-group">
                        <label for="profile_photo" class="form-label">Foto Profile</label>

                        <!-- Info Default Avatar -->
                        <div class="mb-3">
                            <div class="alert alert-info p-2">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-information-outline mr-2"></i>
                                    <div>
                                        <small>
                                            <strong>Default Avatar:</strong> Jika tidak upload foto, akan digunakan avatar default
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <!-- Default Avatar SVG -->
                                <div class="default-avatar-placeholder rounded-circle border d-inline-flex align-items-center justify-content-center mx-auto"
                                     style="width: 80px; height: 80px; background-color: #f8f9fa; border: 2px dashed #dee2e6 !important;">
                                    <svg width="40" height="40" viewBox="0 0 40 40">
                                        <!-- Kepala -->
                                        <circle cx="20" cy="15" r="8" fill="none" stroke="#6c757d" stroke-width="2"/>
                                        <!-- Badan -->
                                        <ellipse cx="20" cy="30" rx="10" ry="8" fill="none" stroke="#6c757d" stroke-width="2"/>
                                    </svg>
                                </div>
                                <p class="text-muted mb-0 mt-2">Avatar default</p>
                            </div>
                        </div>

                        <!-- Upload Foto -->
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('profile_photo') is-invalid @enderror"
                                   id="profile_photo" name="profile_photo" accept="image/*">
                            <label class="custom-file-label" for="profile_photo" id="profile_photo_label">
                                Pilih file...
                            </label>
                        </div>
                        @error('profile_photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: JPG, JPEG, PNG, GIF, WEBP (Maks 2MB)</small>

                        <!-- Preview Image -->
                        <div class="mt-3" id="imagePreview" style="display: none;">
                            <p class="mb-1">Preview Foto:</p>
                            <img id="previewImage"
                                 src=""
                                 alt="Preview"
                                 class="img-thumbnail rounded-circle"
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password"
                                   placeholder="Minimal 8 karakter" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                   id="password_confirmation" name="password_confirmation"
                                   placeholder="Ulangi password" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
                            <i class="mdi mdi-arrow-left mr-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="mdi mdi-content-save mr-1"></i>Simpan User
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
/* Styling untuk Form */
.custom-file-label::after {
    content: "Browse";
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

/* Styling untuk Preview Image */
#previewImage {
    border: 2px solid #28a745;
    border-radius: 8px;
    transition: all 0.3s ease;
}

#previewImage:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(40, 167, 69, 0.2);
}

/* Styling untuk Toggle Password Button */
#togglePassword, #togglePasswordConfirmation {
    border: 1px solid #ced4da;
}

#togglePassword:hover, #togglePasswordConfirmation:hover {
    background-color: #e9ecef;
    border-color: #adb5bd;
}

/* Alert info */
.alert-info {
    background-color: #e8f4fc;
    border-color: #b6e0fe;
    color: #2c3e50;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview Image
    const profilePhotoInput = document.getElementById('profile_photo');
    const profilePhotoLabel = document.getElementById('profile_photo_label');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');

    if (profilePhotoInput) {
        profilePhotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                // Validasi ukuran file (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB');
                    this.value = '';
                    imagePreview.style.display = 'none';
                    profilePhotoLabel.textContent = 'Pilih file...';
                    return;
                }

                // Validasi tipe file
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, JPEG, PNG, GIF, atau WEBP.');
                    this.value = '';
                    imagePreview.style.display = 'none';
                    profilePhotoLabel.textContent = 'Pilih file...';
                    return;
                }

                // Update label
                profilePhotoLabel.textContent = file.name;

                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                profilePhotoLabel.textContent = 'Pilih file...';
                imagePreview.style.display = 'none';
            }
        });
    }

    // Toggle Password Visibility
    const togglePassword = document.getElementById('togglePassword');
    const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');

    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('mdi-eye');
            this.querySelector('i').classList.toggle('mdi-eye-off');
        });
    }

    if (togglePasswordConfirmation) {
        togglePasswordConfirmation.addEventListener('click', function() {
            const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('mdi-eye');
            this.querySelector('i').classList.toggle('mdi-eye-off');
        });
    }

    // Form Validation
    const form = document.getElementById('userForm');
    const submitBtn = document.getElementById('submitBtn');

    if (form) {
        form.addEventListener('submit', function(e) {
            // Disable submit button to prevent double submission
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-1"></i>Menyimpan...';

            // Password confirmation check
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password !== passwordConfirmation) {
                e.preventDefault();
                alert('Password dan Konfirmasi Password tidak sama!');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="mdi mdi-content-save mr-1"></i>Simpan User';
                return false;
            }

            return true;
        });
    }
});
</script>

@endsection
