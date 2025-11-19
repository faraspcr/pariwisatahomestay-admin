@extends('layouts.app')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">

        {{-- ====================== START MAIN CONTENT ====================== --}}


        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-star text-warning mr-2"></i>
                Tambah Ulasan Wisata
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('ulasan_wisata.index') }}">Ulasan Wisata</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Ulasan</li>
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

        <!-- Card Form -->
        <div class="card">
            <div class="card-body">
                <!-- Tombol Kembali di atas form -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Form Tambah Ulasan</h4>
                    <a href="{{ route('ulasan_wisata.index') }}" class="btn btn-light btn-lg">
                        <i class="mdi mdi-arrow-left mr-2"></i>Kembali ke Ulasan Wisata
                    </a>
                </div>

                <p class="card-description">
                    Isi form berikut untuk menambahkan ulasan baru
                </p>

                <form action="{{ route('ulasan_wisata.store') }}" method="POST" id="ulasanForm">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="destinasi_id" class="font-weight-bold">
                                    Destinasi Wisata <span class="text-danger">*</span>
                                </label>
                                <select name="destinasi_id" id="destinasi_id"
                                        class="form-control form-control-lg @error('destinasi_id') is-invalid @enderror" required>
                                    <option value="">Pilih Destinasi Wisata</option>
                                    @foreach($destinasi as $dest)
                                        <option value="{{ $dest->destinasi_id }}"
                                            {{ old('destinasi_id') == $dest->destinasi_id ? 'selected' : '' }}>
                                            {{ $dest->nama }} - {{ $dest->alamat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('destinasi_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="warga_id" class="font-weight-bold">
                                    Nama Warga <span class="text-danger">*</span>
                                </label>
                                <select name="warga_id" id="warga_id"
                                        class="form-control form-control-lg @error('warga_id') is-invalid @enderror" required>
                                    <option value="">Pilih Warga</option>
                                    @foreach($warga as $w)
                                        <option value="{{ $w->warga_id }}"
                                            {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} - {{ $w->email ?? $w->no_telepon }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('warga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Rating <span class="text-danger">*</span></label>
                        <div class="rating-input mt-2">
                            <div class="d-flex justify-content-start">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="rating-option mr-2">
                                        <input type="radio" name="rating" id="rating{{ $i }}"
                                               value="{{ $i }}" class="d-none"
                                               {{ old('rating') == $i ? 'checked' : '' }}>
                                        <label for="rating{{ $i }}" class="rating-star btn btn-outline-warning d-flex flex-column align-items-center p-3">
                                            <i class="mdi mdi-star {{ old('rating') >= $i ? 'text-warning' : '' }}" style="font-size: 24px;"></i>
                                            <span class="mt-1 font-weight-bold">{{ $i }}</span>
                                        </label>
                                    </div>
                                @endfor
                            </div>
                            @error('rating')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="komentar" class="font-weight-bold">
                            Komentar <span class="text-danger">*</span>
                        </label>
                        <textarea name="komentar" id="komentar" rows="5"
                                  class="form-control form-control-lg @error('komentar') is-invalid @enderror"
                                  placeholder="Tuliskan pengalaman Anda mengunjungi destinasi wisata ini..."
                                  required>{{ old('komentar') }}</textarea>
                        <small class="form-text text-muted">Minimal 10 karakter</small>
                        @error('komentar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Action di bagian bawah form -->
                    <div class="form-group mt-5 pt-4 border-top">
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-primary btn-lg mr-3">
                                <i class="mdi mdi-content-save mr-2"></i>Simpan Ulasan
                            </button>
                            <a href="{{ route('ulasan_wisata.index') }}" class="btn btn-secondary btn-lg">
                                <i class="mdi mdi-close mr-2"></i>Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- ====================== END MAIN CONTENT ====================== --}}
    </div>
</div>

<style>
.rating-input .rating-star {
    border: 2px solid #ffc107;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 80px;
    background: white;
}

.rating-input .rating-star:hover {
    background: #fffbf0;
    transform: translateY(-2px);
}

.rating-input input:checked + .rating-star {
    background: #ffc107;
    color: white;
}

.rating-input input:checked + .rating-star .mdi {
    color: white !important;
}

.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.form-control-lg {
    border-radius: 8px;
    padding: 12px 16px;
}

.btn-lg {
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    min-width: 180px;
}

/* Style untuk tombol kembali di atas */
.d-flex.justify-content-between .btn-light {
    background: white;
    border: 1px solid #ddd;
    color: #6c757d;
    min-width: 220px;
}

.d-flex.justify-content-between .btn-light:hover {
    background: #f8f9fa;
    border-color: #6c757d;
}

/* Style untuk tombol action di bawah */
.form-group.mt-5 {
    background: #f8f9fa;
    margin: 0 -2rem -2rem -2rem;
    padding: 2rem;
}

.form-group.mt-5 .btn {
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-group.mt-5 .btn-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-group.mt-5 .btn-secondary {
    background: linear-gradient(45deg, #6c757d, #5a6268);
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    color: white;
}

.form-group.mt-5 .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

/* Border top untuk pemisah */
.border-top {
    border-top: 1px solid #e3e6f0 !important;
}

/* Card title styling */
.card-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2e3a59;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-resize textarea
    const textarea = document.getElementById('komentar');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Rating selection feedback
    document.querySelectorAll('.rating-star').forEach(star => {
        star.addEventListener('click', function() {
            // Remove all active states
            document.querySelectorAll('.rating-star').forEach(s => {
                s.classList.remove('bg-warning', 'text-white');
                s.querySelector('.mdi').classList.remove('text-white');
                s.style.background = 'white';
                s.style.color = 'inherit';
            });

            // Add active state to clicked and previous stars
            let currentRating = this.closest('.rating-option').querySelector('input').value;
            for (let i = 1; i <= currentRating; i++) {
                const starElement = document.querySelector(`#rating${i} + .rating-star`);
                starElement.style.background = '#ffc107';
                starElement.style.color = 'white';
                starElement.querySelector('.mdi').classList.add('text-white');
            }
        });
    });

    // Initialize rating stars based on selected value
    const selectedRating = document.querySelector('input[name="rating"]:checked');
    if (selectedRating) {
        let currentRating = selectedRating.value;
        for (let i = 1; i <= currentRating; i++) {
            const starElement = document.querySelector(`#rating${i} + .rating-star`);
            starElement.style.background = '#ffc107';
            starElement.style.color = 'white';
            starElement.querySelector('.mdi').classList.add('text-white');
        }
    }
});
</script>

@endsection
