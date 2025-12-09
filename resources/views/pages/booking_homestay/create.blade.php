@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <!-- Header -->
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-calendar-plus text-success mr-2"></i>
                Tambah Booking Homestay
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('booking-homestay.index') }}">Booking Homestay</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Form Tambah Booking</h4>

                        <form action="{{ route('booking-homestay.store') }}" method="POST">
                            @csrf

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
                                                    data-homestay="{{ $kamar->homestay->nama ?? 'Unknown' }}">
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
                                                <option value="{{ $warga->warga_id }}" {{ old('warga_id') == $warga->warga_id ? 'selected' : '' }}>
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
                                               value="{{ old('checkin', date('Y-m-d')) }}" required>
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
                                               value="{{ old('checkout', date('Y-m-d', strtotime('+1 day'))) }}" required>
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
                                               value="{{ old('total') }}" min="0" required>
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
                                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                                            <option value="cash" {{ old('metode_bayar') == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="transfer" {{ old('metode_bayar') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                            <option value="qris" {{ old('metode_bayar') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                            <option value="other" {{ old('metode_bayar') == 'other' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('metode_bayar')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save mr-1"></i> Simpan
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
                            <i class="mdi mdi-information-outline text-primary mr-2"></i>
                            Informasi Booking
                        </h5>

                        <div class="alert alert-info">
                            <h6><i class="mdi mdi-alert-circle-outline mr-2"></i> Panduan:</h6>
                            <ul class="mb-0 pl-3">
                                <li>Pilih kamar yang tersedia</li>
                                <li>Check-in minimal hari ini</li>
                                <li>Check-out harus setelah check-in</li>
                                <li>Total akan otomatis terhitung</li>
                                <li>Status bisa diubah nanti</li>
                            </ul>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="mdi mdi-calculator mr-2"></i> Kalkulator Harga</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <small>Harga per Malam:</small>
                                        <h5 id="hargaPerMalam">Rp 0</h5>
                                    </div>
                                    <div class="col-6">
                                        <small>Jumlah Hari:</small>
                                        <h5 id="displayJumlahHari">0 Hari</h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <small>Total Seharusnya:</small>
                                        <h4 id="totalSeharusnya" class="text-success">Rp 0</h4>
                                    </div>
                                </div>
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
    const displayJumlahHari = document.getElementById('displayJumlahHari');
    const totalInput = document.getElementById('total');
    const hargaPerMalam = document.getElementById('hargaPerMalam');
    const totalSeharusnya = document.getElementById('totalSeharusnya');
    const homestayInfo = document.getElementById('homestayInfo');

    // Set min date untuk checkin (hari ini)
    const today = new Date().toISOString().split('T')[0];
    checkinInput.min = today;

    // Update info kamar
    kamarSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga') || 0;
        const homestay = selectedOption.getAttribute('data-homestay') || '';

        hargaPerMalam.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(harga);
        homestayInfo.textContent = homestay ? 'Homestay: ' + homestay : '';

        hitungTotal();
    });

    // Hitung jumlah hari dan total
    function hitungTotal() {
        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);

        if (checkin && checkout && checkin < checkout) {
            const diffTime = Math.abs(checkout - checkin);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            jumlahHariInput.value = diffDays;
            displayJumlahHari.textContent = diffDays + ' Hari';

            const harga = kamarSelect.selectedOptions[0]?.getAttribute('data-harga') || 0;
            const total = harga * diffDays;

            totalInput.value = total;
            totalSeharusnya.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        } else {
            jumlahHariInput.value = '';
            displayJumlahHari.textContent = '0 Hari';
            totalSeharusnya.textContent = 'Rp 0';
        }
    }

    checkinInput.addEventListener('change', function() {
        // Set min untuk checkout (checkin + 1)
        const minCheckout = new Date(this.value);
        minCheckout.setDate(minCheckout.getDate() + 1);
        checkoutInput.min = minCheckout.toISOString().split('T')[0];

        // Jika checkout lebih awal dari checkin, reset
        if (new Date(checkoutInput.value) <= new Date(this.value)) {
            checkoutInput.value = minCheckout.toISOString().split('T')[0];
        }

        hitungTotal();
    });

    checkoutInput.addEventListener('change', hitungTotal);

    // Hitung saat pertama kali load
    hitungTotal();
});
</script>

@endsection
