@extends('layouts.app')
@section('content')

        {{-- ====================== START MAIN CONTENT ====================== --}}
        <!-- Alert Success -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-circle-outline mr-2"></i>
                <strong>Sukses!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle-outline mr-2"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Card Homestay -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar Homestay</h4>

                {{-- ====================== FILTER DAN SEARCH (SEPERTI WARGA) ====================== --}}
                <!-- Form Filter dan Search -->
                <form method="GET" action="{{ route('homestay.index') }}">
                    <div class="row mb-4">
                        <!-- Filter Status -->
                        <div class="col-md-3">
                            <select name="status" onchange="this.form.submit()" class="form-control form-control-sm filter-rating">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div>

                        <!-- Form Search -->
                        <div class="col-md-3">
                            <div class="input-group search-group">
                                <input type="text"
                                       name="search"
                                       class="form-control form-control-sm search-input"
                                       placeholder="Cari nama/alamat/pemilik..."
                                       value="{{ request('search') }}">
                                <button type="submit" class="input-group-text search-btn">
                                    <i class="mdi mdi-magnify"></i>
                                </button>
                                @if(request("search"))
                                <a href="{{ request()->fullUrlWithQuery(['search'=> null]) }}" class="input-group-text clear-btn">
                                    <i class="mdi mdi-close"></i>
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Tombol Tambah -->
                        <div class="col-md-6 text-right">
                            <a href="{{ route('homestay.create') }}" class="btn btn-primary btn-sm add-btn">
                                <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Homestay
                            </a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Homestay</th>
                                <th>Pemilik</th>
                                <th>Alamat</th>
                                <th class="text-center">RT/RW</th>
                                <th class="text-center">Harga/Malam</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($homestays as $item)
                                <tr class="homestay-card">
                                    <td class="text-center">
                                        <span class="badge badge-info">{{ ($homestays->currentPage() - 1) * $homestays->perPage() + $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <i class="mdi mdi-home-circle text-success" style="font-size: 24px;"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold text-success">{{ $item->nama }}</div>
                                                <small class="text-muted">ID: {{ $item->homestay_id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-account mr-2 text-primary"></i>
                                            <span>{{ $item->pemilik->nama ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-map-marker mr-2 text-warning"></i>
                                            <span class="text-truncate" style="max-width: 200px;">{{ $item->alamat }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-location py-2 px-3">
                                            <i class="mdi mdi-home-map-marker mr-1"></i>{{ $item->rt ?? '-' }}/{{ $item->rw ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-price py-2 px-3">
                                            <i class="mdi mdi-cash mr-1"></i>Rp {{ number_format($item->harga_per_malam, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($item->status == 'aktif')
                                            <span class="badge badge-success py-2 px-3">
                                                <i class="mdi mdi-check-circle mr-1"></i>Aktif
                                            </span>
                                        @elseif($item->status == 'nonaktif')
                                            <span class="badge badge-danger py-2 px-3">
                                                <i class="mdi mdi-close-circle mr-1"></i>Nonaktif
                                            </span>
                                        @else
                                            <span class="badge badge-warning py-2 px-3">
                                                <i class="mdi mdi-clock-outline mr-1"></i>Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center action-buttons">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('homestay.edit', $item->homestay_id) }}"
                                               class="btn btn-outline-info btn-sm action-btn" data-toggle="tooltip" title="Edit Data">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="{{ route('homestay.show', $item->homestay_id) }}"
                                               class="btn btn-outline-primary btn-sm action-btn" data-toggle="tooltip" title="Lihat Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <form action="{{ route('homestay.destroy', $item->homestay_id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm action-btn"
                                                        data-toggle="tooltip" title="Hapus Data"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus homestay {{ $item->nama }}?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center empty-state">
                                            <i class="mdi mdi-home-off text-muted" style="font-size: 64px;"></i>
                                            <h4 class="text-muted mt-3">
                                                @if(request()->hasAny(['search', 'status']))
                                                    Tidak ditemukan homestay dengan filter yang dipilih
                                                @else
                                                    Belum ada data homestay
                                                @endif
                                            </h4>
                                            <p class="text-muted">Silakan tambah homestay terlebih dahulu</p>
                                            <a href="{{ route('homestay.create') }}" class="btn btn-success mt-2">
                                                <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Homestay Pertama
                                            </a>
                                            @if(request()->hasAny(['search', 'status']))
                                                <a href="{{ route('homestay.index') }}" class="btn btn-secondary mt-2">
                                                    <i class="mdi mdi-refresh mr-1"></i>Reset Filter
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ====================== PAGINATION ====================== --}}
                <div class="mt-4">
                    {{ $homestays->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>

                <!-- Info Summary -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-success summary-card">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-information-outline mr-2" style="font-size: 24px;"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Total Homestay: {{ $homestays->total() }}</h6>
                                    <p class="mb-0">Menampilkan {{ $homestays->count() }} data dari total {{ $homestays->total() }} data homestay</p>
                                    <small class="mb-0">Halaman {{ $homestays->currentPage() }} dari {{ $homestays->lastPage() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ====================== END MAIN CONTENT ====================== --}}

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
    min-width: 40px;
}

/* Animasi untuk Filter Status */
.filter-rating {
    border: 1px solid #ddd;
    transition: all 0.3s ease;
    cursor: pointer;
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
    color: #6c757d;
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
    color: #6c757d;
    text-decoration: none;
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
    padding: 8px 16px;
    font-weight: 500;
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
.homestay-card {
    transition: all 0.3s ease;
    position: relative;
}

.homestay-card:hover {
    background-color: rgba(76, 175, 80, 0.05) !important;
    transform: translateX(5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

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

.action-btn.btn-outline-primary:hover {
    background-color: #4e73df !important;
    border-color: #4e73df !important;
    color: white !important;
}

.action-btn.btn-outline-danger:hover {
    background-color: #e74a3b !important;
    border-color: #e74a3b !important;
    color: white !important;
}

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

.summary-card {
    transition: all 0.3s ease;
    border-radius: 10px;
}

.summary-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

/* STYLING BADGE HOMESTAY */
.badge-price {
    background: linear-gradient(45deg, #FF6B35, #FF8E53);
    color: white;
    font-weight: bold;
}

.badge-location {
    background: linear-gradient(45deg, #2196F3, #64B5F6);
    color: white;
}

.badge-success {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
}

.badge-danger {
    background: linear-gradient(45deg, #dc3545, #e4606d);
    color: white;
}

.badge-warning {
    background: linear-gradient(45deg, #ffc107, #ffd54f);
    color: white;
}

.table-responsive {
    overflow-x: auto;
}

/* Styling untuk Info Filter Aktif */
.alert-info {
    border-left: 4px solid #36b9cc;
    background-color: #f8f9fa;
    border-color: #d1d3e2;
}

.alert-info .badge {
    font-size: 0.85rem;
    padding: 0.4rem 0.75rem;
    border-radius: 20px;
    font-weight: 500;
}

.alert-info .badge-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}

.alert-info .badge-info {
    background: linear-gradient(45deg, #36b9cc, #258391);
}

.alert-info .btn-light {
    border: 1px solid #ddd;
    transition: all 0.3s ease;
}

.alert-info .btn-light:hover {
    background-color: #f45c4e;
    color: white;
    border-color: #f45c4e;
}

/* Responsive Design */
@media (max-width: 768px) {
    .row.mb-4 > div {
        margin-bottom: 10px;
    }

    .col-md-3, .col-md-6 {
        width: 100%;
    }

    .text-right {
        text-align: left !important;
    }

    .add-btn {
        width: 100%;
        justify-content: center;
    }

    .action-buttons .btn-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .action-buttons .btn {
        width: 35px;
        height: 35px;
    }
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
    $('[data-toggle="tooltip"]').tooltip();

    // ==================== ANIMASI UNTUK SEARCH & FILTER ====================

    // Animasi untuk search loading
    const searchForm = document.querySelector('form[method="GET"]');
    const searchInput = document.querySelector('.search-input');
    const searchButton = document.querySelector('.search-btn');

    if (searchForm && searchButton) {
        searchForm.addEventListener('submit', function(e) {
            if (searchInput.value.trim() !== '') {
                // Simpan original content
                const originalHTML = searchButton.innerHTML;

                // Tambah animasi loading
                searchButton.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-1"></i>';
                searchButton.style.pointerEvents = 'none';

                // Reset setelah 1.5 detik (fallback)
                setTimeout(() => {
                    searchButton.innerHTML = originalHTML;
                    searchButton.style.pointerEvents = 'auto';
                }, 1500);
            }
        });
    }

    // Animasi untuk filter select
    const statusSelect = document.querySelector('.filter-rating');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            // Efek visual saat berubah
            this.style.transform = 'scale(0.95)';
            this.style.boxShadow = '0 0 10px rgba(78, 115, 223, 0.3)';

            setTimeout(() => {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = 'none';
            }, 300);
        });
    }

    // Animasi hover untuk clear button
    const clearBtn = document.querySelector('.clear-btn');
    if (clearBtn) {
        clearBtn.addEventListener('mouseenter', function() {
            this.style.transform = 'rotate(90deg) scale(1.1)';
        });

        clearBtn.addEventListener('mouseleave', function() {
            this.style.transform = 'rotate(0) scale(1)';
        });
    }

    // Auto focus ke search input saat clear
    document.addEventListener('click', function(e) {
        if (e.target.closest('.clear-btn')) {
            setTimeout(() => {
                if (searchInput) {
                    searchInput.focus();
                }
            }, 100);
        }
    });

    // Animasi untuk table rows saat load
    const tableRows = document.querySelectorAll('.homestay-card');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateX(-20px)';

        setTimeout(() => {
            row.style.transition = 'all 0.5s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateX(0)';
        }, index * 100);
    });

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
});
</script>

@endsection
