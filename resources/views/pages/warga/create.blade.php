@extends('layouts.app')

@section('content')

{{-- ====================== START MAIN CONTENT ====================== --}}

<!-- Header -->
<div class="page-header">
    <h3 class="page-title">
        <i class="mdi mdi-account-plus text-primary mr-2"></i>
        Tambah Data Warga
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('warga.index') }}">Data Warga</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
</div>

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

<!-- Card Form Tambah Warga -->
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title mb-0">Form Tambah Data Warga</h4>
            <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="mdi mdi-arrow-left mr-1"></i>Kembali ke Data Warga
            </a>
        </div>

        <form action="{{ route('warga.store') }}" method="POST" id="wargaForm">
            @csrf

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <!-- No KTP -->
                    <div class="form-group">
                        <label for="no_ktp" class="form-label">No KTP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror"
                               id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}"
                               placeholder="Masukkan 16 digit No KTP" maxlength="16">
                        @error('no_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                               id="nama" name="nama" value="{{ old('nama') }}"
                               placeholder="Masukkan nama lengkap">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                id="jenis_kelamin" name="jenis_kelamin">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <!-- Agama -->
                    <div class="form-group">
                        <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                        <select class="form-control @error('agama') is-invalid @enderror"
                                id="agama" name="agama">
                            <option value="">-- Pilih Agama --</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pekerjaan -->
                    <div class="form-group">
                        <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                               id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}"
                               placeholder="Masukkan pekerjaan">
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Telepon -->
                    <div class="form-group">
                        <label for="telp" class="form-label">No. Telepon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror"
                               id="telp" name="telp" value="{{ old('telp') }}"
                               placeholder="Masukkan nomor HP" maxlength="15">
                        @error('telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}"
                               placeholder="Contoh: nama@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">
                            <i class="mdi mdi-arrow-left mr-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save mr-1"></i>Simpan Data
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ====================== START JS TAMBAHAN ====================== --}}
<script>
    // Auto format untuk input telepon (angka & +)
    document.getElementById('telp').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9+]/g, '');
    });

    // Auto format untuk input NIK (hanya angka)
    document.getElementById('no_ktp').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Auto dismiss alerts setelah 5 detik
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
</script>
{{-- ====================== END JS TAMBAHAN ====================== --}}

@endsection
