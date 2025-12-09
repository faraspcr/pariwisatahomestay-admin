@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <!-- Header -->
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-calendar-edit text-success mr-2"></i>
                Edit Booking Homestay
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('booking-homestay.index') }}">Booking Homestay</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Form Edit Booking</h4>

                        <form action="{{ route('booking-homestay.update', $booking->booking_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Kamar Homestay -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kamar Homestay <span class="text-danger">*</span></label>
                                        <select name="kamar_id" class="form-control" id="kamarSelect" required>
                                            <option value="">Pilih Kamar</option>
                                            @foreach($kamars as $kamar)
                                                <option value="{{ $kamar->kamar_id }}"
                                                    data-harga="{{ $kamar->harga }}"
                                                    data-homestay="{{ $kamar->homestay->nama ?? 'Unknown' }}"
                                                    {{ $booking->kamar_id == $kamar->kamar_id ? 'selected' : '' }}>
                                                    {{ $kamar->nama_kamar }} - {{ $kamar->homestay->nama ?? 'Unknown' }}
                                                    (Rp {{ number_format($kamar->harga, 0, ',', '.') }}/malam)
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted" id="homestayInfo"></small>
                                        @error('kamar_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Warga -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Warga <span class="text-danger">*</span></label>
                                        <select name="warga_id" class="form-control" required>
                                            <option value="">Pilih Warga</option>
                                            @foreach($wargas as $warga)
                                                <option value="{{ $warga->warga_id }}"
                                                    {{ $booking->warga_id == $warga->warga_id ? 'selected' : '' }}>
                                                    {{ $warga->nama }} ({{ $warga->nik ?? 'NIK' }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warga_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Check-in -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Check-in <span class="text-danger">*</span></label>
                                        <input type="date" name="checkin" id="checkin" class="form-control"
                                               value="{{ old('checkin', $booking->checkin->format('Y-m-d')) }}" required>
                                        @error('checkin')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Check-out -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Check-out <span class="text-danger">*</span></label>
                                        <input type="date" name="checkout" id="checkout" class="form-control"
                                               value="{{ old('checkout', $booking->checkout->format('Y-m-d')) }}" required>
                                        @error('checkout')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jumlah Hari -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jumlah Hari</label>
                                        <input type="text" id="jumlahHari" class="form-control" readonly>
                                    </div>
                                </div>

                                <!-- Total -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Total (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" name="total" id="total" class="form-control"
                                               value="{{ old('total', $booking->total) }}" min="0" required>
                                        @error('total')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Status -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control" required>
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="paid" {{ $booking->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Metode Bayar -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Metode Bayar</label>
                                        <select name="metode_bayar" class="form-control">
                                            <option value="">Pilih Metode</option>
                                            <option value="cash" {{ $booking->metode_bayar == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="transfer" {{ $booking->metode_bayar == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                            <option value="qris" {{ $booking->metode_bayar == 'qris' ? 'selected' : '' }}>QRIS</option>
                                            <option value="other" {{ $booking->metode_bayar == 'other' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('metode_bayar')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save mr-1"></i> Update
                                </button>
                                <a href="{{ route('booking-homestay.index') }}" class="btn btn-light">
                                    <i class="mdi mdi-arrow-left mr-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-calendar-text text-primary mr-2"></i>
                            Detail Booking
                        </h5>

                        <div class="info-box mb-3">
                            <div class="info-box-content">
                                <span class="info-box-text">ID Booking</span>
                                <span class="info-box-number">{{ $booking->booking_id }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3">
                            <div class="info-box-content">
                                <span class="info-box-text">Tanggal Booking</span>
                                <span class="info-box-number">{{ $booking->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3">
                            <div class="info-box-content">
                                <span class="info-box-text">Warga</span>
                                <span class="info-box-number">{{ $booking->warga->nama ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3">
                            <div class="info-box-content">
                                <span class="info-box-text">Kamar</span>
                                <span class="info-box-number">{{ $booking->kamar->nama_kamar ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3">
                            <div class="info-box-content">
                                <span class="info-box-text">Homestay</span>
                                <span class="info-box-number">{{ $booking->kamar->homestay->nama ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="info-box mb-3">
                            <div class="info-box-content">
                                <span class="info-box-text">Durasi</span>
                                <span class="info-box-number">{{ $booking->checkin->diffInDays($booking->checkout) }} Hari</span>
                            </div>
                        </div>

                        <div class="alert alert-{{
                            $booking->status == 'cancelled' ? 'danger' :
                            ($booking->status == 'completed' ? 'success' :
                            ($booking->status == 'paid' ? 'primary' :
                            ($booking->status == 'confirmed' ? 'info' : 'warning')))
                        }}">
                            <h6><i class="mdi mdi-information-outline mr-2"></i> Status Saat Ini</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold">{{ strtoupper($booking->status) }}</span>
                                @if($booking->metode_bayar)
                                    <span class="badge badge-light">{{ $booking->metode_bayar }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const kamarSelect = document.getElementById('kamarSelect');
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const jumlahHariInput = document.getElementById('jumlahHari');
    const totalInput = document.getElementById('total');
    const homestayInfo = document.getElementById('homestayInfo');

    // Update info kamar saat pertama kali load
    function updateKamarInfo() {
        const selectedOption = kamarSelect.options[kamarSelect.selectedIndex];
        const homestay = selectedOption.getAttribute('data-homestay') || '';
        homestayInfo.textContent = homestay ? 'Homestay: ' + homestay : '';
        hitungTotal();
    }

    // Hitung jumlah hari dan total
    function hitungTotal() {
        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);

        if (checkin && checkout && checkin < checkout) {
            const diffTime = Math.abs(checkout - checkin);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            jumlahHariInput.value = diffDays;

            const harga = kamarSelect.selectedOptions[0]?.getAttribute('data-harga') || 0;
            const total = harga * diffDays;

            // Hanya update total jika belum diisi atau berbeda
            if (!totalInput.value || Math.abs(totalInput.value - total) > 1000) {
                totalInput.value = total;
            }
        } else {
            jumlahHariInput.value = '';
        }
    }

    kamarSelect.addEventListener('change', updateKamarInfo);
    checkinInput.addEventListener('change', function() {
        // Set min untuk checkout (checkin + 1)
        const minCheckout = new Date(this.value);
        minCheckout.setDate(minCheckout.getDate() + 1);
        checkoutInput.min = minCheckout.toISOString().split('T')[0];
        hitungTotal();
    });
    checkoutInput.addEventListener('change', hitungTotal);

    // Hitung saat pertama kali load
    updateKamarInfo();
    hitungTotal();
});
</script>

<style>
.info-box {
    display: flex;
    min-height: 70px;
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
}
.info-box-content {
    flex: 1;
}
.info-box-text {
    display: block;
    font-size: 12px;
    color: #6c757d;
    text-transform: uppercase;
}
.info-box-number {
    display: block;
    font-weight: 600;
    font-size: 18px;
    color: #495057;
}
</style>

@endsection
