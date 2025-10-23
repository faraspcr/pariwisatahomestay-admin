<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Wisata - Sistem Administrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .btn-group-sm .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar min-vh-100">
                <div class="position-sticky pt-3">
                    <div class="p-3">
                        <h4 class="text-white">Sistem Administrasi</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('warga.index') }}">
                                <i class="fas fa-users me-2"></i> Data Warga
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white active" href="{{ route('destinasiwisata.index') }}">
                                <i class="fas fa-map-marker-alt me-2"></i> Destinasi Wisata
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Destinasi Wisata</h2>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i>Admin
                        </button>
                    </div>
                </div>

                <!-- Alert Success -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Sukses!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Card -->
                <div class="card shadow">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-list me-2"></i>Daftar Destinasi Wisata
                            <span class="badge bg-light text-success ms-2">{{ $destinasiWisata->count() }} Data</span>
                        </h5>
                        <a href="{{ route('destinasiwisata.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Destinasi
                        </a>
                    </div>
                    <div class="card-body">
                        @if($destinasiWisata->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-success">
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Nama Destinasi</th>
                                        <th>Alamat</th>
                                        <th width="80">RT/RW</th>
                                        <th width="120">Jam Buka</th>
                                        <th width="120">Tiket</th>
                                        <th width="150">Kontak</th>
                                        <th width="200" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($destinasiWisata as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $item->nama }}</strong>
                                            @if(strlen($item->deskripsi) > 50)
                                                <br><small class="text-muted">{{ substr($item->deskripsi, 0, 50) }}...</small>
                                            @else
                                                <br><small class="text-muted">{{ $item->deskripsi }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $item->alamat }}</td>
                                        <td class="text-center">{{ $item->rt }}/{{ $item->rw }}</td>
                                        <td>{{ $item->jam_buka }}</td>
                                        <td>Rp {{ number_format($item->tiket, 0, ',', '.') }}</td>
                                        <td>{{ $item->kontak }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('destinasiwisata.edit', $item->destinasi_id) }}"
                                                   class="btn btn-warning" title="Edit">
                                                   <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Tombol Detail -->
                                                <a href="{{ route('destinasiwisata.show', $item->destinasi_id) }}"
                                                   class="btn btn-info" title="Detail">
                                                   <i class="fas fa-eye"></i>
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('destinasiwisata.destroy', $item->destinasi_id) }}"
                                                      method="POST"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger"
                                                            title="Hapus"
                                                            onclick="return confirm('Yakin menghapus {{ $item->nama }}?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination (jika menggunakan paginate) -->
                        @if($destinasiWisata->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted">
                                Menampilkan {{ $destinasiWisata->firstItem() }} - {{ $destinasiWisata->lastItem() }} dari {{ $destinasiWisata->total() }} data
                            </div>
                            {{ $destinasiWisata->links() }}
                        </div>
                        @endif

                        @else
                        <div class="text-center py-5">
                            <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Data Destinasi Wisata</h5>
                            <p class="text-muted">Silakan tambah data destinasi wisata terlebih dahulu</p>
                            <a href="{{ route('destinasiwisata.create') }}" class="btn btn-success">
                                <i class="fas fa-plus me-1"></i> Tambah Data Pertama
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto dismiss alert setelah 5 detik
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    </script>
</body>
</html>
