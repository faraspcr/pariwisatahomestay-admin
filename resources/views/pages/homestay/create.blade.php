@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Homestay Baru</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('homestay.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Homestay *</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Pemilik *</label>
                                    <select name="pemilik_warga_id" class="form-control" required>
                                        <option value="">Pilih Pemilik</option>
                                        @foreach($wargas as $warga)
                                            <option value="{{ $warga->warga_id }}">{{ $warga->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Alamat *</label>
                                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>RT</label>
                                            <input type="text" name="rt" class="form-control" maxlength="5">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>RW</label>
                                            <input type="text" name="rw" class="form-control" maxlength="5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fasilitas (JSON)</label>
                                    <textarea name="fasilitas_json" class="form-control" rows="3"
                                              placeholder='{"wifi": true, "ac": true, "parkir": true}'></textarea>
                                    <small class="text-muted">Format JSON, boleh kosong</small>
                                </div>

                                <div class="form-group">
                                    <label>Harga per Malam *</label>
                                    <input type="number" name="harga_per_malam" class="form-control" required min="0">
                                </div>

                                <div class="form-group">
                                    <label>Status *</label>
                                    <select name="status" class="form-control" required>
                                        <option value="pending">Pending</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
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
