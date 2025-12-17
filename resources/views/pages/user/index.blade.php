@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

        {{-- ====================== START MAIN CONTENT ====================== --}}
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

        <!-- Card Data User -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar User Terdaftar</h4>

                <!-- Form Filter dan Search -->
                <form method="GET" action="{{ route('user.index') }}">
                    <div class="row mb-4">
                        <!-- Filter Urutan -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <select name="urutan" onchange="this.form.submit()" class="form-control filter-select">
                                <option value="">Semua User</option>
                                <option value="terbaru" {{ request('urutan') == 'terbaru' ? 'selected' : '' }}>User Terbaru</option>
                                <option value="terlama" {{ request('urutan') == 'terlama' ? 'selected' : '' }}>User Terlama</option>
                                <option value="nama_asc" {{ request('urutan') == 'nama_asc' ? 'selected' : '' }}>Nama A → Z</option>
                                <option value="nama_desc" {{ request('urutan') == 'nama_desc' ? 'selected' : '' }}>Nama Z → A</option>
                            </select>
                        </div>

                        <!-- Filter Role -->
                        <div class="col-md-2 mb-2 mb-md-0">
                            <select name="role" onchange="this.form.submit()" class="form-control filter-select">
                                <option value="">Semua Role</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pemilik" {{ request('role') == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                                <option value="warga" {{ request('role') == 'warga' ? 'selected' : '' }}>Warga</option>
                            </select>
                        </div>

                        <!-- Form Search -->
                        <div class="col-md-4">
                            <div class="input-group search-group">
                                <input type="text"
                                       name="search"
                                       class="form-control form-control-sm search-input"
                                       placeholder="Cari data user..."
                                       value="{{ request('search') }}">
                                <button type="submit" class="input-group-text search-btn">
                                    <i class="mdi mdi-magnify"></i>
                                </button>
                                @if(request("search"))
                                <a href="{{ request()->fullUrlWithQuery(['search'=> null]) }}" class="input-group-text clear-btn">
                                    Clear
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Tombol Tambah -->
                        <div class="col-md-3 text-right">
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm add-btn">
                                <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah User
                            </a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Profile</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Bergabung</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $item)
                            <tr class="table-row">
                                <td class="text-center">
                                    <span class="badge badge-info">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</span>
                                </td>
                                <td>
                                    <!-- ✅ Profile Photo - SIMPLE & WORKING -->
                                    <div class="avatar-container position-relative">
                                        <div class="rounded-circle" style="width: 45px; height: 45px; overflow: hidden; border: 2px solid #e9ecef;">
                                            <img src="{{ $item->profile_photo_url }}"
                                                 alt="{{ $item->name }}"
                                                 style="width: 100%; height: 100%; object-fit: cover;"
                                                 onerror="this.onerror=null; this.src='{{ $item->profile_photo_url }}'">
                                        </div>
                                        @if($item->profile_picture)
                                            <span class="position-absolute badge bg-success" style="bottom: -5px; right: -5px; font-size: 8px; padding: 2px 4px;">
                                                <i class="mdi mdi-check"></i>
                                            </span>
                                        @else
                                            <span class="position-absolute badge bg-secondary" style="bottom: -5px; right: -5px; font-size: 8px; padding: 2px 4px;">
                                                <i class="mdi mdi-account"></i>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="font-weight-bold">{{ $item->name }}</div>
                                            <small class="text-muted">ID: {{ $item->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="mdi mdi-email mr-2 text-warning"></i>
                                        <span>{{ $item->email }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <!-- Badge Role dengan warna berbeda -->
                                    @if($item->role == 'admin')
                                        <span class="badge badge-danger py-2 px-3">
                                            <i class="mdi mdi-shield-account mr-1"></i>Admin
                                        </span>
                                    @elseif($item->role == 'pemilik')
                                        <span class="badge badge-warning py-2 px-3">
                                            <i class="mdi mdi-home-account mr-1"></i>Pemilik
                                        </span>
                                    @else
                                        <span class="badge badge-primary py-2 px-3">
                                            <i class="mdi mdi-account mr-1"></i>Warga
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->email_verified_at)
                                        <span class="badge badge-success py-2 px-3">
                                            <i class="mdi mdi-check-circle mr-1"></i>Aktif
                                        </span>
                                    @else
                                        <span class="badge badge-secondary py-2 px-3">
                                            <i class="mdi mdi-clock-outline mr-1"></i>Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <small class="text-muted">
                                        <i class="mdi mdi-calendar-clock mr-1"></i>
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </small>
                                </td>
                                <td class="text-center action-buttons">
                                    <div class="btn-group" role="group">
                                        <!-- Tombol Show -->
                                        <a href="{{ route('user.show', $item->id) }}"
                                           class="btn btn-outline-info btn-sm action-btn"
                                           data-toggle="tooltip"
                                           title="Lihat Detail">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('user.edit', $item->id) }}"
                                           class="btn btn-outline-warning btn-sm action-btn"
                                           data-toggle="tooltip"
                                           title="Edit Data">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <!-- Tombol Delete -->
                                        <form action="{{ route('user.destroy', $item->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm action-btn"
                                                    data-toggle="tooltip"
                                                    title="Hapus Data"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $item->name }}?')">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="mdi mdi-account-off-outline text-muted" style="font-size: 64px;"></i>
                                        <h4 class="text-muted mt-3">Belum ada data user</h4>
                                        <p class="text-muted">Silakan tambah data user terlebih dahulu</p>
                                        <a href="{{ route('user.create') }}" class="btn btn-primary mt-2">
                                            <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah User Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ====================== PAGINATION ====================== --}}
                <div class="mt-4">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>

                <!-- Info Summary -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-information-outline mr-2" style="font-size: 24px;"></i>
                                <div>
                                    @php
                                        $adminCount = $users->where('role', 'admin')->count();
                                        $pemilikCount = $users->where('role', 'pemilik')->count();
                                        $wargaCount = $users->where('role', 'warga')->count();
                                    @endphp
                                    <h6 class="alert-heading mb-1">Total Data User: {{ $users->total() }}</h6>
                                    <p class="mb-0">
                                        Admin: {{ $adminCount }} |
                                        Pemilik: {{ $pemilikCount }} |
                                        Warga: {{ $wargaCount }}
                                    </p>
                                    <small class="mb-0">Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
/* ==================== STYLING UNTUK SEARCH & FILTER ==================== */
.filter-select {
    height: 38px;
    border: 1px solid #d1d3e2;
    border-radius: 4px;
    font-size: 14px;
    background-color: white;
}

.filter-select:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.search-group {
    border: 1px solid #d1d3e2;
    border-radius: 4px;
    overflow: hidden;
    background-color: white;
}

.search-input {
    border: none;
    border-radius: 0;
    height: 38px;
    font-size: 14px;
}

.search-input:focus {
    box-shadow: none;
    border: none;
}

.search-btn {
    background-color: #f8f9fc;
    border: none;
    border-left: 1px solid #d1d3e2;
    color: #6e707e;
    height: 38px;
    padding: 0 15px;
    transition: all 0.3s ease;
}

.search-btn:hover {
    background-color: #4e73df;
    color: white;
}

.clear-btn {
    background-color: #f8f9fc;
    border: none;
    border-left: 1px solid #d1d3e2;
    color: #6e707e;
    height: 38px;
    padding: 0 15px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: flex;
    align-items: center;
}

.clear-btn:hover {
    background-color: #e74a3b;
    color: white;
    text-decoration: none;
}

.add-btn {
    height: 38px;
    font-size: 14px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.add-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

/* ==================== STYLING UNTUK PAGINATION ==================== */
.pagination {
    margin-top: 2rem;
}

.page-link {
    border: none;
    margin: 0 3px;
    border-radius: 4px !important;
    transition: all 0.3s ease;
    color: #6e707e;
    font-weight: 500;
}

.page-link:hover {
    background-color: #4e73df;
    color: white;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #4e73df, #224abe);
    border: none;
}

/* ==================== STYLING UNTUK TABLE ==================== */
.table-row {
    transition: all 0.3s ease;
}

.table-row:hover {
    background-color: rgba(78, 115, 223, 0.05);
}

/* Styling untuk Action Buttons */
.action-btn {
    transition: all 0.3s ease;
    border-radius: 4px;
}

.action-btn:hover {
    transform: translateY(-1px);
}

.action-btn.btn-outline-info:hover {
    background-color: #36b9cc;
    border-color: #36b9cc;
    color: white;
}

.action-btn.btn-outline-warning:hover {
    background-color: #f6c23e;
    border-color: #f6c23e;
    color: white;
}

.action-btn.btn-outline-danger:hover {
    background-color: #e74a3b;
    border-color: #e74a3b;
    color: white;
}

/* Badge Styling untuk Role */
.badge-danger {
    background: linear-gradient(45deg, #dc3545, #c82333);
    color: white;
    border: none;
}
.badge-warning {
    background: linear-gradient(45deg, #ffc107, #e0a800);
    color: #212529;
    border: none;
}
.badge-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
    color: white;
    border: none;
}
.badge-success {
    background: linear-gradient(45deg, #28a745, #1e7e34);
    color: white;
    border: none;
}
.badge-secondary {
    background: linear-gradient(45deg, #6c757d, #545b62);
    color: white;
    border: none;
}
.badge-info {
    background: linear-gradient(45deg, #17a2b8, #138496);
    color: white;
    border: none;
}

/* Styling untuk Alert Info */
.alert-info {
    border-radius: 6px;
    border: none;
    background: linear-gradient(135deg, #d1ecf1, #bee5eb);
}

/* ✅ STYLE UNTUK AVATAR */
.avatar-container {
    position: relative;
    display: inline-block;
}

.avatar-container img {
    transition: all 0.3s ease;
}

.avatar-container img:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.position-relative .badge {
    border: 1px solid white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    font-size: 8px;
    padding: 2px 4px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .text-right {
        text-align: left !important;
        margin-top: 10px;
    }

    .table td, .table th {
        padding: 0.5rem;
        font-size: 0.9rem;
    }

    .avatar-container .rounded-circle {
        width: 35px !important;
        height: 35px !important;
    }
}
</style>

<script>
// Fungsi untuk zoom foto
document.addEventListener('DOMContentLoaded', function() {
    const profileImages = document.querySelectorAll('.avatar-container img');

    profileImages.forEach(img => {
        img.addEventListener('click', function() {
            const src = this.src;
            const modal = `
                <div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Foto Profile</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="${src}" style="max-width: 100%; max-height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Hapus modal lama jika ada
            const oldModal = document.getElementById('imageModal');
            if (oldModal) oldModal.remove();

            // Tambah modal baru
            document.body.insertAdjacentHTML('beforeend', modal);

            // Tampilkan modal
            $('#imageModal').modal('show');
        });
    });
});
</script>

@endsection
