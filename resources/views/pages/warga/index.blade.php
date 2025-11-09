<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Bina Desa</title>

    {{-- ====================== START CSS ====================== --}}
   @include('layouts.css')
    {{-- ====================== END CSS ====================== --}}

</head>
<body>
    <div class="container-scroller">

        {{-- ====================== START HEADER ====================== --}}
       @include('layouts.header')
        {{-- ====================== END HEADER ====================== --}}

        <div class="container-fluid page-body-wrapper">

            {{-- ====================== START SIDEBAR ====================== --}}
            @include('layouts.sidebar")
            {{-- ====================== END SIDEBAR ====================== --}}

            <div class="main-panel">
                <div class="content-wrapper">

                    {{-- ====================== START MAIN CONTENT ====================== --}}
                    <!-- {{-- start main content --}} -->
                    <!-- Header -->
                    <div class="page-header">
                        <h3 class="page-title">
                            <i class="mdi mdi-account-multiple text-primary mr-2"></i>
                            Data Warga
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Warga</li>
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

                    <!-- Card Data Warga -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title mb-0">Daftar Warga Terdaftar</h4>
                                <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Warga
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>No KTP</th>
                                            <th>Nama Lengkap</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                            <th class="text-center">Agama</th>
                                            <th class="text-center">Pekerjaan</th>
                                            <th>Telepon</th>
                                            <th>Email</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($warga as $item)
                                        <tr>
                                            <td class="text-center">
                                                <span class="badge badge-info">{{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold text-primary">{{ $item->no_ktp }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3">
                                                        <i class="mdi mdi-account-circle text-primary" style="font-size: 24px;"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold">{{ $item->nama }}</div>
                                                        <small class="text-muted">ID: {{ $item->warga_id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if($item->jenis_kelamin == 'L')
                                                    <span class="badge badge-gender-male py-2 px-3">
                                                        <i class="mdi mdi-gender-male mr-1"></i>Laki-laki
                                                    </span>
                                                @else
                                                    <span class="badge badge-gender-female py-2 px-3">
                                                        <i class="mdi mdi-gender-female mr-1"></i>Perempuan
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-religion py-2 px-3">
                                                    <i class="mdi mdi-church mr-1"></i>{{ $item->agama }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-job py-2 px-3">
                                                    <i class="mdi mdi-briefcase mr-1"></i>{{ $item->pekerjaan }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-phone mr-2 text-success"></i>
                                                    <span class="font-weight-bold">{{ $item->telp }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if($item->email)
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-email mr-2 text-warning"></i>
                                                        <span class="text-truncate" style="max-width: 150px;">{{ $item->email }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center action-buttons">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('warga.edit', $item->warga_id) }}"
                                                       class="btn btn-outline-info btn-sm"
                                                       data-toggle="tooltip"
                                                       title="Edit Data">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit"
                                                                class="btn btn-outline-danger btn-sm"
                                                                data-toggle="tooltip"
                                                                title="Hapus Data"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data warga {{ $item->nama }}?')">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-5">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="mdi mdi-account-off-outline text-muted" style="font-size: 64px;"></i>
                                                    <h4 class="text-muted mt-3">Belum ada data warga</h4>
                                                    <p class="text-muted">Silakan tambah data warga terlebih dahulu</p>
                                                    <a href="{{ route('warga.create') }}" class="btn btn-primary mt-2">
                                                        <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah Warga Pertama
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
                                                <h6 class="alert-heading mb-1">Total Data Warga: {{ $warga->count() }}</h6>
                                                <p class="mb-0">Data warga yang terdaftar dalam sistem Bina Desa</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- {{-- end main content --}} -->
                    {{-- ====================== END MAIN CONTENT ====================== --}}

                </div>
                <!-- content-wrapper ends -->

                {{-- ====================== START FOOTER ====================== --}}
               @include('layouts.footer')
                {{-- ====================== END FOOTER ====================== --}}

            </div>
        </div>
    </div>

    {{-- ====================== START JS ====================== --}}
   @include('layouts.js')
    {{-- ====================== END JS ====================== --}}
</body>
</html>
