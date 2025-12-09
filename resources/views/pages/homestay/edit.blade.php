@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Homestay</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('homestay.update', $homestay->homestay_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Homestay *</label>
                                    <input type="text" name="nama" class="form-control"
                                           value="{{ $homestay->nama }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Pemilik *</label>
                                    <select name="pemilik_warga_id" class="form-control" required>
                                        @foreach($wargas as $warga)
                                            <option value="{{ $warga->warga_id }}"
                                                    {{ $homestay->pemilik_warga_id == $warga->warga_id ? 'selected' : '' }}>
                                                {{ $warga->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Alamat *</label>
                                    <textarea name="alamat" class="form-control" rows="3" required>{{ $homestay->alamat }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>RT</label>
                                            <input type="text" name="rt" class="form-control"
                                                   value="{{ $homestay->rt }}" maxlength="5">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>RW</label>
                                            <input type="text" name="rw" class="form-control"
                                                   value="{{ $homestay->rw }}" maxlength="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fasilitas (JSON)</label>
                                    <textarea name="fasilitas_json" class="form-control" rows="3">{{ json_encode($homestay->fasilitas_json, JSON_PRETTY_PRINT) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Harga per Malam *</label>
                                    <input type="number" name="harga_per_malam" class="form-control"
                                           value="{{ $homestay->harga_per_malam }}" required min="0">
                                </div>

                                <div class="form-group">
                                    <label>Status *</label>
                                    <select name="status" class="form-control" required>
                                        <option value="pending" {{ $homestay->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="aktif" {{ $homestay->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ $homestay->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('homestay.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
