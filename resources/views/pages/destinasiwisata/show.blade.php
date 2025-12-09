@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

        {{-- ====================== START MAIN CONTENT ====================== --}}

        <!-- Header -->
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-eye text-primary mr-2"></i>
                Detail Destinasi Wisata
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('destinasiwisata.index') }}">Destinasi Wisata</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Destinasi</li>
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

        <div class="row">
            <!-- Informasi Destinasi -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="mdi mdi-information mr-2"></i>Informasi Destinasi</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Nama Destinasi</th>
                                <td>{{ $destinasiWisata->nama }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td style="white-space: pre-line;">{{ $destinasiWisata->deskripsi }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $destinasiWisata->alamat }}</td>
                            </tr>
                            <tr>
                                <th>RT/RW</th>
                                <td>{{ $destinasiWisata->rt }}/{{ $destinasiWisata->rw }}</td>
                            </tr>
                            <tr>
                                <th>Jam Buka</th>
                                <td>{{ $destinasiWisata->jam_buka }}</td>
                            </tr>
                            <tr>
                                <th>Harga Tiket</th>
                                <td>Rp {{ number_format($destinasiWisata->tiket, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Kontak</th>
                                <td>{{ $destinasiWisata->kontak }}</td>
                            </tr>
                            <tr>
                                <th>ID Destinasi</th>
                                <td><span class="badge bg-secondary">#{{ $destinasiWisata->destinasi_id }}</span></td>
                            </tr>
                        </table>

                        <div class="d-grid gap-2 d-md-flex">
                            <a href="{{ route('destinasiwisata.edit', $destinasiWisata->destinasi_id) }}" class="btn btn-warning me-2">
                                <i class="mdi mdi-pencil mr-1"></i> Edit Data
                            </a>
                            <form action="{{ route('destinasiwisata.destroy', $destinasiWisata->destinasi_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?')">
                                    <i class="mdi mdi-delete mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Foto Destinasi -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="mdi mdi-camera mr-2"></i>Foto Destinasi</h5>
                    </div>
                    <div class="card-body">
                        <!-- Form Upload -->
                        <form action="{{ route('destinasiwisata.upload-files', $destinasiWisata->destinasi_id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                            @csrf

                            <div class="mb-3">
                                <label for="foto_destinasi" class="form-label fw-bold">Upload Foto Tambahan</label>
                                <input type="file" class="form-control @error('foto_destinasi') is-invalid @enderror"
                                       id="foto_destinasi" name="foto_destinasi[]" multiple
                                       accept=".jpg,.jpeg,.png,.gif,.webp">
                                @error('foto_destinasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="mdi mdi-information mr-1"></i>
                                    Pilih multiple file (JPG, PNG, GIF, WEBP). Maksimal 5MB per file.
                                </div>
                            </div>

                            <!-- File Preview -->
                            <div id="file-preview" class="mb-3" style="display: none;">
                                <h6 class="text-muted">File Terpilih:</h6>
                                <div id="preview-list" class="list-group"></div>
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="mdi mdi-cloud-upload mr-1"></i> Upload Foto
                            </button>
                        </form>

                        <!-- Daftar File -->
                        <h6 class="border-bottom pb-2">
                            <i class="mdi mdi-image-multiple mr-2"></i>Foto Terupload
                            <span class="badge bg-primary">{{ count($files) }}</span>
                        </h6>

                        @if(count($files) > 0)
                            <div class="row">
                                @foreach($files as $file)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="{{ asset('storage/destinasi_wisata/' . $file->file_name) }}"
                                                 class="card-img-top"
                                                 style="height: 150px; object-fit: cover;"
                                                 alt="Foto Destinasi">
                                            <div class="card-body p-2 text-center">
                                                <form action="{{ route('destinasiwisata.delete-file', [$destinasiWisata->destinasi_id, $file->media_id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Hapus foto ini?')">
                                                        <i class="mdi mdi-delete"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="mdi mdi-image-off fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada foto yang diupload.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ====================== END MAIN CONTENT ====================== --}}
    </div>
</div>

{{-- ====================== START JS TAMBAHAN ====================== --}}
<script>
    // ============ PREVIEW FILE UPLOAD ============
    document.getElementById('foto_destinasi').addEventListener('change', function(e) {
        const preview = document.getElementById('file-preview');
        const previewList = document.getElementById('preview-list');
        const files = e.target.files;

        previewList.innerHTML = '';

        if (files.length > 0) {
            preview.style.display = 'block';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const listItem = document.createElement('div');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';

                let icon = 'mdi mdi-file';
                let iconColor = 'text-secondary';

                if (file.type.startsWith('image/')) {
                    icon = 'mdi mdi-image';
                    iconColor = 'text-primary';
                }

                listItem.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="${icon} ${iconColor} me-2"></i>
                        <span class="small">${file.name}</span>
                    </div>
                    <small class="text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                `;

                previewList.appendChild(listItem);
            }
        } else {
            preview.style.display = 'none';
        }
    });

    // Auto dismiss alerts setelah 5 detik
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
</script>
{{-- ====================== END JS TAMBAHAN ====================== --}}
@endsection
