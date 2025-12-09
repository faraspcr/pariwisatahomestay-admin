@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <!-- Header -->
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-bed-edit text-success mr-2"></i>
                Edit Kamar Homestay
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('homestay.index') }}">Homestay</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kamar_homestay.index') }}">Kamar Homestay</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Form Edit Kamar</h4>

                        <form action="{{ route('kamar_homestay.update', $kamar->kamar_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Homestay -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Homestay <span class="text-danger">*</span></label>
                                        <select name="homestay_id" class="form-control" required>
                                            <option value="">Pilih Homestay</option>
                                            @foreach($homestays as $homestay)
                                                <option value="{{ $homestay->homestay_id }}"
                                                    {{ $kamar->homestay_id == $homestay->homestay_id ? 'selected' : '' }}>
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
                                               value="{{ old('nama_kamar', $kamar->nama_kamar) }}" required>
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
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $kamar->kapasitas == $i ? 'selected' : '' }}>
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
                                               value="{{ old('harga', $kamar->harga) }}" min="0" required>
                                        @error('harga')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Fasilitas JSON -->
                            <div class="form-group">
                                <label>Fasilitas (JSON Format)</label>
                                <textarea name="fasilitas_json" class="form-control" rows="4">{{ old('fasilitas_json', $kamar->fasilitas_json ? json_encode(json_decode($kamar->fasilitas_json), JSON_PRETTY_PRINT) : '') }}</textarea>
                                <small class="text-muted">
                                    Format JSON. Contoh: {"ac": true, "tv": true, "wifi": true}
                                </small>
                                @error('fasilitas_json')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save mr-1"></i> Update
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
                            <i class="mdi mdi-bed text-primary mr-2"></i>
                            Info Kamar
                        </h5>

                        <div class="info-box mb-3">
                            <div class="info-box-content">
                                <span class="info-box-text">ID Kamar</span>
                                <span class="info-box-number">{{ $kamar->kamar_id }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3">
                            <div class="info-box-content">
                                <span class="info-box-text">Homestay</span>
                                <span class="info-box-number">{{ $kamar->homestay->nama ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3">
                            <div class="info-box-content">
                                <span class="info-box-text">Kapasitas</span>
                                <span class="info-box-number">{{ $kamar->kapasitas }} Orang</span>
                            </div>
                        </div>

                        <div class="info-box mb-3">
                            <div class="info-box-content">
                                <span class="info-box-text">Harga</span>
                                <span class="info-box-number">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        @if($kamar->fasilitas_json)
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="mb-0">Fasilitas Saat Ini</h6>
                            </div>
                            <div class="card-body">
                                @php
                                    $fasilitas = json_decode($kamar->fasilitas_json, true);
                                @endphp
                                @if(is_array($fasilitas))
                                    @foreach($fasilitas as $key => $value)
                                        @if($value)
                                            <span class="badge badge-success mr-1 mb-1">{{ $key }}</span>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.info-box {
    display: flex;
    min-height: 70px;
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
}
.info-box-content {
    flex: 1;
}
.info-box-text {
    display: block;
    font-size: 12px;
    color: #6c757d;
    text-transform: uppercase;
}
.info-box-number {
    display: block;
    font-weight: 600;
    font-size: 18px;
    color: #495057;
}
</style>

@endsection
