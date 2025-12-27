@extends('layouts.app')
@section('content')

{{-- ====================== START MAIN CONTENT ====================== --}}

<!-- Header -->
<div class="page-header">
    <h3 class="page-title">
        <i class="mdi mdi-account-eye text-primary mr-2"></i>
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

<!-- Alert -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-circle-outline mr-2"></i>
        <strong>Sukses!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Card Detail User -->
<div class="row">
    <!-- Foto Profil User - STRUKTUR SAMA DENGAN SHOW DESTINASI -->
    <div class="col-lg-5 mb-4">
        <div class="card card-detail">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="mdi mdi-account mr-2"></i>Foto Profil User</h5>
            </div>
            <div class="card-body">
                <div class="main-photo-container mb-4">
                    <div class="main-photo-wrapper placeholder-wrapper">
                        @if($user->profile_photo_url)
                            <!-- Jika ada foto profil -->
                            <img src="{{ $user->profile_photo_url }}"
                                 id="currentProfilePhoto"
                                 class="main-photo profile-photo"
                                 alt="Foto Profil {{ $user->name }}"
                                 onerror="handleProfileImageError(this)">
                        @else
                            <!-- Placeholder ketika tidak ada foto (SESUAI KODINGAN ANDA) -->
                            <div class="placeholder-content">
                                <div class="avatar-icon">
                                    <i class="mdi mdi-account-circle placeholder-icon"></i>
                                </div>
                                <h4 class="placeholder-title">Avatar Default</h4>
                                <p class="placeholder-text">User belum mengupload foto profil</p>
                                <div class="placeholder-actions">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                        <i class="mdi mdi-camera mr-1"></i> Upload Foto
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="photo-info text-center mt-2">
                        <small id="profileName" class="text-truncate d-block">{{ $user->name }}</small>
                        <div class="photo-controls mt-2">
                            @if($user->profile_photo_url && $user->profile_picture)
                                <span class="badge bg-success">Foto Custom</span>
                            @else
                                <span class="badge bg-secondary">Avatar Default</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Foto Info Detail -->
                <div class="detail-info">
                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="mdi mdi-account text-primary"></i>
                            <span>Jenis Foto</span>
                        </div>
                        <div class="detail-value">
                            @if($user->profile_photo_url && $user->profile_picture)
                                <span class="badge-hijau">Foto Profil Custom</span>
                            @else
                                <span class="badge-biru">Avatar Default</span>
                            @endif
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="mdi mdi-update text-primary"></i>
                            <span>Terakhir Update</span>
                        </div>
                        <div class="detail-value">{{ $user->updated_at->format('d F Y H:i') }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="mdi mdi-identifier text-primary"></i>
                            <span>User ID</span>
                        </div>
                        <div class="detail-value">
                            <span class="badge bg-secondary">#{{ $user->id }}</span>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi Foto -->
                <div class="d-grid gap-2 d-md-flex mt-4 pt-3 border-top">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning me-2 btn-action">
                        <i class="mdi mdi-camera mr-1"></i> Ubah Foto
                    </a>
                    @if($user->profile_photo_url && $user->profile_picture)
                        <button type="button" class="btn btn-info btn-action" onclick="downloadProfilePhoto()">
                            <i class="mdi mdi-download mr-1"></i> Download
                        </button>
                    @endif
                    <button type="button" class="btn btn-primary btn-action" onclick="openFullscreenProfile()">
                        <i class="mdi mdi-fullscreen mr-1"></i> Fullscreen
                    </button>
                </div>
            </div>
        </div>

        <!-- Status Info Card -->
        <div class="card mt-3">
            <div class="card-body">
                <h6 class="card-title mb-3">
                    <i class="mdi mdi-information-outline text-info mr-2"></i>Status Akun
                </h6>
                <div class="detail-info">
                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="mdi mdi-email-check text-primary"></i>
                            <span>Verifikasi Email</span>
                        </div>
                        <div class="detail-value">
                            @if($user->email_verified_at)
                                <span class="badge-hijau">
                                    <i class="mdi mdi-check mr-1"></i> Terverifikasi
                                </span>
                            @else
                                <span class="badge-orange">
                                    <i class="mdi mdi-clock-outline mr-1"></i> Belum Verifikasi
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="mdi mdi-account text-primary"></i>
                            <span>Status Foto</span>
                        </div>
                        <div class="detail-value">
                            @if($user->profile_picture)
                                <span class="badge-hijau">Foto Custom</span>
                            @else
                                <span class="badge-biru">Avatar Default</span>
                            @endif
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="mdi mdi-calendar text-primary"></i>
                            <span>Bergabung</span>
                        </div>
                        <div class="detail-value">
                            {{ $user->created_at->format('d F Y') }}
                            <small class="text-muted d-block">
                                ({{ $user->created_at->diffForHumans() }})
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Detail User - STRUKTUR SAMA DENGAN SHOW DESTINASI -->
    <div class="col-lg-7 mb-4">
        <div class="card border-0 shadow card-gallery">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="mdi mdi-account-details mr-2"></i>Informasi Detail User</h5>
            </div>
            <div class="card-body">
                <div class="detail-info">
                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="mdi mdi-account text-primary"></i>
                            <span>Nama Lengkap</span>
                        </div>
                        <div class="detail-value">{{ $user->name }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="mdi mdi-email text-primary"></i>
                            <span>Email</span>
                        </div>
                        <div class="detail-value">
                            <div class="d-flex align-items-center">
                                {{ $user->email }}
                                @if($user->email_verified_at)
                                    <span class="badge-hijau ml-2">
                                        <i class="mdi mdi-check mr-1"></i> Verified
                                    </span>
                                @endif
                            </div>
                        </div>
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
                                <span class="badge-orange">Pemilik Homestay</span>
                            @else
                                <span class="badge-hijau">Warga</span>
                            @endif
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="mdi mdi-camera text-primary"></i>
                            <span>Status Foto Profil</span>
                        </div>
                        <div class="detail-value">
                            @if($user->profile_picture)
                                <div class="d-flex align-items-center">
                                    <code class="bg-light p-2 rounded mr-2">{{ $user->profile_picture }}</code>
                                    <span class="badge-hijau">Foto Custom</span>
                                </div>
                            @else
                                <div class="d-flex align-items-center">
                                    <span class="text-muted mr-2">Default Avatar</span>
                                    <span class="badge-biru">Sistem</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="mdi mdi-calendar-plus text-primary"></i>
                            <span>Dibuat Tanggal</span>
                        </div>
                        <div class="detail-value">
                            {{ $user->created_at->format('d F Y H:i') }}
                            <small class="text-muted d-block">
                                {{ $user->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="mdi mdi-update text-primary"></i>
                            <span>Diupdate Tanggal</span>
                        </div>
                        <div class="detail-value">
                            {{ $user->updated_at->format('d F Y H:i') }}
                            <small class="text-muted d-block">
                                {{ $user->updated_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <h6 class="border-bottom pb-2 mb-3 mt-4">
                    <i class="mdi mdi-timeline-text-outline text-primary mr-2"></i>Timeline Aktivitas
                </h6>

                <div class="timeline-container">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary">
                            <i class="mdi mdi-account-plus"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Akun Dibuat</h6>
                            <small class="text-muted">{{ $user->created_at->format('d M Y, H:i') }}</small>
                            <p class="mb-0 text-muted">User terdaftar ke dalam sistem</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-marker bg-success">
                            <i class="mdi mdi-update"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Terakhir Update</h6>
                            <small class="text-muted">{{ $user->updated_at->format('d M Y, H:i') }}</small>
                            <p class="mb-0 text-muted">Data terakhir kali diperbarui</p>
                        </div>
                    </div>

                    @if($user->email_verified_at)
                    <div class="timeline-item">
                        <div class="timeline-marker bg-info">
                            <i class="mdi mdi-email-check"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Email Terverifikasi</h6>
                            <small class="text-muted">{{ $user->email_verified_at->format('d M Y, H:i') }}</small>
                            <p class="mb-0 text-muted">Email berhasil diverifikasi</p>
                        </div>
                    </div>
                    @endif

                    @if($user->profile_picture)
                    <div class="timeline-item">
                        <div class="timeline-marker bg-warning">
                            <i class="mdi mdi-camera"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Foto Profil Diupload</h6>
                            <small class="text-muted">{{ $user->updated_at->format('d M Y, H:i') }}</small>
                            <p class="mb-0 text-muted">Foto profil custom diupload</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2 d-md-flex mt-4 pt-3 border-top">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning me-2 btn-action">
                        <i class="mdi mdi-pencil mr-1"></i> Edit Data
                    </a>
                    <a href="mailto:{{ $user->email }}" class="btn btn-info me-2 btn-action">
                        <i class="mdi mdi-email mr-1"></i> Kirim Email
                    </a>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-action"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?')">
                            <i class="mdi mdi-delete mr-1"></i> Hapus User
                        </button>
                    </form>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary ms-auto btn-action">
                        <i class="mdi mdi-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ====================== MODAL FULLSCREEN PROFILE PHOTO ====================== --}}
<div class="modal fade" id="profileFullscreenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h6 class="modal-title text-white" id="profileFullscreenTitle">Foto Profil {{ $user->name }}</h6>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 d-flex align-items-center justify-content-center" style="min-height: 70vh;">
                <div class="image-container" style="width: 100%; height: 100%;">
                    @if($user->profile_photo_url)
                        <img id="fullscreenProfileImage" src="{{ $user->profile_photo_url }}"
                             class="img-fluid rounded-circle"
                             style="max-width: 400px; max-height: 400px; width: auto; height: auto; display: block; margin: 0 auto;"
                             onerror="handleFullscreenProfileError(this)"
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

    // ============ FUNGSI HANDLE ERROR GAMBAR ============
    function handleProfileImageError(img) {
        console.error('Gagal memuat foto profil:', profilePhotoUrl);

        // Ganti dengan placeholder avatar default
        const placeholderSVG = `
            <svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" viewBox="0 0 400 400">
                <circle cx="200" cy="200" r="200" fill="#f8f9fa"/>
                <circle cx="200" cy="150" r="80" fill="#dee2e6"/>
                <path d="M120 200 L280 200 L280 280 L120 280 Z" fill="#adb5bd" opacity="0.5"/>
                <text x="200" y="350" font-family="Arial" font-size="24" fill="#6c757d" text-anchor="middle">
                    ${userName}
                </text>
                <text x="200" y="380" font-family="Arial" font-size="16" fill="#adb5bd" text-anchor="middle">
                    Foto tidak tersedia
                </text>
            </svg>`;

        img.src = 'data:image/svg+xml;utf8,' + encodeURIComponent(placeholderSVG);
        img.style.cursor = 'default';

        // Update badge menjadi default
        const badgeElement = document.querySelector('.photo-controls .badge');
        if (badgeElement) {
            badgeElement.className = 'badge bg-secondary';
            badgeElement.textContent = 'Avatar Default';
        }
    }

    function handleFullscreenProfileError(img) {
        console.error('Gagal memuat gambar fullscreen');

        const placeholderSVG = `
            <svg xmlns="http://www.w3.org/2000/svg" width="600" height="600" viewBox="0 0 600 600">
                <circle cx="300" cy="300" r="300" fill="#343a40"/>
                <circle cx="300" cy="200" r="120" fill="#495057"/>
                <path d="M180 300 L420 300 L420 420 L180 420 Z" fill="#6c757d" opacity="0.5"/>
                <text x="300" y="520" font-family="Arial" font-size="28" fill="#dee2e6" text-anchor="middle">
                    ${userName}
                </text>
                <text x="300" y="560" font-family="Arial" font-size="18" fill="#adb5bd" text-anchor="middle">
                    Foto profil tidak dapat ditampilkan
                </text>
            </svg>`;

        img.src = 'data:image/svg+xml;utf8,' + encodeURIComponent(placeholderSVG);
        img.classList.remove('rounded-circle');
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

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Esc untuk keluar dari fullscreen
            if (e.key === 'Escape') {
                if ($('#profileFullscreenModal').hasClass('show')) {
                    $('#profileFullscreenModal').modal('hide');
                }
            }

            // F untuk fullscreen foto profil
            if (e.key === 'f' && !e.target.matches('input, textarea, button, a')) {
                e.preventDefault();
                openFullscreenProfile();
            }

            // E untuk edit
            if (e.key === 'e' && !e.target.matches('input, textarea, button, a')) {
                e.preventDefault();
                window.location.href = "{{ route('user.edit', $user->id) }}";
            }
        });
    });
</script>

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

.badge-secondary {
    background: linear-gradient(45deg, #6C757D, #868E96);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
}

/* ==================== PLACEHOLDER STYLES (SESUAI KODINGAN ANDA) ==================== */
.placeholder-wrapper {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 400px;
    max-height: 450px;
    border: 3px dashed #dee2e6;
    border-radius: 12px;
    transition: all 0.3s ease;
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

.avatar-icon {
    margin-bottom: 25px;
}

.placeholder-icon {
    font-size: 150px;
    color: #adb5bd;
    display: block;
    transition: all 0.5s ease;
    opacity: 0.6;
}

.placeholder-wrapper:hover .placeholder-icon {
    color: #4e73df;
    transform: scale(1.1);
    opacity: 0.8;
}

.placeholder-title {
    color: #495057;
    font-weight: 600;
    font-size: 1.8rem;
    margin-bottom: 15px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
}

.placeholder-text {
    color: #6c757d;
    font-size: 1.1rem;
    margin-bottom: 30px;
    line-height: 1.6;
}

.placeholder-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
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

/* ==================== PROFILE PHOTO STYLES ==================== */
.profile-photo {
    width: 100%;
    max-width: 350px;
    height: 350px;
    object-fit: cover;
    border-radius: 12px;
    border: 4px solid #4e73df;
    box-shadow: 0 8px 25px rgba(78, 115, 223, 0.3);
    transition: all 0.3s ease;
}

.profile-photo:hover {
    transform: scale(1.03);
    box-shadow: 0 12px 30px rgba(78, 115, 223, 0.4);
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
    min-height: 400px;
    max-height: 450px;
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

.photo-info {
    background: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-top: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
}

.photo-info #profileName {
    font-size: 1.2rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 10px;
}

.photo-controls .badge {
    font-size: 0.9rem;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 600;
}

/* ==================== CARD GALLERY STYLES ==================== */
.card-gallery {
    border-radius: 15px;
    overflow: hidden;
}

/* ==================== TIMELINE STYLES ==================== */
.timeline-container {
    position: relative;
    padding-left: 40px;
}

.timeline-item {
    position: relative;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e9ecef;
}

.timeline-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -40px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}

.timeline-content {
    padding-left: 10px;
}

.timeline-content h6 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 5px;
}

.timeline-content p {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 5px;
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
        min-height: 350px;
        max-height: 400px;
    }

    .profile-photo {
        max-width: 300px;
        height: 300px;
    }

    .placeholder-wrapper {
        min-height: 350px;
        max-height: 400px;
    }

    .placeholder-icon {
        font-size: 120px;
    }

    .placeholder-title {
        font-size: 1.6rem;
    }
}

@media (max-width: 992px) {
    .card-detail, .card-gallery {
        margin-bottom: 25px;
    }

    .main-photo-wrapper {
        min-height: 300px;
        max-height: 350px;
    }

    .profile-photo {
        max-width: 250px;
        height: 250px;
    }

    .placeholder-wrapper {
        min-height: 300px;
        max-height: 350px;
    }

    .placeholder-content {
        padding: 30px;
    }

    .placeholder-icon {
        font-size: 100px;
    }

    .placeholder-title {
        font-size: 1.4rem;
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
        min-height: 250px;
        max-height: 300px;
    }

    .profile-photo {
        max-width: 200px;
        height: 200px;
    }

    .placeholder-wrapper {
        min-height: 250px;
        max-height: 300px;
    }

    .placeholder-content {
        padding: 20px;
    }

    .placeholder-icon {
        font-size: 80px;
    }

    .placeholder-title {
        font-size: 1.3rem;
    }

    .placeholder-text {
        font-size: 1rem;
    }

    .timeline-container {
        padding-left: 30px;
    }

    .timeline-marker {
        left: -30px;
        width: 26px;
        height: 26px;
        font-size: 14px;
    }

    .d-grid {
        flex-direction: column;
        gap: 10px;
    }

    .btn-action {
        width: 100%;
        margin-bottom: 5px;
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
        max-height: 250px;
    }

    .profile-photo {
        max-width: 150px;
        height: 150px;
    }

    .placeholder-wrapper {
        min-height: 200px;
        max-height: 250px;
    }

    .placeholder-content {
        padding: 15px;
    }

    .placeholder-icon {
        font-size: 60px;
    }

    .placeholder-title {
        font-size: 1.2rem;
    }

    .placeholder-text {
        font-size: 0.95rem;
    }

    .placeholder-actions {
        flex-direction: column;
        align-items: center;
    }

    .placeholder-actions .btn {
        width: 200px;
        max-width: 100%;
    }

    .photo-info #profileName {
        font-size: 1rem;
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

    .placeholder-wrapper {
        min-height: 180px;
        max-height: 200px;
    }

    .placeholder-icon {
        font-size: 50px;
    }

    .placeholder-title {
        font-size: 1.1rem;
    }

    .placeholder-text {
        font-size: 0.9rem;
    }
}
</style>

@endsection
