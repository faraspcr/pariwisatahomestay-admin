@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
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

        <!-- Card Booking -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar Booking Homestay</h4>

                <!-- ==================== FORM FILTER DAN SEARCH ==================== -->
                <form method="GET" action="{{ route('booking-homestay.index') }}">
                    <div class="row mb-4">
                        <!-- Filter Status -->
                        <div class="col-md-3">
                            <select name="status" onchange="this.form.submit()" class="form-control form-control-sm">
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
                            <input type="date" name="tanggal" class="form-control form-control-sm"
                                   value="{{ request('tanggal') }}" onchange="this.form.submit()">
                        </div>

                        <!-- Form Search -->
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text"
                                       name="search"
                                       class="form-control form-control-sm"
                                       placeholder="Cari nama warga..."
                                       value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="mdi mdi-magnify"></i>
                                    </button>
                                    @if(request("search"))
                                    <a href="{{ request()->fullUrlWithQuery(['search'=> null]) }}"
                                       class="btn btn-sm btn-secondary">
                                        Clear
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Tambah -->
                        <div class="col-md-3 text-right">
                            <a href="{{ route('booking-homestay.create') }}" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Booking
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
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-info">{{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <i class="mdi mdi-account text-primary" style="font-size: 24px;"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold">{{ $item->warga->nama ?? '-' }}</div>
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
                                        @endphp
                                        <span class="badge badge-{{ $statusColors[$item->status] ?? 'secondary' }} py-2 px-3">
                                            {{ $statusLabels[$item->status] ?? $item->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('booking-homestay.edit', $item->booking_id) }}"
                                               class="btn btn-outline-info btn-sm">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('booking-homestay.destroy', $item->booking_id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Hapus booking ini?')">
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
                                            <i class="mdi mdi-calendar-remove text-muted" style="font-size: 64px;"></i>
                                            <h4 class="text-muted mt-3">Belum ada data booking</h4>
                                            <a href="{{ route('booking-homestay.create') }}" class="btn btn-success mt-2">
                                                <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Booking Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="mt-4">
                    {{ $bookings->links('pagination::bootstrap-5') }}
                </div>

                <!-- Info Summary -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-information-outline mr-2" style="font-size: 24px;"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Total Booking: {{ $bookings->total() }}</h6>
                                    <p class="mb-0">Menampilkan {{ $bookings->count() }} data</p>
                                    <small>Halaman {{ $bookings->currentPage() }} dari {{ $bookings->lastPage() }}</small>
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
.table-responsive {
    overflow-x: auto;
}
</style>

@endsection
