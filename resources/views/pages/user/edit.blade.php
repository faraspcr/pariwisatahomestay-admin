@extends('layouts.app')
@section('content')

{{-- ====================== START MAIN CONTENT ====================== --}}

<!-- Header -->
<div class="page-header">
    <h3 class="page-title">
        <i class="mdi mdi-account-edit text-primary mr-2"></i>
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

<!-- Card Form Edit User -->
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title mb-0">Form Edit User</h4>
            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="mdi mdi-arrow-left mr-1"></i>Kembali ke Data User
            </a>
        </div>

        <form action="{{ route('user.update', $user->id) }}" method="POST" id="userForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <!-- Nama -->
                    <div class="form-group">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $user->name) }}"
                               placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', $user->email) }}"
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
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pemilik" {{ old('role', $user->role) == 'pemilik' ? 'selected' : '' }}>Pemilik Homestay</option>
                            <option value="warga" {{ old('role', $user->role) == 'warga' ? 'selected' : '' }}>Warga</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <!-- Profile Photo - PERBAIKAN UTAMA DI SINI -->
                    <div class="form-group">
                        <label for="profile_photo" class="form-label">Foto Profile</label>

                        <!-- ✅ Current Photo Section -->
                        <div class="mb-3">
                            <p class="mb-1">Foto Saat Ini:</p>
                            <div class="text-center">
                                @if($user->profile_picture)
                                    {{-- Foto Custom --}}
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ $user->profile_photo_url }}"
                                             alt="Profile {{ $user->name }}"
                                             class="rounded-circle border shadow mb-2"
                                             style="width: 120px; height: 120px; object-fit: cover;"
                                             onerror="this.onerror=null; this.src='{{ $user->profile_photo_url }}'">

                                        </span>
                                    </div>
                                    <div class="form-check d-inline-block mt-2">
                                        <input class="form-check-input" type="checkbox"
                                               name="remove_photo"
                                               id="remove_photo" value="1">
                                        <label class="form-check-label text-danger" for="remove_photo">
                                            <i class="mdi mdi-trash-can-outline mr-1"></i> Hapus foto custom
                                        </label>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            <i class="mdi mdi-information-outline mr-1"></i>
                                            Jika dihapus, akan kembali ke avatar default
                                        </small>
                                    </div>
                                @else
                                    {{-- ✅ Default Avatar --}}
                                    <div class="position-relative d-inline-block">
                                        <div class="default-avatar-placeholder rounded-circle border shadow mb-2 d-flex align-items-center justify-content-center mx-auto"
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
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('profile_photo') is-invalid @enderror"
                                   id="profile_photo" name="profile_photo" accept="image/*">
                            <label class="custom-file-label" for="profile_photo" id="profile_photo_label">
                                Pilih file baru...
                            </label>
                        </div>
                        @error('profile_photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: JPG, JPEG, PNG, GIF, WEBP (Maks 2MB)</small>

                        <!-- Preview New Image -->
                        <div class="mt-3" id="imagePreview" style="display: none;">
                            <p class="mb-1">Preview Foto Baru:</p>
                            <img id="previewImage"
                                 src=""
                                 alt="Preview"
                                 class="img-thumbnail rounded-circle"
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password"
                                   placeholder="Kosongkan jika tidak ingin mengubah">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <small class="form-text text-muted">
                            Biarkan kosong jika tidak ingin mengubah password
                        </small>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
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
                            <i class="mdi mdi-content-save mr-1"></i>Simpan Perubahan
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

/* Styling untuk Current Photo */
.rounded-circle.border.shadow {
    border: 2px solid #4e73df;
    box-shadow: 0 2px 4px rgba(78, 115, 223, 0.2);
    transition: all 0.3s ease;
}

.rounded-circle.border.shadow:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(78, 115, 223, 0.3);
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

/* Styling untuk Checkbox Hapus Foto */
.form-check-input:checked {
    background-color: #e74a3b;
    border-color: #e74a3b;
}

.form-check-label {
    cursor: pointer;
    font-size: 14px;
}

/* Badge position */
.position-relative .badge {
    border: 2px solid white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview New Image
    const profilePhotoInput = document.getElementById('profile_photo');
    const profilePhotoLabel = document.getElementById('profile_photo_label');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');
    const removePhotoCheckbox = document.getElementById('remove_photo');

    if (profilePhotoInput) {
        profilePhotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                // Validasi ukuran file (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB');
                    this.value = '';
                    imagePreview.style.display = 'none';
                    profilePhotoLabel.textContent = 'Pilih file baru...';
                    return;
                }

                // Validasi tipe file
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, JPEG, PNG, GIF, atau WEBP.');
                    this.value = '';
                    imagePreview.style.display = 'none';
                    profilePhotoLabel.textContent = 'Pilih file baru...';
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

                // Uncheck remove photo checkbox jika upload foto baru
                if (removePhotoCheckbox) {
                    removePhotoCheckbox.checked = false;
                }
            } else {
                profilePhotoLabel.textContent = 'Pilih file baru...';
                imagePreview.style.display = 'none';
            }
        });
    }

    // Jika checkbox hapus foto dicentang, disable input upload
    if (removePhotoCheckbox) {
        removePhotoCheckbox.addEventListener('change', function() {
            if (this.checked) {
                profilePhotoInput.disabled = true;
                profilePhotoInput.value = '';
                imagePreview.style.display = 'none';
                profilePhotoLabel.textContent = 'Pilih file baru...';

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

            if (password && password !== passwordConfirmation) {
                e.preventDefault();
                alert('Password dan Konfirmasi Password tidak sama!');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="mdi mdi-content-save mr-1"></i>Simpan Perubahan';
                return false;
            }

            return true;
        });
    }
});
</script>

@endsection
