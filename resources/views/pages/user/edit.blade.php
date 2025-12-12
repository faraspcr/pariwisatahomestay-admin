@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

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
                                <small class="text-muted">Format: JPG, PNG, GIF (Maks 2MB)</small>

                                <!-- Show current profile photo -->
                                <div class="mt-3">
                                    <p class="mb-1">Foto Saat Ini:</p>

                                    @if($user->profile_photo)
                                        @php
                                            // Cek apakah file ada di storage
                                            $fileExists = Storage::disk('public')->exists('profile_user/' . $user->profile_photo);
                                            $currentPhotoUrl = $fileExists ? Storage::url('profile_user/' . $user->profile_photo) : '#';
                                        @endphp

                                        @if($fileExists)
                                            <div class="d-flex align-items-start">
                                                <img src="{{ $currentPhotoUrl }}"
                                                     alt="Profile Photo"
                                                     class="img-thumbnail current-photo"
                                                     style="width: 120px; height: 120px; object-fit: cover; margin-right: 15px;">
                                                <div>
                                                    <small class="text-muted d-block mb-2">Nama file: {{ $user->profile_photo }}</small>
                                                    <button type="button" class="btn btn-sm btn-outline-danger" id="removePhotoBtn">
                                                        <i class="mdi mdi-delete mr-1"></i>Hapus Foto
                                                    </button>
                                                    <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-warning p-2">
                                                <small>
                                                    <i class="mdi mdi-alert-circle-outline mr-1"></i>
                                                    File gambar tidak ditemukan di server
                                                </small>
                                            </div>
                                            <div class="text-center bg-light p-3 rounded">
                                                <i class="mdi mdi-account-circle" style="font-size: 48px; color: #ccc;"></i>
                                                <p class="text-muted mb-0">Gambar tidak tersedia</p>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-center bg-light p-3 rounded">
                                            <i class="mdi mdi-account-circle" style="font-size: 48px; color: #ccc;"></i>
                                            <p class="text-muted mb-0">Belum ada foto profile</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Preview New Image -->
                                <div class="mt-3" id="imagePreview" style="display: none;">
                                    <p class="mb-1">Preview Foto Baru:</p>
                                    <img id="previewImage"
                                         src=""
                                         alt="Preview"
                                         class="img-thumbnail"
                                         style="width: 120px; height: 120px; object-fit: cover;">
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

        {{-- ====================== END MAIN CONTENT ====================== --}}
    </div>
</div>

<style>
/* Styling untuk Form */
.custom-file-label::after {
    content: "Browse";
}

/* Styling untuk Current Photo */
.current-photo {
    border: 2px solid #4e73df;
    box-shadow: 0 2px 4px rgba(78, 115, 223, 0.2);
    transition: all 0.3s ease;
}

.current-photo:hover {
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

/* Styling untuk Remove Photo Button */
#removePhotoBtn {
    transition: all 0.3s ease;
}

#removePhotoBtn:hover {
    background-color: #dc3545;
    color: white;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview New Image
    const profilePhotoInput = document.getElementById('profile_photo');
    const profilePhotoLabel = document.getElementById('profile_photo_label');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');

    if (profilePhotoInput) {
        profilePhotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
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
                profilePhotoLabel.textContent = 'Pilih file baru...';
                imagePreview.style.display = 'none';
            }
        });
    }

    // Remove Photo Button
    const removePhotoBtn = document.getElementById('removePhotoBtn');
    const removePhotoInput = document.getElementById('remove_photo');

    if (removePhotoBtn) {
        removePhotoBtn.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus foto profil ini?')) {
                // Hide current photo
                const currentPhoto = document.querySelector('.current-photo');
                if (currentPhoto) {
                    currentPhoto.style.opacity = '0.5';
                    currentPhoto.style.filter = 'grayscale(100%)';
                }

                // Set remove flag
                removePhotoInput.value = '1';

                // Change button text and disable
                this.innerHTML = '<i class="mdi mdi-check mr-1"></i>Foto akan dihapus';
                this.classList.remove('btn-outline-danger');
                this.classList.add('btn-danger');
                this.disabled = true;

                // Show info message
                const warningDiv = document.createElement('div');
                warningDiv.className = 'alert alert-warning mt-2 p-2';
                warningDiv.innerHTML = '<small><i class="mdi mdi-information-outline mr-1"></i>Foto akan dihapus saat data disimpan</small>';
                this.parentNode.appendChild(warningDiv);
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
            }
        });
    }
});
</script>

@endsection
