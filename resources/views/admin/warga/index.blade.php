<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Sistem Administrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                            <a class="nav-link text-white active" href="{{ route('warga.index') }}">
                                <i class="fas fa-users me-2"></i> Data Warga
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Data Warga</h2>
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

                <!-- Card Data Warga -->
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Warga</h5>
                        <a href="{{ route('warga.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i>Tambah Warga
                        </a>
                    </div>
                    <div class="card-body">
                       <div class="table-responsive">
    <table class="table table-centered table-nowrap mb-0 rounded">
        <thead class="thead-light">
            <tr>
                <th class="border-0 rounded-start">No</th>
                <th class="border-0">No KTP</th>
                <th class="border-0">Nama</th>
                <th class="border-0">Jenis Kelamin</th>
                <th class="border-0">Agama</th>
                <th class="border-0">Pekerjaan</th>
                <th class="border-0">Telepon</th>
                <th class="border-0">Email</th>
                <th class="border-0 rounded-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($warga as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->no_ktp }}</td>
                <td>{{ $item->nama }}</td>
                <td>
                    @if($item->jenis_kelamin == 'L')
                        Laki-laki
                    @else
                        Perempuan
                    @endif
                </td>
                <td>{{ $item->agama }}</td>
                <td>{{ $item->pekerjaan }}</td>
                <td>{{ $item->telp }}</td>
                <td>{{ $item->email ?: '-' }}</td>
                <td>
                    <td>
    <div class="btn-group btn-group-sm">

        <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-info btn-sm">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687 1.688c.38.38.38.995 0 1.375L9.89 15.56a2.25 2.25 0 0 1-1.59.66H6.75a.75.75 0 0 1-.75-.75v-1.55c0-.597.237-1.17.66-1.59l8.375-8.375c.38-.38.995-.38 1.375 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75h6a2.25 2.25 0 0 1 2.25 2.25v6a2.25 2.25 0 0 1-2.25 2.25h-6a2.25 2.25 0 0 1-2.25-2.25V9a2.25 2.25 0 0 1 2.25-2.25z"/>
            </svg>
            Edit
        </a>

        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" style="display:inline">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger btn-sm">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                </svg>
                Hapus
            </button>
        </form>
    </div>
</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center py-4">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-users fa-2x text-muted mb-2"></i>
                        <span class="text-muted">Belum ada data warga</span>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
