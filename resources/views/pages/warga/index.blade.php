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

        <!-- Card Data Warga -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar Warga Terdaftar</h4>

                <!-- Form Filter dan Search -->
                <form method="GET" action="{{ route('warga.index') }}">
                    <div class="row mb-4">
                        <!-- Filter Gender -->
                        <div class="col-md-3">
                            <select name="jenis_kelamin" onchange="this.form.submit()" class="form-control form-control-sm filter-rating">
                                <option value="">Semua Gender</option>
                                <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Form Search -->
                        <div class="col-md-3">
                            <div class="input-group search-group">
                                <input type="text"
                                       name="search"
                                       class="form-control form-control-sm search-input"
                                       placeholder="Cari data warga..."
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
                        <div class="col-md-6 text-right">
                            <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm add-btn">
                                <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Warga
                            </a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th>No KTP</th>
                                <th>Nama Lengkap</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Agama</th>
                                <th class="text-center">Pekerjaan</th>
                                <th>Telepon</th>
                                <th>Email</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($warga as $item)
                            <tr class="table-row">
                                <td class="text-center">
                                    <span class="badge badge-info">{{ ($warga->currentPage() - 1) * $warga->perPage() + $loop->iteration }}</span>
                                </td>
                                <td>
                                    <span class="font-weight-bold text-primary">{{ $item->no_ktp }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <i class="mdi mdi-account-circle text-primary" style="font-size: 24px;"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">{{ $item->nama }}</div>
                                            <small class="text-muted">ID: {{ $item->warga_id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($item->jenis_kelamin == 'L')
                                        <span class="badge badge-gender-male py-2 px-3">
                                            <i class="mdi mdi-gender-male mr-1"></i>Laki-laki
                                        </span>
                                    @else
                                        <span class="badge badge-gender-female py-2 px-3">
                                            <i class="mdi mdi-gender-female mr-1"></i>Perempuan
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-religion py-2 px-3">
                                        <i class="mdi mdi-church mr-1"></i>{{ $item->agama }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-job py-2 px-3">
                                        <i class="mdi mdi-briefcase mr-1"></i>{{ $item->pekerjaan }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="mdi mdi-phone mr-2 text-success"></i>
                                        <span class="font-weight-bold">{{ $item->telp }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($item->email)
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-email mr-2 text-warning"></i>
                                            <span class="text-truncate" style="max-width: 150px;">{{ $item->email }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center action-buttons">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('warga.edit', $item->warga_id) }}"
                                           class="btn btn-outline-info btn-sm action-btn"
                                           data-toggle="tooltip"
                                           title="Edit Data">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm action-btn"
                                                    data-toggle="tooltip"
                                                    title="Hapus Data"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data warga {{ $item->nama }}?')">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center empty-state">
                                        <i class="mdi mdi-account-off-outline text-muted" style="font-size: 64px;"></i>
                                        <h4 class="text-muted mt-3">Belum ada data warga</h4>
                                        <p class="text-muted">Silakan tambah data warga terlebih dahulu</p>
                                        <a href="{{ route('warga.create') }}" class="btn btn-primary mt-2 add-btn">
                                            <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Warga Pertama
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
                    {{ $warga->links('pagination::bootstrap-5') }}
                </div>

                <!-- Info Summary -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-info summary-card">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-information-outline mr-2" style="font-size: 24px;"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Total Data Warga: {{ $warga->total() }}</h6>
                                    <p class="mb-0">Menampilkan {{ $warga->count() }} data dari total {{ $warga->total() }} data warga</p>
                                    <small class="mb-0">Halaman {{ $warga->currentPage() }} dari {{ $warga->lastPage() }}</small>
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
/* ==================== ANIMASI UNTUK SEARCH & FILTER ==================== */

/* SAMAKAN UKURAN FILTER DAN SEARCH */
.filter-rating,
.search-input {
    height: 38px !important; /* Sama tinggi */
    font-size: 14px; /* Sama ukuran font */
    border-radius: 8px; /* Sama border radius */
}

/* Pastikan input group memiliki tinggi yang konsisten */
.search-group {
    height: 38px; /* Sama tinggi dengan filter */
}

/* Styling untuk tombol search dan clear - SAMAKAN TINGGI */
.search-btn,
.clear-btn {
    height: 38px !important; /* Sama tinggi dengan input */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 12px;
}

/* Animasi untuk Filter Gender */
.filter-rating {
    border: 1px solid #ddd;
    transition: all 0.3s ease;
}

.filter-rating:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    transform: translateY(-1px);
}

.filter-rating:hover {
    border-color: #4e73df;
    transform: translateY(-1px);
}

/* Animasi untuk Search Input Group */
.search-group {
    transition: all 0.3s ease;
    border-radius: 8px;
}

.search-group:focus-within {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.search-input:focus {
    border-color: #4e73df;
    box-shadow: none;
}

/* Animasi untuk Search Button */
.search-btn {
    transition: all 0.3s ease;
    cursor: pointer;
    border: 1px solid #ddd;
    border-left: none;
    background-color: #f8f9fa;
}

.search-btn:hover {
    background-color: #4e73df !important;
    color: white !important;
    transform: scale(1.05);
}

/* Animasi untuk Clear Button */
.clear-btn {
    transition: all 0.3s ease;
    border: 1px solid #ddd;
    border-left: none;
    background-color: #f8f9fa;
}

.clear-btn:hover {
    background-color: #f45c4e !important;
    color: white !important;
    transform: scale(1.05);
}

/* Animasi untuk Tombol Tambah */
.add-btn {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.add-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(78, 115, 223, 0.4);
}

.add-btn:active {
    transform: translateY(0);
}

/* ==================== ANIMASI UNTUK PAGINATION ==================== */
.pagination {
    margin-top: 2rem;
}

.page-link {
    border: none;
    margin: 0 3px;
    border-radius: 8px !important;
    transition: all 0.3s ease;
    color: #6e707e;
    font-weight: 500;
}

.page-link:hover {
    background-color: #4e73df !important;
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #4e73df, #224abe) !important;
    border: none;
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(78, 115, 223, 0.4);
}

.page-item.disabled .page-link {
    opacity: 0.5;
    transform: none;
    box-shadow: none;
}

/* ==================== ANIMASI UNTUK TABLE ==================== */
.table-row {
    transition: all 0.3s ease;
    position: relative;
}

.table-row:hover {
    background-color: rgba(78, 115, 223, 0.05) !important;
    transform: translateX(5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Animasi untuk Action Buttons */
.action-btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    border-radius: 6px;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.action-btn.btn-outline-info:hover {
    background-color: #36b9cc !important;
    border-color: #36b9cc !important;
    color: white !important;
}

.action-btn.btn-outline-danger:hover {
    background-color: #e74a3b !important;
    border-color: #e74a3b !important;
    color: white !important;
}

/* Animasi untuk Empty State */
.empty-state {
    animation: fadeInUp 0.8s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Animasi untuk Summary Card */
.summary-card {
    transition: all 0.3s ease;
    border-radius: 10px;
}

.summary-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

/* Loading Animation untuk Search */
@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(78, 115, 223, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(78, 115, 223, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(78, 115, 223, 0);
    }
}

.search-loading {
    animation: pulse 1.5s infinite;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // ==================== ANIMASI UNTUK SEARCH & FILTER ====================

    // Animasi untuk search loading
    const searchForm = document.querySelector('form[method="GET"]');
    const searchInput = document.querySelector('.search-input');
    const searchButton = document.querySelector('.search-btn');

    if (searchForm && searchButton) {
        searchForm.addEventListener('submit', function(e) {
            if (searchInput.value.trim() !== '') {
                searchButton.classList.add('search-loading');
                const originalHTML = searchButton.innerHTML;
                searchButton.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-1"></i>';

                // Reset setelah 2 detik (fallback)
                setTimeout(() => {
                    searchButton.classList.remove('search-loading');
                    searchButton.innerHTML = originalHTML;
                }, 2000);
            }
        });
    }

    // Animasi hover untuk pagination
    const paginationLinks = document.querySelectorAll('.page-link');
    paginationLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            if (!this.parentElement.classList.contains('active') && !this.parentElement.classList.contains('disabled')) {
                this.style.transform = 'translateY(-2px)';
            }
        });

        link.addEventListener('mouseleave', function() {
            if (!this.parentElement.classList.contains('active')) {
                this.style.transform = 'translateY(0)';
            }
        });
    });

    // Animasi untuk filter select
    const genderSelect = document.querySelector('.filter-rating');
    if (genderSelect) {
        genderSelect.addEventListener('change', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }

    // Animasi untuk table rows saat load
    const tableRows = document.querySelectorAll('.table-row');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateX(-20px)';

        setTimeout(() => {
            row.style.transition = 'all 0.5s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateX(0)';
        }, index * 100);
    });
});
</script>

@endsection
