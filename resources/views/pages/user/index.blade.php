@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

        {{-- ====================== START MAIN CONTENT ====================== --}}

        <!-- Header -->
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-account text-primary mr-2"></i>
                Data User
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data User</li>
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

        <!-- Card Data User -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Daftar User Terdaftar</h4>
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah User
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tanggal Dibuat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $item)
                            <tr>
                                <td class="text-center">
                                    <span class="badge badge-info">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <i class="mdi mdi-account-circle text-primary" style="font-size: 24px;"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">{{ $item->name }}</div>
                                            <small class="text-muted">ID: {{ $item->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="mdi mdi-email mr-2 text-warning"></i>
                                        <span>{{ $item->email }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-role py-2 px-3">
                                        <i class="mdi mdi-account-key mr-1"></i>User
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-status py-2 px-3">
                                        <i class="mdi mdi-check-circle mr-1"></i>Aktif
                                    </span>
                                </td>
                                <td class="text-center">
                                    <small class="text-muted">
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </small>
                                </td>
                                <td class="text-center action-buttons">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('user.edit', $item->id) }}"
                                           class="btn btn-outline-info btn-sm"
                                           data-toggle="tooltip"
                                           title="Edit Data">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('user.destroy', $item->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm"
                                                    data-toggle="tooltip"
                                                    title="Hapus Data"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $item->name }}?')">
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
                                        <i class="mdi mdi-account-off-outline text-muted" style="font-size: 64px;"></i>
                                        <h4 class="text-muted mt-3">Belum ada data user</h4>
                                        <p class="text-muted">Silakan tambah data user terlebih dahulu</p>
                                        <a href="{{ route('user.create') }}" class="btn btn-primary mt-2">
                                            <i class="mdi mdi-plus-circle-outline mr-1"></i>Tambah User Pertama
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
                                    <h6 class="alert-heading mb-1">Total Data User: {{ $users->count() }}</h6>
                                    <p class="mb-0">Data user yang terdaftar dalam sistem Bina Desa</p>
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
    .badge-role {
        background: linear-gradient(45deg, #7B1FA2, #E1BEE7);
        color: white;
    }
    .badge-status {
        background: linear-gradient(45deg, #388E3C, #66BB6A);
        color: white;
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
</style>

@endsection
