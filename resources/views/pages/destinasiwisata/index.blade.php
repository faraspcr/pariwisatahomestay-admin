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

<!-- Card Destinasi Wisata -->
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Daftar Destinasi Wisata</h4>

        <!-- ==================== FORM FILTER DAN SEARCH ==================== -->
        <form method="GET" action="{{ route('destinasiwisata.index') }}">
            <div class="row mb-4">
                <!-- Filter Jam Buka -->
                <div class="col-md-3">
                    <select name="jam_buka" onchange="this.form.submit()" class="form-control form-control-sm filter-rating">
                        <option value="">Semua Jam Buka</option>
                        <option value="dini_hari" {{ request('jam_buka') == 'dini_hari' ? 'selected' : '' }}>🕛 Dini Hari (00:00 - 05:59)</option>
                        <option value="pagi" {{ request('jam_buka') == 'pagi' ? 'selected' : '' }}>🌅 Pagi (06:00 - 10:59)</option>
                        <option value="siang" {{ request('jam_buka') == 'siang' ? 'selected' : '' }}>☀️ Siang (11:00 - 14:59)</option>
                        <option value="sore" {{ request('jam_buka') == 'sore' ? 'selected' : '' }}>🌇 Sore (15:00 - 18:59)</option>
                        <option value="malam" {{ request('jam_buka') == 'malam' ? 'selected' : '' }}>🌙 Malam (19:00 - 23:59)</option>
                    </select>
                </div>

                <!-- Form Search -->
                <div class="col-md-3">
                    <div class="input-group search-group">
                        <input type="text"
                               name="search"
                               class="form-control form-control-sm search-input"
                               placeholder="Cari data destinasi..."
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
                    <a href="{{ route('destinasiwisata.create') }}" class="btn btn-primary btn-sm add-btn">
                        <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Destinasi
                    </a>
                </div>
            </div>
        </form>
        <!-- ==================== END FORM FILTER DAN SEARCH ==================== -->

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nama Destinasi</th>
                        <th style="min-width: 250px;">Deskripsi</th>
                        <th>Lokasi</th>
                        <th class="text-center">RT/RW</th>
                        <th class="text-center">Jam Buka</th>
                        <th class="text-center">Tiket</th>
                        <th>Kontak</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinasiWisata as $item)
                        <tr class="destination-card">
                            <td class="text-center">
                                <span class="badge badge-info">{{ ($destinasiWisata->currentPage() - 1) * $destinasiWisata->perPage() + $loop->iteration }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <i class="mdi mdi-map-marker-circle text-success"
                                            style="font-size: 24px;"></i>
                                    </div>
                                    <div>
                                        <div class="font-weight-bold text-success">
                                            {{ $item->nama }}</div>
                                        <small class="text-muted">ID:
                                            {{ $item->destinasi_id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="description-text" style="white-space: pre-line; max-width: 250px; line-height: 1.4;">
                                    {{ $item->deskripsi }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-map-marker mr-2 text-primary"></i>
                                    <span class="text-truncate"
                                        style="max-width: 150px;">{{ $item->alamat }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-location py-2 px-3">
                                    <i
                                        class="mdi mdi-home-map-marker mr-1"></i>{{ $item->rt }}/{{ $item->rw }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-time py-2 px-3">
                                    <i
                                        class="mdi mdi-clock-outline mr-1"></i>{{ $item->jam_buka }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-price py-2 px-3">
                                    <i class="mdi mdi-ticket mr-1"></i>Rp
                                    {{ number_format($item->tiket, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-phone mr-2 text-warning"></i>
                                    <span class="font-weight-bold">{{ $item->kontak }}</span>
                                </div>
                            </td>
                            <td class="text-center action-buttons">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('destinasiwisata.edit', $item->destinasi_id) }}"
                                        class="btn btn-outline-info btn-sm action-btn" data-toggle="tooltip"
                                        title="Edit Data">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <a href="{{ route('destinasiwisata.show', $item->destinasi_id) }}"
                                        class="btn btn-outline-primary btn-sm action-btn"
                                        data-toggle="tooltip" title="Lihat Detail">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                    <form
                                        action="{{ route('destinasiwisata.destroy', $item->destinasi_id) }}"
                                        method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-outline-danger btn-sm action-btn"
                                            data-toggle="tooltip" title="Hapus Data"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi wisata {{ $item->nama }}?')">
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
                                    <i class="mdi mdi-map-marker-off text-muted"
                                        style="font-size: 64px;"></i>
                                    <h4 class="text-muted mt-3">Belum ada data destinasi wisata
                                    </h4>
                                    <p class="text-muted">Silakan tambah destinasi wisata terlebih
                                        dahulu</p>
                                    <a href="{{ route('destinasiwisata.create') }}"
                                        class="btn btn-success mt-2">
                                        <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah
                                        Destinasi Pertama
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
            {{ $destinasiWisata->links('pagination::bootstrap-5') }}
        </div>

        <!-- Info Summary -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="alert alert-success summary-card">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-information-outline mr-2" style="font-size: 24px;"></i>
                        <div>
                            <h6 class="alert-heading mb-1">Total Destinasi Wisata: {{ $destinasiWisata->total() }}</h6>
                            <p class="mb-0">Menampilkan {{ $destinasiWisata->count() }} data dari total {{ $destinasiWisata->total() }} data destinasi wisata</p>
                            <small class="mb-0">Halaman {{ $destinasiWisata->currentPage() }} dari {{ $destinasiWisata->lastPage() }}</small>
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
    height: 38px !important;
    font-size: 14px;
    border-radius: 8px;
}

.search-group {
    height: 38px;
    border-radius: 8px;
}

.search-btn,
.clear-btn {
    height: 38px !important;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 12px;
}

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
.destination-card {
    transition: all 0.3s ease;
    position: relative;
}

.destination-card:hover {
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

/* STYLING BADGE DESTINASI WISATA */
.badge-price {
    background: linear-gradient(45deg, #FF6B35, #FF8E53);
    color: white;
    font-weight: bold;
}

.badge-time {
    background: linear-gradient(45deg, #4CAF50, #66BB6A);
    color: white;
}

.badge-location {
    background: linear-gradient(45deg, #2196F3, #64B5F6);
    color: white;
}

.description-text {
    white-space: pre-line;
    word-wrap: break-word;
    line-height: 1.4;
    padding: 4px 0;
}

.table-responsive {
    overflow-x: auto;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    $('[data-toggle="tooltip"]').tooltip();

    const searchForm = document.querySelector('form[method="GET"]');
    const searchInput = document.querySelector('.search-input');
    const searchButton = document.querySelector('.search-btn');

    if (searchForm && searchButton) {
        searchForm.addEventListener('submit', function(e) {
            if (searchInput.value.trim() !== '') {
                searchButton.classList.add('search-loading');
                const originalHTML = searchButton.innerHTML;
                searchButton.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-1"></i>';

                setTimeout(() => {
                    searchButton.classList.remove('search-loading');
                    searchButton.innerHTML = originalHTML;
                }, 2000);
            }
        });
    }

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

    const jamBukaSelect = document.querySelector('.filter-rating');
    if (jamBukaSelect) {
        jamBukaSelect.addEventListener('change', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }

    const tableRows = document.querySelectorAll('.destination-card');
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
