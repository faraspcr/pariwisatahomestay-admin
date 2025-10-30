@extends('admin.layouts.app')

@section('content')

        <div class="container-fluid page-body-wrapper">


            <div class="main-panel">
                <div class="content-wrapper">

                    <!-- {{-- start main content --}} -->
                    <!-- Header -->
                    <div class="page-header">
                        <h3 class="page-title">
                            <i class="mdi mdi-account-edit text-primary mr-2"></i>
                            Edit Data Warga
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('warga.index') }}">Data Warga</a></li>
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

                    <!-- Form Edit Warga -->
                    <div class="card form-container">
                        <div class="card-body">
                            <form action="{{ route('warga.update', $dataWarga->warga_id) }}" method="POST" id="wargaForm">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <!-- No KTP -->
                                        <div class="mb-3">
                                            <label for="no_ktp" class="form-label">No KTP <span class="required-star">*</span></label>
                                            <input type="text" class="form-control @error('no_ktp') field-error @enderror"
                                                   id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $dataWarga->no_ktp) }}"
                                                   placeholder="Masukkan 16 digit No KTP" maxlength="16">
                                            @error('no_ktp')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Nama Lengkap -->
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap <span class="required-star">*</span></label>
                                            <input type="text" class="form-control @error('nama') field-error @enderror"
                                                   id="nama" name="nama" value="{{ old('nama', $dataWarga->nama) }}"
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
                                                <option value="L" {{ old('jenis_kelamin', $dataWarga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin', $dataWarga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                                                <option value="Islam" {{ old('agama', $dataWarga->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama', $dataWarga->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama', $dataWarga->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama', $dataWarga->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('agama', $dataWarga->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ old('agama', $dataWarga->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                            @error('agama')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Pekerjaan -->
                                        <div class="mb-3">
                                            <label for="pekerjaan" class="form-label">Pekerjaan <span class="required-star">*</span></label>
                                            <input type="text" class="form-control @error('pekerjaan') field-error @enderror"
                                                   id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $dataWarga->pekerjaan) }}"
                                                   placeholder="Masukkan pekerjaan">
                                            @error('pekerjaan')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Telepon -->
                                        <div class="mb-3">
                                            <label for="telp" class="form-label">No. Telepon <span class="required-star">*</span></label>
                                            <input type="text" class="form-control @error('telp') field-error @enderror"
                                                   id="telp" name="telp" value="{{ old('telp', $dataWarga->telp) }}"
                                                   placeholder="Masukkan nomor HP" maxlength="15">
                                            @error('telp')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') field-error @enderror"
                                                   id="email" name="email" value="{{ old('email', $dataWarga->email) }}"
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
                                                <i class="mdi mdi-content-save mr-1"></i>Simpan Perubahan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- {{-- end main content --}} -->

                </div>
                <!-- content-wrapper ends -->

    <!-- {{-- Start JS --}} -->
    <!-- plugins:js -->
    <script src="{{ asset('assets-admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets-admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets-admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets-admin/js/misc.js') }}"></script>
    <!-- endinject -->

    <script>
        // Auto format untuk input telepon
        document.getElementById('telp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });

        // Auto format untuk input NIK (hanya angka)
        document.getElementById('no_ktp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    </script>
    <!-- {{-- End JS --}} -->
@endsection
