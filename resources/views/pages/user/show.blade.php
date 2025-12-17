@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

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
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Detail Informasi User</h4>
                    <div class="btn-group">
                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="mdi mdi-arrow-left mr-1"></i>Kembali
                        </a>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-pencil mr-1"></i>Edit
                        </a>
                    </div>
                </div>

                <div class="row">
                    <!-- Kolom Kiri: Foto & Info Dasar -->
                    <div class="col-md-4">
                        <div class="card border-primary">
                            <div class="card-body text-center">
                                {{-- ✅ TAMPILKAN FOTO --}}
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
                            </div>
                        </div>

                        <!-- Status Info -->
                        <div class="card mt-3">
                            <div class="card-body">
                                <h6 class="card-title mb-3">
                                    <i class="mdi mdi-information-outline text-info mr-2"></i>Status
                                </h6>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Verifikasi Email</small>
                                        @if($user->email_verified_at)
                                            <span class="badge badge-success">Terverifikasi</span>
                                        @else
                                            <span class="badge badge-secondary">Belum Verifikasi</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Avatar</small>
                                        @if($user->profile_picture)
                                            <span class="badge badge-success">Custom</span>
                                        @else
                                            <span class="badge badge-secondary">Default</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Detail Lengkap -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title mb-4">
                                    <i class="mdi mdi-account-details text-primary mr-2"></i>Informasi Detail
                                </h6>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="text-muted">Nama Lengkap</label>
                                        <p class="font-weight-bold">{{ $user->name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted">Email</label>
                                        <p class="font-weight-bold">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="text-muted">Role</label>
                                        <p>
                                            @if($user->role == 'admin')
                                                <span class="badge badge-danger">Admin</span>
                                            @elseif($user->role == 'pemilik')
                                                <span class="badge badge-warning">Pemilik Homestay</span>
                                            @else
                                                <span class="badge badge-primary">Warga</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted">Bergabung Sejak</label>
                                        <p class="font-weight-bold">
                                            {{ $user->created_at->format('d F Y') }}
                                            <small class="text-muted d-block">
                                                {{ $user->created_at->diffForHumans() }}
                                            </small>
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="text-muted">Terakhir Update</label>
                                        <p class="font-weight-bold">
                                            {{ $user->updated_at->format('d F Y H:i') }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted">Foto Profil</label>
                                        <p>
                                            @if($user->profile_picture)
                                                <div class="d-flex align-items-center">
                                                    <code class="bg-light p-1 rounded">{{ $user->profile_picture }}</code>
                                                    <span class="badge bg-success ml-2">
                                                        <i class="mdi mdi-check"></i> Custom
                                                    </span>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center">
                                                    <span class="text-muted">- Default Avatar -</span>
                                                    <span class="badge bg-secondary ml-2">
                                                        <i class="mdi mdi-account"></i> Avatar Default
                                                    </span>
                                                </div>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Timeline -->
                                <div class="mt-4">
                                    <h6 class="mb-3">
                                        <i class="mdi mdi-timeline-text-outline text-primary mr-2"></i>Aktivitas
                                    </h6>
                                    <div class="timeline">
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-primary"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Akun Dibuat</h6>
                                                <small class="text-muted">{{ $user->created_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-success"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Terakhir Update</h6>
                                                <small class="text-muted">{{ $user->updated_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                                            <i class="mdi mdi-pencil mr-1"></i>Edit Data
                                        </a>
                                        <a href="mailto:{{ $user->email }}" class="btn btn-info">
                                            <i class="mdi mdi-email mr-1"></i>Kirim Email
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin menghapus user {{ $user->name }}?')">
                                                <i class="mdi mdi-delete mr-1"></i>Hapus User
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
/* Timeline Styling */
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -30px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    top: 5px;
}

.timeline-content {
    padding-bottom: 10px;
    border-bottom: 1px solid #e9ecef;
}

.timeline-content:last-child {
    border-bottom: none;
}

/* Card Styling */
.card {
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
}

.card-title {
    color: #4e73df;
    font-weight: 600;
}

/* Badge Styling */
.badge-danger {
    background: linear-gradient(45deg, #dc3545, #c82333);
}
.badge-warning {
    background: linear-gradient(45deg, #ffc107, #e0a800);
    color: #212529;
}
.badge-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}
.badge-success {
    background: linear-gradient(45deg, #28a745, #1e7e34);
}
.badge-secondary {
    background: linear-gradient(45deg, #6c757d, #545b62);
}
.badge-info {
    background: linear-gradient(45deg, #17a2b8, #138496);
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

.avatar-icon svg {
    opacity: 0.7;
}

.avatar-icon svg:hover {
    opacity: 1;
}
</style>

@endsection
