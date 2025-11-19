@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

        {{-- ====================== START MAIN CONTENT ====================== --}}


        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-star text-warning mr-2"></i>
                Ulasan Wisata
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ulasan Wisata</li>
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

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle-outline mr-2"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Ulasan</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalUlasan }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                                    <i class="mdi mdi-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Rating Rata-rata</h5>
                                <span class="h2 font-weight-bold mb-0">{{ number_format($avgRating, 1) }}/5</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                    <i class="mdi mdi-chart-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Destinasi Wisata</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalDestinasi }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="mdi mdi-map-marker"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Ulasan Bulan Ini</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $ulasanBulanIni }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                    <i class="mdi mdi-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Data Ulasan Wisata -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Data Ulasan Wisata</h4>
                    <div class="d-flex">
                        <input type="text" class="form-control form-control-sm mr-2" placeholder="Cari ulasan..." id="searchInput" style="width: 200px;">
                        <select class="form-control form-control-sm" id="ratingFilter" style="width: 150px;">
                            <option value="">Semua Rating</option>
                            <option value="5">⭐ 5 Bintang</option>
                            <option value="4">⭐ 4 Bintang</option>
                            <option value="3">⭐ 3 Bintang</option>
                            <option value="2">⭐ 2 Bintang</option>
                            <option value="1">⭐ 1 Bintang</option>
                        </select>
                        <a href="{{ route('ulasan_wisata.create') }}" class="btn btn-primary btn-sm ml-2">
                            <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Ulasan
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Destinasi Wisata</th>
                                <th>Nama Warga</th>
                                <th class="text-center">Rating</th>
                                <th>Komentar</th>
                                <th class="text-center">Waktu</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ulasan as $item)
                            <tr>
                                <td class="text-center">
                                    <span class="badge badge-info">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <i class="mdi mdi-map-marker text-primary" style="font-size: 24px;"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">{{ $item->destinasi->nama }}</div>
                                            <small class="text-muted">{{ Str::limit($item->destinasi->alamat, 30) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <i class="mdi mdi-account text-success" style="font-size: 24px;"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">{{ $item->warga->nama ?? 'N/A' }}</div>
                                            <small class="text-muted">{{ $item->warga->email ?? '' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="rating-badge mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="mdi mdi-star {{ $i <= $item->rating ? 'text-warning' : 'text-light' }}" style="font-size: 16px;"></i>
                                        @endfor
                                    </div>
                                    <span class="badge badge-warning">{{ $item->rating }}/5</span>
                                </td>
                                <!-- Kolom Komentar -->
<td>
    <div class="comment-text" style="white-space: pre-line; word-wrap: break-word; line-height: 1.5; max-width: 300px;">
        {{ $item->komentar }}
    </div>
    @if(strlen($item->komentar) > 150)
    <button class="btn btn-link btn-sm p-0 mt-1 read-more-btn"
            data-comment="{{ $item->komentar }}"
            data-toggle="modal"
            data-target="#commentModal">
        <small><i class="mdi mdi-chevron-double-down mr-1"></i>selengkapnya</small>
    </button>
    @endif
</td>
                                <td class="text-center">
                                    <small class="text-muted">
                                        {{ $item->waktu->format('d M Y') }}<br>
                                        <span class="text-dark">{{ $item->waktu->format('H:i') }}</span>
                                    </small>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusConfig = [
                                            1 => ['class' => 'badge-danger', 'text' => 'Sangat Buruk'],
                                            2 => ['class' => 'badge-warning', 'text' => 'Buruk'],
                                            3 => ['class' => 'badge-info', 'text' => 'Cukup'],
                                            4 => ['class' => 'badge-primary', 'text' => 'Baik'],
                                            5 => ['class' => 'badge-success', 'text' => 'Sangat baik']
                                        ];
                                        $status = $statusConfig[$item->rating] ?? ['class' => 'badge-secondary', 'text' => '-'];
                                    @endphp
                                    <span class="badge {{ $status['class'] }} py-2 px-3">
                                        {{ $status['text'] }}
                                    </span>
                                </td>
                                <td class="text-center action-buttons">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('ulasan_wisata.edit', $item->ulasan_id) }}"
                                           class="btn btn-outline-info btn-sm"
                                           data-toggle="tooltip"
                                           title="Edit Data">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('ulasan_wisata.destroy', $item->ulasan_id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm"
                                                    data-toggle="tooltip"
                                                    title="Hapus Data"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
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
                                        <i class="mdi mdi-star-off-outline text-muted" style="font-size: 64px;"></i>
                                        <h4 class="text-muted mt-3">Belum ada data ulasan</h4>
                                        <p class="text-muted">Silakan tambah data ulasan terlebih dahulu</p>
                                        <a href="{{ route('ulasan_wisata.create') }}" class="btn btn-primary mt-2">
                                            <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Ulasan Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Info Summary -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-information-outline mr-2" style="font-size: 24px;"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Total Data Ulasan: {{ $ulasan->count() }}</h6>
                                    <p class="mb-0">Data ulasan wisata yang terdaftar dalam sistem Bina Desa</p>
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

<!-- Modal for full comment -->
<div class="modal fade" id="commentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Komentar Lengkap</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="fullComment"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Enhanced Stats Cards Styles */
    .card-stats {
        margin-bottom: 0;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fe 100%);
        position: relative;
        overflow: hidden;
    }

    .card-stats::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #4e73df, #224abe);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .card-stats:hover::before {
        transform: scaleX(1);
    }

    .card-stats:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
    }

    .card-stats .card-body {
        padding: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .icon-shape {
        width: 4rem;
        height: 4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .icon-shape::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: inherit;
        border-radius: 50%;
        filter: blur(8px);
        opacity: 0.6;
        transition: all 0.4s ease;
    }

    .card-stats:hover .icon-shape {
        transform: scale(1.1) rotate(5deg);
    }

    .card-stats:hover .icon-shape::before {
        opacity: 0.8;
        filter: blur(12px);
    }

    /* Specific gradient backgrounds for each card */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%) !important;
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #36b9cc 0%, #258391 100%) !important;
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%) !important;
    }

    /* Card title and number styling */
    .card-title.text-uppercase {
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        color: #6e707e !important;
    }

    .card-stats .h2 {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #2e3a59, #1a1f33);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        transition: all 0.3s ease;
    }

    .card-stats:hover .h2 {
        background: linear-gradient(135deg, #4e73df, #224abe);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Animation for numbers */
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-stats .h2 {
        animation: countUp 0.8s ease-out;
    }

    /* Pulse animation on hover */
    @keyframes pulse-glow {
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

    .card-stats:hover {
        animation: pulse-glow 2s infinite;
    }

    /* Existing styles remain the same */
    .rating-badge .mdi.text-light {
        color: #e4e6ef !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(41, 98, 255, 0.05);
        transform: translateY(-1px);
        transition: all 0.3s ease;
    }
    .action-buttons .btn {
        border-radius: 8px;
        margin: 2px;
    }
    .comment-text {
        max-width: 200px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Read more functionality
    document.querySelectorAll('.read-more').forEach(function(element) {
        element.addEventListener('click', function() {
            document.getElementById('fullComment').textContent = this.getAttribute('data-comment');
            $('#commentModal').modal('show');
        });
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('table tbody tr').forEach(function(row) {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Rating filter functionality
    document.getElementById('ratingFilter').addEventListener('change', function(e) {
        const rating = e.target.value;
        document.querySelectorAll('table tbody tr').forEach(function(row) {
            if (!rating) {
                row.style.display = '';
                return;
            }
            const rowRating = row.querySelector('.badge-warning')?.textContent?.split('/')[0];
            row.style.display = rowRating === rating ? '' : 'none';
        });
    });

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Add scroll animation for stats cards
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe stats cards for scroll animation
    document.querySelectorAll('.card-stats').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease-out';
        observer.observe(card);
    });
});
</script>

@endsection
