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

        <!-- Card Kamar Homestay -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar Kamar Homestay</h4>

                <!-- ==================== FORM FILTER DAN SEARCH ==================== -->
                <form method="GET" action="{{ route('kamar_homestay.index') }}">
                    <div class="row mb-4">
                        <!-- Filter Homestay -->
                        <div class="col-md-3">
                            <select name="homestay_id" onchange="this.form.submit()" class="form-control form-control-sm">
                                <option value="">Semua Homestay</option>
                                @foreach($homestays as $homestay)
                                    <option value="{{ $homestay->homestay_id }}"
                                            {{ request('homestay_id') == $homestay->homestay_id ? 'selected' : '' }}>
                                        {{ $homestay->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Kapasitas -->
                        <div class="col-md-3">
                            <select name="kapasitas" onchange="this.form.submit()" class="form-control form-control-sm">
                                <option value="">Semua Kapasitas</option>
                                <option value="1" {{ request('kapasitas') == '1' ? 'selected' : '' }}>1 Orang</option>
                                <option value="2" {{ request('kapasitas') == '2' ? 'selected' : '' }}>2 Orang</option>
                                <option value="3" {{ request('kapasitas') == '3' ? 'selected' : '' }}>3 Orang</option>
                                <option value="4" {{ request('kapasitas') == '4' ? 'selected' : '' }}>4+ Orang</option>
                            </select>
                        </div>

                        <!-- Form Search -->
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text"
                                       name="search"
                                       class="form-control form-control-sm"
                                       placeholder="Cari nama kamar..."
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
                            <a href="{{ route('kamar_homestay.create') }}" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Kamar
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
                                <th>Nama Kamar</th>
                                <th>Homestay</th>
                                <th class="text-center">Kapasitas</th>
                                <th>Fasilitas</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kamarHomestay as $item)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-info">{{ ($kamarHomestay->currentPage() - 1) * $kamarHomestay->perPage() + $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <i class="mdi mdi-bed text-success" style="font-size: 24px;"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold">{{ $item->nama_kamar }}</div>
                                                <small class="text-muted">ID: {{ $item->kamar_id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->homestay->nama ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-info py-2 px-3">
                                            <i class="mdi mdi-account-group mr-1"></i>{{ $item->kapasitas }} Orang
                                        </span>
                                    </td>
                                    <td>
                                        @if($item->fasilitas_json)
                                            @php
                                                $fasilitas = json_decode($item->fasilitas_json, true);
                                                $fasilitasList = is_array($fasilitas) ? array_keys(array_filter($fasilitas)) : [];
                                            @endphp
                                            @if(count($fasilitasList) > 0)
                                                <div class="fasilitas-tags">
                                                    @foreach(array_slice($fasilitasList, 0, 3) as $fasil)
                                                        <span class="badge badge-light mr-1 mb-1">{{ $fasil }}</span>
                                                    @endforeach
                                                    @if(count($fasilitasList) > 3)
                                                        <span class="badge badge-secondary">+{{ count($fasilitasList) - 3 }}</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success py-2 px-3">
                                            <i class="mdi mdi-cash mr-1"></i>Rp {{ number_format($item->harga, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('kamar_homestay.edit', $item->kamar_id) }}"
                                               class="btn btn-outline-info btn-sm">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('kamar_homestay.destroy', $item->kamar_id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Hapus kamar {{ $item->nama_kamar }}?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="mdi mdi-bed-empty text-muted" style="font-size: 64px;"></i>
                                            <h4 class="text-muted mt-3">Belum ada data kamar</h4>
                                            <a href="{{ route('kamar_homestay.create') }}" class="btn btn-success mt-2">
                                                <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Kamar Pertama
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
                    {{ $kamarHomestay->links('pagination::bootstrap-5') }}
                </div>

                <!-- Info Summary -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-information-outline mr-2" style="font-size: 24px;"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Total Kamar: {{ $kamarHomestay->total() }}</h6>
                                    <p class="mb-0">Menampilkan {{ $kamarHomestay->count() }} data</p>
                                    <small>Halaman {{ $kamarHomestay->currentPage() }} dari {{ $kamarHomestay->lastPage() }}</small>
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
.fasilitas-tags .badge {
    font-size: 0.75rem;
    padding: 4px 8px;
}
.table-responsive {
    overflow-x: auto;
}
</style>

@endsection
