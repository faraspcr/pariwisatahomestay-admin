@extends('layouts.app')
@section('content')

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
        <h4 class="card-title mb-4">Data Ulasan Wisata</h4>

        <!-- Form Filter dan Search -->
        <form method="GET" action="{{ route('ulasan_wisata.index') }}">
            <div class="row mb-4">
                <!-- Filter Rating -->
                <div class="col-md-3">
                    <select name="rating" onchange="this.form.submit()" class="form-control form-control-sm filter-rating">
                        <option value="">Semua Rating</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>⭐ 5 Bintang</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>⭐ 4 Bintang</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>⭐ 3 Bintang</option>
                        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>⭐ 2 Bintang</option>
                        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>⭐ 1 Bintang</option>
                    </select>
                </div>

                <!-- Form Search -->
                <div class="col-md-3">
                    <div class="input-group search-group">
                        <input type="text"
                               name="search"
                               class="form-control form-control-sm search-input"
                               placeholder="Cari ulasan wisata..."
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
                    <a href="{{ route('ulasan_wisata.create') }}" class="btn btn-primary btn-sm add-btn">
                        <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Ulasan
                    </a>
                </div>
            </div>
        </form>

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
                    <tr class="table-row">
                        <td class="text-center">
                            <span class="badge badge-info">{{ ($ulasan->currentPage() - 1) * $ulasan->perPage() + $loop->iteration }}</span>
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
                            <span class="badge badge-warning rating-number">{{ $item->rating }}/5</span>
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
                            <span class="badge status-badge {{ $status['class'] }} py-2 px-3">
                                {{ $status['text'] }}
                            </span>
                        </td>
                        <td class="text-center action-buttons">
                            <div class="btn-group" role="group">
                                <a href="{{ route('ulasan_wisata.edit', $item->ulasan_id) }}"
                                   class="btn btn-outline-info btn-sm action-btn"
                                   data-toggle="tooltip"
                                   title="Edit Data">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <form action="{{ route('ulasan_wisata.destroy', $item->ulasan_id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit"
                                            class="btn btn-outline-danger btn-sm action-btn"
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
                            <div class="d-flex flex-column align-items-center empty-state">
                                <i class="mdi mdi-star-off-outline text-muted" style="font-size: 64px;"></i>
                                <h4 class="text-muted mt-3">Belum ada data ulasan</h4>
                                <p class="text-muted">Silakan tambah data ulasan terlebih dahulu</p>
                                <a href="{{ route('ulasan_wisata.create') }}" class="btn btn-primary mt-2 add-btn">
                                    <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Ulasan Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-4">
            {{ $ulasan->links('pagination::bootstrap-5') }}
        </div>

        <!-- Info Summary -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="alert alert-info summary-card">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-information-outline mr-2" style="font-size: 24px;"></i>
                        <div>
                            <h6 class="alert-heading mb-1">Total Data Ulasan: {{ $totalUlasan }}</h6>
                            <p class="mb-0">Data ulasan wisata yang terdaftar dalam sistem Bina Desa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ====================== END MAIN CONTENT ====================== --}}

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
                <p id="fullComment" style="white-space: pre-line;"></p>
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

    /* ==================== ANIMASI UNTUK SEARCH & FILTER ==================== */

    /* Animasi untuk Filter Rating */
    .filter-rating {
        border: 1px solid #ddd;
        transition: all 0.3s ease;
        border-radius: 8px;
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
    }

    .search-btn:hover {
        background-color: #4e73df !important;
        color: white !important;
        transform: scale(1.05);
    }

    /* Animasi untuk Clear Button */
    .clear-btn {
        transition: all 0.3s ease;
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

    /* Animasi untuk Rating */
    .rating-badge {
        transition: all 0.3s ease;
    }

    .rating-badge:hover {
        transform: scale(1.1);
    }

    .rating-number {
        transition: all 0.3s ease;
    }

    .rating-number:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    /* Animasi untuk Status Badge */
    .status-badge {
        transition: all 0.3s ease;
    }

    .status-badge:hover {
        transform: scale(1.05);
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

    /* Existing styles remain the same */
    .rating-badge .mdi.text-light {
        color: #e4e6ef !important;
    }
    .comment-text {
        max-width: 200px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Read more functionality
    document.querySelectorAll('.read-more-btn').forEach(function(element) {
        element.addEventListener('click', function() {
            document.getElementById('fullComment').textContent = this.getAttribute('data-comment');
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
    const ratingSelect = document.querySelector('.filter-rating');
    if (ratingSelect) {
        ratingSelect.addEventListener('change', function() {
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

    // Animasi untuk rating stars
    const ratingBadges = document.querySelectorAll('.rating-badge');
    ratingBadges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });

        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});
</script>

@endsection
