@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <!-- Header -->
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-bed-plus text-success mr-2"></i>
                Tambah Kamar Homestay
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('homestay.index') }}">Homestay</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kamar_homestay.index') }}">Kamar Homestay</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Form Tambah Kamar</h4>

                        <form action="{{ route('kamar_homestay.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <!-- Homestay -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Homestay <span class="text-danger">*</span></label>
                                        <select name="homestay_id" class="form-control" required>
                                            <option value="">Pilih Homestay</option>
                                            @foreach($homestays as $homestay)
                                                <option value="{{ $homestay->homestay_id }}" {{ old('homestay_id') == $homestay->homestay_id ? 'selected' : '' }}>
                                                    {{ $homestay->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('homestay_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nama Kamar -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Kamar <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_kamar" class="form-control"
                                               value="{{ old('nama_kamar') }}" required>
                                        @error('nama_kamar')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Kapasitas -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kapasitas (Orang) <span class="text-danger">*</span></label>
                                        <select name="kapasitas" class="form-control" required>
                                            <option value="">Pilih Kapasitas</option>
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ old('kapasitas') == $i ? 'selected' : '' }}>
                                                    {{ $i }} Orang
                                                </option>
                                            @endfor
                                        </select>
                                        @error('kapasitas')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Harga -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Harga per Malam (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" name="harga" class="form-control"
                                               value="{{ old('harga') }}" min="0" required>
                                        @error('harga')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Fasilitas JSON -->
                            <div class="form-group">
                                <label>Fasilitas (JSON Format)</label>
                                <textarea name="fasilitas_json" class="form-control" rows="4"
                                          placeholder='{"ac": true, "tv": true, "wifi": true, "kamar_mandi_dalam": true}'>{{ old('fasilitas_json') }}</textarea>
                                <small class="text-muted">
                                    Format JSON. Contoh: {"ac": true, "tv": true, "wifi": true}
                                </small>
                                @error('fasilitas_json')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save mr-1"></i> Simpan
                                </button>
                                <a href="{{ route('kamar_homestay.index') }}" class="btn btn-light">
                                    <i class="mdi mdi-arrow-left mr-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-information-outline text-primary mr-2"></i>
                            Informasi
                        </h5>
                        <div class="alert alert-info">
                            <h6><i class="mdi mdi-alert-circle-outline mr-2"></i> Panduan:</h6>
                            <ul class="mb-0 pl-3">
                                <li>Pilih homestay yang sudah terdaftar</li>
                                <li>Nama kamar harus unik per homestay</li>
                                <li>Kapasitas maksimal 10 orang</li>
                                <li>Harga dalam Rupiah (tanpa titik)</li>
                                <li>Fasilitas format JSON (opsional)</li>
                            </ul>
                        </div>

                        <div class="alert alert-success mt-3">
                            <h6><i class="mdi mdi-check-circle-outline mr-2"></i> Format Fasilitas JSON:</h6>
                            <pre class="mb-0 small">{
  "ac": true,
  "tv": true,
  "wifi": true,
  "kamar_mandi_dalam": true,
  "balkon": false
}</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
