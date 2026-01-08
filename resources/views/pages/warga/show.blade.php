@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle-outline mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="mdi mdi-account-circle mr-2"></i>Detail Data Warga
                        </h4>
                        <div>
                            <a href="{{ route('admin.warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm">
                                <i class="mdi mdi-pencil mr-1"></i> Edit
                            </a>
                            <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary btn-sm">
                                <i class="mdi mdi-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Info Warga -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="row">
                                <!-- Nama -->
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted">Nama Lengkap</label>
                                    <h5 class="font-weight-bold">{{ $warga->nama }}</h5>
                                </div>

                                <!-- No KTP -->
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted">No. KTP</label>
                                    <h5 class="font-weight-bold text-primary">{{ $warga->no_ktp }}</h5>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted">Jenis Kelamin</label>
                                    <div>
                                        @if($warga->jenis_kelamin == 'L')
                                            <span class="badge badge-gender-male py-2 px-3">
                                                <i class="mdi mdi-gender-male mr-1"></i>Laki-laki
                                            </span>
                                        @else
                                            <span class="badge badge-gender-female py-2 px-3">
                                                <i class="mdi mdi-gender-female mr-1"></i>Perempuan
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Agama -->
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted">Agama</label>
                                    <div>
                                        <span class="badge badge-religion py-2 px-3">
                                            <i class="mdi mdi-church mr-1"></i>{{ $warga->agama }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Pekerjaan -->
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted">Pekerjaan</label>
                                    <div>
                                        <span class="badge badge-job py-2 px-3">
                                            <i class="mdi mdi-briefcase mr-1"></i>{{ $warga->pekerjaan }}
                                        </span>
                                    </div>
                                </div>

                                <!-- ID Warga -->
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted">ID Warga</label>
                                    <h5 class="font-weight-bold">{{ $warga->warga_id }}</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Foto (sisi kanan) -->
                        <div class="col-md-4 text-center">
                            @if($warga->foto_profil)
                                <img src="{{ asset('storage/' . $warga->foto_profil) }}"
                                     alt="Foto Profil"
                                     class="img-thumbnail rounded-circle mb-3"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="mx-auto bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                     style="width: 150px; height: 150px;">
                                    <i class="mdi mdi-account-circle" style="font-size: 100px; color: #ccc;"></i>
                                </div>
                            @endif
                            <p class="text-muted">
                                <i class="mdi mdi-image mr-1"></i>
                                {{ $warga->foto_profil ? 'Foto Profil' : 'Tidak ada foto' }}
                            </p>
                        </div>
                    </div>

                    <hr>

                    <!-- Kontak & Alamat -->
                    <div class="row">
                        <!-- Telepon -->
                        <div class="col-md-4 mb-3">
                            <label class="text-muted">
                                <i class="mdi mdi-phone mr-1"></i> Telepon
                            </label>
                            <h5 class="font-weight-bold">{{ $warga->telp }}</h5>
                        </div>

                        <!-- Email -->
                        <div class="col-md-4 mb-3">
                            <label class="text-muted">
                                <i class="mdi mdi-email mr-1"></i> Email
                            </label>
                            <h5 class="font-weight-bold">{{ $warga->email ?? '-' }}</h5>
                        </div>

                        <!-- Alamat -->
                        <div class="col-md-4 mb-3">
                            <label class="text-muted">
                                <i class="mdi mdi-map-marker mr-1"></i> Alamat
                            </label>
                            <h5 class="font-weight-bold">{{ $warga->alamat }}</h5>
                        </div>
                    </div>

                    <hr>

                    <!-- Timestamp -->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-muted">
                                <i class="mdi mdi-calendar-plus mr-1"></i> Dibuat Tanggal
                            </label>
                            <p class="font-weight-bold">
                                {{ $warga->created_at->format('d F Y H:i') }}
                                <br>
                                <small class="text-muted">
                                    <i class="mdi mdi-clock-outline mr-1"></i>
                                    {{ $warga->created_at->diffForHumans() }}
                                </small>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <label class="text-muted">
                                <i class="mdi mdi-calendar-edit mr-1"></i> Diupdate Tanggal
                            </label>
                            <p class="font-weight-bold">
                                {{ $warga->updated_at->format('d F Y H:i') }}
                                <br>
                                <small class="text-muted">
                                    <i class="mdi mdi-clock-outline mr-1"></i>
                                    {{ $warga->updated_at->diffForHumans() }}
                                </small>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('admin.warga.destroy', $warga->warga_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-danger"
                                    onclick="return confirm('Yakin hapus data {{ $warga->nama }}?')">
                                <i class="mdi mdi-delete mr-1"></i> Hapus Data
                            </button>
                        </form>

                        <div>
                            <span class="text-muted mr-3">
                                <i class="mdi mdi-database-outline mr-1"></i>
                                ID: {{ $warga->warga_id }}
                            </span>
                            <span class="badge badge-success">
                                <i class="mdi mdi-check-circle mr-1"></i> Aktif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Badge Styling (sama dengan index) */
.badge-gender-male {
    background-color: #36b9cc;
    color: white;
    font-size: 14px;
}

.badge-gender-female {
    background-color: #e83e8c;
    color: white;
    font-size: 14px;
}

.badge-religion {
    background-color: #1cc88a;
    color: white;
    font-size: 14px;
}

.badge-job {
    background-color: #f6c23e;
    color: #333;
    font-size: 14px;
}

/* Card */
.card {
    border: 1px solid #e3e6f0;
    border-radius: 8px;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
    padding: 1rem 1.25rem;
}

.card-title {
    color: #5a5c69;
    font-weight: 600;
}

/* Label */
label.text-muted {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
    display: block;
}

/* Responsive */
@media (max-width: 768px) {
    .card-body .row > div {
        margin-bottom: 1rem;
    }

    .card-footer .d-flex {
        flex-direction: column;
        gap: 1rem;
    }

    .card-footer .d-flex > * {
        width: 100%;
        text-align: center;
    }
}
</style>
@endsection
