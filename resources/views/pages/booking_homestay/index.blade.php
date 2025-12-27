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

        <!-- Card Booking -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar Booking Homestay</h4>

                {{-- ====================== FILTER DAN SEARCH (SAMA SEPERTI KAMAR HOMESTAY) ====================== --}}
                <!-- Form Filter dan Search -->
                <form method="GET" action="{{ route('booking-homestay.index') }}">
                    <div class="row mb-4">
                        <!-- Filter Status -->
                        <div class="col-md-3">
                            <select name="status" onchange="this.form.submit()" class="form-control form-control-sm filter-rating">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        <!-- Filter Tanggal -->
                        <div class="col-md-3">
                            <input type="date" name="tanggal" class="form-control form-control-sm filter-rating"
                                   value="{{ request('tanggal') }}" onchange="this.form.submit()"
                                   placeholder="Filter Tanggal">
                        </div>

                        <!-- Form Search -->
                        <div class="col-md-3">
                            <div class="input-group search-group">
                                <input type="text"
                                       name="search"
                                       class="form-control form-control-sm search-input"
                                       placeholder="Cari nama warga/kamar..."
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
                        <div class="col-md-3 text-right">
                            <a href="{{ route('booking-homestay.create') }}" class="btn btn-primary btn-sm add-btn">
                                <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Booking
                            </a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Warga</th>
                                <th>Kamar & Homestay</th>
                                <th class="text-center">Check-in/out</th>
                                <th class="text-center">Durasi</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $item)
                                <tr class="booking-card">
                                    <td class="text-center">
                                        <span class="badge badge-info">{{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <i class="mdi mdi-account-circle text-primary" style="font-size: 24px;"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold text-primary">{{ $item->warga->nama ?? '-' }}</div>
                                                <small class="text-muted">ID: {{ $item->warga_id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="font-weight-bold">{{ $item->kamar->nama_kamar ?? '-' }}</div>
                                            <small class="text-muted">
                                                {{ $item->kamar->homestay->nama ?? 'Homestay tidak ditemukan' }}
                                            </small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            <div class="badge badge-info mb-1">{{ $item->checkin->format('d/m/Y') }}</div>
                                            <div>s/d</div>
                                            <div class="badge badge-warning mt-1">{{ $item->checkout->format('d/m/Y') }}</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-light py-2 px-3">
                                            {{ $item->checkin->diffInDays($item->checkout) }} Hari
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success py-2 px-3">
                                            <i class="mdi mdi-cash mr-1"></i>Rp {{ number_format($item->total, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'confirmed' => 'info',
                                                'paid' => 'primary',
                                                'cancelled' => 'danger',
                                                'completed' => 'success'
                                            ];
                                            $statusLabels = [
                                                'pending' => 'Pending',
                                                'confirmed' => 'Confirmed',
                                                'paid' => 'Lunas',
                                                'cancelled' => 'Batal',
                                                'completed' => 'Selesai'
                                            ];
                                            $statusIcons = [
                                                'pending' => 'mdi-clock-outline',
                                                'confirmed' => 'mdi-check-circle',
                                                'paid' => 'mdi-cash-check',
                                                'cancelled' => 'mdi-close-circle',
                                                'completed' => 'mdi-check-all'
                                            ];
                                        @endphp
                                        <span class="badge badge-{{ $statusColors[$item->status] ?? 'secondary' }} py-2 px-3">
                                            <i class="mdi {{ $statusIcons[$item->status] ?? 'mdi-information' }} mr-1"></i>
                                            {{ $statusLabels[$item->status] ?? $item->status }}
                                        </span>
                                    </td>
                                    <td class="text-center action-buttons">
                                        <div class="btn-group" role="group">
                                            <!-- TAMBAHKAN TOMBOL LIHAT DETAIL -->
                                            <a href="{{ route('booking-homestay.edit', $item->booking_id) }}"
                                               class="btn btn-outline-info btn-sm action-btn" data-toggle="tooltip" title="Edit Data">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                              <a href="{{ route('booking-homestay.show', $item->booking_id) }}"
                                               class="btn btn-outline-primary btn-sm action-btn" data-toggle="tooltip" title="Lihat Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <form action="{{ route('booking-homestay.destroy', $item->booking_id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm action-btn"
                                                        data-toggle="tooltip" title="Hapus Data"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus booking untuk {{ $item->warga->nama ?: "warga ini" }}?')">
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
                                            <i class="mdi mdi-calendar-remove text-muted" style="font-size: 64px;"></i>
                                            <h4 class="text-muted mt-3">
                                                @if(request()->hasAny(['search', 'status', 'tanggal']))
                                                    Tidak ditemukan booking dengan filter yang dipilih
                                                @else
                                                    Belum ada data booking
                                                @endif
                                            </h4>
                                            <p class="text-muted">Silakan tambah booking terlebih dahulu</p>
                                            <a href="{{ route('booking-homestay.create') }}" class="btn btn-success mt-2">
                                                <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Booking Pertama
                                            </a>
                                            @if(request()->hasAny(['search', 'status', 'tanggal']))
                                                <a href="{{ route('booking-homestay.index') }}" class="btn btn-secondary mt-2">
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
                    {{ $bookings->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>

                <!-- Info Summary -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-success summary-card">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-information-outline mr-2" style="font-size: 24px;"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Total Booking: {{ $bookings->total() }}</h6>
                                    <p class="mb-0">Menampilkan {{ $bookings->count() }} data dari total {{ $bookings->total() }} data booking</p>
                                    <small class="mb-0">Halaman {{ $bookings->currentPage() }} dari {{ $bookings->lastPage() }}</small>
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
.booking-card {
    transition: all 0.3s ease;
    position: relative;
}

.booking-card:hover {
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

.action-btn.btn-outline-primary:hover {
    background-color: #4e73df !important;
    border-color: #4e73df !important;
    color: white !important;
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

/* STYLING BADGE BOOKING */
.badge-success {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    font-weight: bold;
}

.badge-info {
    background: linear-gradient(45deg, #17a2b8, #39c0ed);
    color: white;
}

.badge-warning {
    background: linear-gradient(45deg, #ffc107, #ffd54f);
    color: white;
}

.badge-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
    color: white;
}

.badge-danger {
    background: linear-gradient(45deg, #dc3545, #e4606d);
    color: white;
}

.badge-secondary {
    background: linear-gradient(45deg, #6c757d, #868e96);
    color: white;
}

.badge-light {
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    color: #495057;
    border: 1px solid #dee2e6;
}

.table-responsive {
    overflow-x: auto;
}

/* Styling untuk Info Filter Aktif */
.alert-success {
    border-left: 4px solid #28a745;
    background-color: #f8f9fa;
    border-color: #d1d3e2;
}

.alert-success .badge {
    font-size: 0.85rem;
    padding: 0.4rem 0.75rem;
    border-radius: 20px;
    font-weight: 500;
}

.alert-success .badge-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}

.alert-success .badge-info {
    background: linear-gradient(45deg, #17a2b8, #39c0ed);
}

.alert-success .btn-light {
    border: 1px solid #ddd;
    transition: all 0.3s ease;
}

.alert-success .btn-light:hover {
    background-color: #f45c4e;
    color: white;
    border-color: #f45c4e;
}

/* Status Indicator */
.status-indicator {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 8px;
}

.status-pending {
    background-color: #ffc107;
    box-shadow: 0 0 5px #ffc107;
}

.status-confirmed {
    background-color: #17a2b8;
    box-shadow: 0 0 5px #17a2b8;
}

.status-paid {
    background-color: #4e73df;
    box-shadow: 0 0 5px #4e73df;
}

.status-cancelled {
    background-color: #dc3545;
    box-shadow: 0 0 5px #dc3545;
}

.status-completed {
    background-color: #28a745;
    box-shadow: 0 0 5px #28a745;
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

    .table td, .table th {
        padding: 0.75rem;
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .booking-card td {
        padding: 10px 5px;
    }

    .d-flex.align-items-center {
        flex-direction: column;
        align-items: flex-start;
    }

    .badge {
        font-size: 0.75rem;
        padding: 4px 8px;
    }

    .action-buttons .btn-group {
        flex-direction: row;
        gap: 3px;
    }

    .action-buttons .btn {
        width: 30px;
        height: 30px;
        font-size: 12px;
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

/* Table row hover effect */
.table-hover tbody tr:hover {
    background-color: rgba(78, 115, 223, 0.05);
}

/* Card styling */
.card {
    border-radius: 12px;
    overflow: hidden;
    border: none;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.card-title {
    color: #333;
    font-weight: 600;
    font-size: 1.5rem;
}

/* Empty state animation */
.empty-state i {
    opacity: 0.5;
    transition: opacity 0.3s ease;
}

.empty-state:hover i {
    opacity: 0.8;
}

/* Filter section styling */
.row.mb-4 {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px !important;
}

/* Icon styling */
.mdi-account-circle {
    color: #4e73df;
}

.mdi-calendar-check {
    color: #28a745;
}

.mdi-calendar-remove {
    color: #dc3545;
}

.mdi-cash {
    color: #ffc107;
}

/* Animation for table rows */
@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.booking-card {
    animation: slideInRight 0.5s ease forwards;
    animation-delay: calc(var(--row-index) * 0.1s);
    opacity: 0;
}

.booking-card:nth-child(1) { --row-index: 1; }
.booking-card:nth-child(2) { --row-index: 2; }
.booking-card:nth-child(3) { --row-index: 3; }
.booking-card:nth-child(4) { --row-index: 4; }
.booking-card:nth-child(5) { --row-index: 5; }
.booking-card:nth-child(6) { --row-index: 6; }
.booking-card:nth-child(7) { --row-index: 7; }
.booking-card:nth-child(8) { --row-index: 8; }
.booking-card:nth-child(9) { --row-index: 9; }
.booking-card:nth-child(10) { --row-index: 10; }

/* Tooltip styling */
.tooltip-inner {
    background-color: #333;
    color: white;
    border-radius: 6px;
    padding: 5px 10px;
    font-size: 12px;
}

.tooltip.bs-tooltip-top .arrow::before {
    border-top-color: #333;
}

.tooltip.bs-tooltip-bottom .arrow::before {
    border-bottom-color: #333;
}

.tooltip.bs-tooltip-left .arrow::before {
    border-left-color: #333;
}

.tooltip.bs-tooltip-right .arrow::before {
    border-right-color: #333;
}

/* Alert animation */
.alert {
    animation: slideDown 0.5s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Button group styling */
.btn-group {
    border-radius: 6px;
    overflow: hidden;
}

.btn-group .btn {
    border-radius: 0;
}

.btn-group .btn:first-child {
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
}

.btn-group .btn:last-child {
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px;
}

/* Text truncation */
.text-truncate {
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

@media (max-width: 768px) {
    .text-truncate {
        max-width: 100px;
    }
}

@media (max-width: 576px) {
    .text-truncate {
        max-width: 80px;
    }
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
    const tableRows = document.querySelectorAll('.booking-card');
    tableRows.forEach((row, index) => {
        row.style.animationDelay = (index * 0.1) + 's';
    });

    // Trigger animation on page load
    setTimeout(() => {
        tableRows.forEach(row => {
            row.style.opacity = '1';
        });
    }, 100);

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

    // Animasi untuk action buttons
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.05)';
            this.style.boxShadow = '0 6px 15px rgba(0, 0, 0, 0.2)';
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
        });
    });

    // Animasi untuk summary card
    const summaryCard = document.querySelector('.summary-card');
    if (summaryCard) {
        summaryCard.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.15)';
        });

        summaryCard.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 6px 20px rgba(0, 0, 0, 0.1)';
        });
    }

    // Konfirmasi sebelum hapus
    const deleteButtons = document.querySelectorAll('form[action*="destroy"] button[type="submit"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                e.preventDefault();
                return false;
            }
        });
    });

    // Auto dismiss alerts setelah 5 detik
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + F untuk focus ke search
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            if (searchInput) {
                searchInput.focus();
            }
        }

        // Esc untuk clear search
        if (e.key === 'Escape' && searchInput && searchInput.value) {
            searchInput.value = '';
            searchInput.focus();
        }

        // Ctrl/Cmd + N untuk tambah baru
        if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
            e.preventDefault();
            const addButton = document.querySelector('.add-btn');
            if (addButton) {
                addButton.click();
            }
        }
    });

    // Add loading state untuk tombol aksi
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-1"></i> Memproses...';
                submitButton.disabled = true;

                // Reset setelah 5 detik (fallback jika submit gagal)
                setTimeout(() => {
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                }, 5000);
            }
        });
    });

    // Responsive table adjustment
    function adjustTableForMobile() {
        const table = document.querySelector('.table-responsive');
        if (window.innerWidth < 768 && table) {
            table.style.overflowX = 'auto';
            table.style.WebkitOverflowScrolling = 'touch';
        }
    }

    adjustTableForMobile();
    window.addEventListener('resize', adjustTableForMobile);

    // Smooth scroll untuk pagination
    document.querySelectorAll('.page-link').forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.getAttribute('href') && this.getAttribute('href').includes('page=')) {
                e.preventDefault();
                const url = this.getAttribute('href');

                // Smooth scroll ke atas
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

                // Load halaman setelah scroll
                setTimeout(() => {
                    window.location.href = url;
                }, 500);
            }
        });
    });
});
</script>

@endsection
