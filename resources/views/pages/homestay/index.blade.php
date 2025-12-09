@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

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

                <!-- Tombol Tambah -->
                <div class="row mb-4">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('homestay.create') }}" class="btn btn-primary btn-sm add-btn">
                            <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Homestay
                        </a>
                    </div>
                </div>

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
                                            <h4 class="text-muted mt-3">Belum ada data homestay</h4>
                                            <p class="text-muted">Silakan tambah homestay terlebih dahulu</p>
                                            <a href="{{ route('homestay.create') }}" class="btn btn-success mt-2">
                                                <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Homestay Pertama
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
                    {{ $homestays->links('pagination::bootstrap-5') }}
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
    </div>
</div>

<style>
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

.add-btn {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.add-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(78, 115, 223, 0.4);
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    $('[data-toggle="tooltip"]').tooltip();

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
