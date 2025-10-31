@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    {{-- ====================== START MAIN CONTENT ====================== --}}

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

    <!-- Form Tambah Warga -->
    <div class="card form-container">
        <div class="card-body">
            <h4 class="card-title mb-4">Tambah Data Warga</h4>

            <form action="{{ route('warga.store') }}" method="POST" id="wargaForm">
                @csrf

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <!-- No KTP -->
                        <div class="mb-3">
                            <label for="no_ktp" class="form-label">No KTP <span class="required-star">*</span></label>
                            <input type="text" class="form-control @error('no_ktp') field-error @enderror"
                                   id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}"
                                   placeholder="Masukkan 16 digit No KTP" maxlength="16">
                            @error('no_ktp')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap <span class="required-star">*</span></label>
                            <input type="text" class="form-control @error('nama') field-error @enderror"
                                   id="nama" name="nama" value="{{ old('nama') }}"
                                   placeholder="Masukkan nama lengkap">
                            @error('nama')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="required-star">*</span></label>
                            <select class="form-control @error('jenis_kelamin') field-error @enderror"
                                    id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <!-- Agama -->
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama <span class="required-star">*</span></label>
                            <select class="form-control @error('agama') field-error @enderror"
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
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pekerjaan -->
                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan <span class="required-star">*</span></label>
                            <input type="text" class="form-control @error('pekerjaan') field-error @enderror"
                                   id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}"
                                   placeholder="Masukkan pekerjaan">
                            @error('pekerjaan')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div class="mb-3">
                            <label for="telp" class="form-label">No. Telepon <span class="required-star">*</span></label>
                            <input type="text" class="form-control @error('telp') field-error @enderror"
                                   id="telp" name="telp" value="{{ old('telp') }}"
                                   placeholder="Masukkan nomor HP" maxlength="15">
                            @error('telp')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') field-error @enderror"
                                   id="email" name="email" value="{{ old('email') }}"
                                   placeholder="Contoh: nama@email.com">
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
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

    {{-- ====================== END MAIN CONTENT ====================== --}}
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
