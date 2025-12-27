@extends('layouts.app')
@section('content')
        <!-- Header -->
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-bed-edit text-success mr-2"></i>
                Edit Kamar Homestay
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('homestay.index') }}">Homestay</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kamar_homestay.index') }}">Kamar Homestay</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-detail">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="mdi mdi-pencil mr-2"></i>Form Edit Kamar</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kamar_homestay.update', $kamar->kamar_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <!-- Homestay -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Homestay <span class="text-danger">*</span></label>
                                        <select name="homestay_id" class="form-control form-control-lg" required>
                                            <option value="">Pilih Homestay</option>
                                            @foreach($homestays as $homestay)
                                                <option value="{{ $homestay->homestay_id }}"
                                                    {{ $kamar->homestay_id == $homestay->homestay_id ? 'selected' : '' }}>
                                                    {{ $homestay->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('homestay_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nama Kamar -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nama Kamar <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_kamar" class="form-control form-control-lg"
                                               value="{{ old('nama_kamar', $kamar->nama_kamar) }}" required>
                                        @error('nama_kamar')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Kapasitas -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Kapasitas (Orang) <span class="text-danger">*</span></label>
                                        <select name="kapasitas" class="form-control form-control-lg" required>
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $kamar->kapasitas == $i ? 'selected' : '' }}>
                                                    {{ $i }} Orang
                                                </option>
                                            @endfor
                                        </select>
                                        @error('kapasitas')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Harga -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Harga per Malam (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" name="harga" class="form-control form-control-lg"
                                               value="{{ old('harga', $kamar->harga) }}" min="0" required>
                                        @error('harga')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Fasilitas JSON -->
                            <div class="form-group mb-3">
                                <label class="form-label">Fasilitas (JSON Format)</label>
                                <textarea name="fasilitas_json" class="form-control form-control-lg" rows="4">{{ old('fasilitas_json', $kamar->fasilitas_json ? json_encode($kamar->fasilitas_json, JSON_PRETTY_PRINT) : '') }}</textarea>
                                <small class="form-text text-muted">
                                    <i class="mdi mdi-information mr-1"></i>
                                    Format JSON. Contoh: {"ac": true, "tv": true, "wifi": true}
                                </small>
                                @error('fasilitas_json')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Upload File Tambahan -->
                            <div class="form-group mb-4">
                                <label class="form-label">Tambah Foto Kamar (Opsional)</label>
                                <div class="custom-file-upload">
                                    <input type="file"
                                           class="form-control form-control-lg @error('foto_kamar') is-invalid @enderror"
                                           id="foto_kamar"
                                           name="foto_kamar[]"
                                           multiple
                                           accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx"
                                           onchange="previewUploadFiles(this)">
                                    <label for="foto_kamar" class="upload-label">
                                        <i class="mdi mdi-cloud-upload mr-2"></i>
                                        <span>Pilih File (Multiple)</span>
                                    </label>
                                </div>
                                @error('foto_kamar')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    <i class="mdi mdi-information mr-1"></i>
                                    Pilih multiple file (JPG, PNG, GIF, WEBP, PDF, DOC, DOCX). Maksimal 10MB per file.
                                </small>

                                <!-- Upload Preview -->
                                <div id="uploadPreview" class="mb-3 mt-3" style="display: none;">
                                    <h6 class="text-muted mb-2">
                                        <i class="mdi mdi-image-multiple mr-2"></i>
                                        Preview File yang akan diupload:
                                    </h6>
                                    <div id="previewContainer" class="row g-2"></div>
                                    <div class="mt-2 text-end">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearPreview()">
                                            <i class="mdi mdi-trash-can mr-1"></i> Clear Preview
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-primary btn-lg me-2">
                                    <i class="mdi mdi-content-save mr-1"></i> Update Data
                                </button>
                                <a href="{{ route('kamar_homestay.show', $kamar->kamar_id) }}" class="btn btn-info btn-lg me-2">
                                    <i class="mdi mdi-eye mr-1"></i> Lihat Detail
                                </a>
                                <a href="{{ route('kamar_homestay.index') }}" class="btn btn-secondary btn-lg ms-auto">
                                    <i class="mdi mdi-arrow-left mr-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-md-4">
                <div class="card card-detail">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="mdi mdi-bed text-primary mr-2"></i>Info Kamar</h5>
                    </div>
                    <div class="card-body">
                        <div class="detail-info">
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-identifier text-primary"></i>
                                    <span>ID Kamar</span>
                                </div>
                                <div class="detail-value">
                                    <span class="badge bg-secondary">#{{ $kamar->kamar_id }}</span>
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-home text-primary"></i>
                                    <span>Homestay</span>
                                </div>
                                <div class="detail-value">{{ $kamar->homestay->nama ?? '-' }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-account-group text-primary"></i>
                                    <span>Kapasitas</span>
                                </div>
                                <div class="detail-value">
                                    <span class="badge-biru">{{ $kamar->kapasitas }} Orang</span>
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-cash text-primary"></i>
                                    <span>Harga per Malam</span>
                                </div>
                                <div class="detail-value">
                                    <span class="badge-orange">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-calendar text-primary"></i>
                                    <span>Dibuat Tanggal</span>
                                </div>
                                <div class="detail-value">{{ $kamar->created_at->format('d F Y H:i') }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="mdi mdi-update text-primary"></i>
                                    <span>Diupdate Tanggal</span>
                                </div>
                                <div class="detail-value">{{ $kamar->updated_at->format('d F Y H:i') }}</div>
                            </div>
                        </div>

                        <!-- File Terlampir -->
                        <div class="card mt-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="mdi mdi-file-multiple mr-2"></i>
                                    File Terlampir
                                </h6>
                            </div>
                            <div class="card-body">
                                @php
                                    $files = \App\Models\Media::where('ref_table', 'kamar_homestay')
                                        ->where('ref_id', $kamar->kamar_id)
                                        ->orderBy('sort_order', 'asc')
                                        ->get();
                                @endphp

                                @if($files->count() > 0)
                                    <div class="file-list">
                                        @foreach($files as $file)
                                            <div class="file-item d-flex justify-content-between align-items-center mb-2 p-2 border rounded hover-effect">
                                                <div class="d-flex align-items-center">
                                                    @if(str_contains($file->mime_type, 'image'))
                                                        <i class="mdi mdi-image text-info mr-2"></i>
                                                    @elseif(str_contains($file->mime_type, 'pdf'))
                                                        <i class="mdi mdi-file-pdf-box text-danger mr-2"></i>
                                                    @elseif(str_contains($file->mime_type, 'word') || str_contains($file->mime_type, 'document'))
                                                        <i class="mdi mdi-file-word-box text-primary mr-2"></i>
                                                    @else
                                                        <i class="mdi mdi-file-document-box text-secondary mr-2"></i>
                                                    @endif
                                                    <span class="text-truncate" style="max-width: 150px;">
                                                        {{ basename($file->file_name) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <a href="{{ route('kamar_homestay.download-file', [$kamar->kamar_id, $file->media_id]) }}"
                                                       class="btn btn-sm btn-outline-info btn-action"
                                                       target="_blank"
                                                       title="Download">
                                                        <i class="mdi mdi-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('kamar_homestay.show', $kamar->kamar_id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="mdi mdi-eye mr-1"></i> Lihat Semua File di Gallery
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center py-3 empty-state">
                                        <i class="mdi mdi-file-remove text-muted" style="font-size: 48px;"></i>
                                        <p class="text-muted mt-2">Belum ada file yang diupload</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Fasilitas Saat Ini -->
                        @if($kamar->fasilitas_json)
                        <div class="card mt-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="mdi mdi-wifi mr-2"></i>
                                    Fasilitas Saat Ini
                                </h6>
                            </div>
                            <div class="card-body">
                                @php
                                    $fasilitas = is_array($kamar->fasilitas_json) ? $kamar->fasilitas_json : json_decode($kamar->fasilitas_json, true);
                                @endphp
                                @if(is_array($fasilitas))
                                    <div class="fasilitas-list">
                                        @foreach($fasilitas as $key => $value)
                                            @if($value)
                                                <span class="badge bg-light text-dark mb-1 mr-1">
                                                    @if(in_array(strtolower($key), ['wifi', 'internet']))
                                                        <i class="mdi mdi-wifi mr-1"></i>
                                                    @elseif(in_array(strtolower($key), ['ac', 'air conditioner']))
                                                        <i class="mdi mdi-air-conditioner mr-1"></i>
                                                    @elseif(in_array(strtolower($key), ['tv', 'television']))
                                                        <i class="mdi mdi-television mr-1"></i>
                                                    @elseif(strpos(strtolower($key), 'mandi') !== false)
                                                        <i class="mdi mdi-shower mr-1"></i>
                                                    @elseif(strpos(strtolower($key), 'balkon') !== false)
                                                        <i class="mdi mdi-balcony mr-1"></i>
                                                    @elseif(strpos(strtolower($key), 'kasur') !== false)
                                                        <i class="mdi mdi-bed mr-1"></i>
                                                    @else
                                                        <i class="mdi mdi-check-circle mr-1"></i>
                                                    @endif
                                                    {{ ucwords(str_replace('_', ' ', $key)) }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

<script>
// ============ UPLOAD PREVIEW FUNCTIONS ============
function previewUploadFiles(input) {
    const previewContainer = document.getElementById('previewContainer');
    const uploadPreview = document.getElementById('uploadPreview');

    previewContainer.innerHTML = '';

    if (input.files.length > 0) {
        uploadPreview.style.display = 'block';

        Array.from(input.files).forEach((file, index) => {
            // Check file size (10MB max)
            if (file.size > 10 * 1024 * 1024) {
                showToast('error', `File ${file.name} melebihi 10MB`);
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-6 col-md-3';

                if (file.type.startsWith('image/')) {
                    col.innerHTML = `
                        <div class="upload-preview-card">
                            <img src="${e.target.result}"
                                 class="upload-preview-img"
                                 alt="Preview ${index + 1}">
                            <div class="upload-preview-info">
                                <small class="text-truncate d-block">${file.name}</small>
                                <small class="text-muted">${(file.size / 1024).toFixed(1)} KB</small>
                            </div>
                        </div>
                    `;
                } else if (file.type.includes('pdf')) {
                    col.innerHTML = `
                        <div class="upload-preview-card">
                            <div class="upload-preview-doc text-center py-3">
                                <i class="mdi mdi-file-pdf-box text-danger" style="font-size: 30px;"></i>
                            </div>
                            <div class="upload-preview-info">
                                <small class="text-truncate d-block">${file.name}</small>
                                <small class="text-muted">PDF - ${(file.size / 1024).toFixed(1)} KB</small>
                            </div>
                        </div>
                    `;
                } else {
                    let icon = 'mdi-file-document-box';
                    let color = 'text-secondary';

                    if (file.type.includes('word') || file.type.includes('document')) {
                        icon = 'mdi-file-word-box';
                        color = 'text-primary';
                    }

                    col.innerHTML = `
                        <div class="upload-preview-card">
                            <div class="upload-preview-doc text-center py-3">
                                <i class="mdi ${icon} ${color}" style="font-size: 30px;"></i>
                            </div>
                            <div class="upload-preview-info">
                                <small class="text-truncate d-block">${file.name}</small>
                                <small class="text-muted">${(file.size / 1024).toFixed(1)} KB</small>
                            </div>
                        </div>
                    `;
                }

                previewContainer.appendChild(col);
            };
            reader.readAsDataURL(file);
        });

        showToast('info', `Menampilkan preview ${input.files.length} file`);
    } else {
        uploadPreview.style.display = 'none';
    }
}

function clearPreview() {
    const input = document.getElementById('foto_kamar');
    input.value = '';
    previewUploadFiles(input);
}

// ============ TOAST NOTIFICATION ============
function showToast(type, message) {
    // Hapus toast sebelumnya
    const existingToasts = document.querySelectorAll('.toast-notification');
    existingToasts.forEach(toast => toast.remove());

    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `
        <div class="toast-content">
            <i class="mdi mdi-${type === 'success' ? 'check-circle' : type === 'error' ? 'alert-circle' : 'information'} mr-2"></i>
            <span>${message}</span>
        </div>
        <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
    `;

    document.body.appendChild(toast);

    // Auto remove after 3 seconds
    setTimeout(() => {
        if (toast.parentElement) {
            toast.remove();
        }
    }, 3000);
}

// ============ INITIALIZATION ============
document.addEventListener('DOMContentLoaded', function() {
    // Auto dismiss alerts setelah 5 detik
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
});
</script>

<style>
/* ==================== DETAIL STYLES ==================== */
.card-detail {
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease;
    border: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.card-detail:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.card-header {
    border-bottom: none;
    padding: 20px 25px;
}

.card-header h5 {
    font-weight: 600;
}

.card-body {
    padding: 25px;
}

.detail-info {
    padding: 10px 0;
}

.detail-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.detail-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.detail-label {
    min-width: 150px;
    display: flex;
    align-items: center;
    font-weight: 600;
    color: #555;
}

.detail-label i {
    font-size: 18px;
    margin-right: 10px;
    width: 24px;
}

.detail-value {
    flex: 1;
    color: #333;
    line-height: 1.5;
    font-size: 16px;
}

/* ==================== FORM STYLES ==================== */
.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    display: block;
}

.form-control-lg {
    padding: 12px 15px;
    font-size: 16px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    transform: translateY(-1px);
}

.form-control-lg:hover {
    border-color: #4e73df;
}

textarea.form-control-lg {
    min-height: 120px;
}

select.form-control-lg {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px 12px;
    padding-right: 40px;
}

/* ==================== BADGE STYLES ==================== */
.badge-biru {
    background: linear-gradient(45deg, #2196F3, #64B5F6);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 14px;
}

.badge-orange {
    background: linear-gradient(45deg, #FF6B35, #FF8E53);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 14px;
}

.badge-danger {
    background: linear-gradient(45deg, #DC3545, #E74C3C);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 600;
}

.badge-secondary {
    background: linear-gradient(45deg, #6C757D, #868E96);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 600;
}

/* ==================== UPLOAD STYLES ==================== */
.custom-file-upload {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
    margin-bottom: 15px;
}

.custom-file-upload input[type="file"] {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.upload-label {
    display: block;
    padding: 20px;
    background: white;
    border: 3px dashed #4e73df;
    border-radius: 10px;
    text-align: center;
    color: #4e73df;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 16px;
}

.upload-label:hover {
    background: #4e73df;
    color: white;
    border-color: #4e73df;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(78, 115, 223, 0.3);
}

.upload-preview-card {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    height: 140px;
    border: 3px solid #e0e0e0;
    background: white;
    transition: all 0.3s ease;
}

.upload-preview-card:hover {
    border-color: #4e73df;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(78, 115, 223, 0.2);
}

.upload-preview-img {
    width: 100%;
    height: 100px;
    object-fit: cover;
}

.upload-preview-doc {
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.upload-preview-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 5px 8px;
    font-size: 11px;
}

/* ==================== FILE LIST STYLES ==================== */
.file-list .file-item {
    transition: all 0.3s ease;
}

.file-list .hover-effect:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.btn-action {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.btn-action:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.empty-state i {
    opacity: 0.6;
    transition: opacity 0.3s ease;
}

.empty-state:hover i {
    opacity: 0.8;
}

/* ==================== BUTTON STYLES ==================== */
.btn-lg {
    padding: 12px 25px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #4e73df, #224abe);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(78, 115, 223, 0.4);
    background: linear-gradient(135deg, #3e63cf, #123aae);
}

.btn-info {
    background: linear-gradient(135deg, #36b9cc, #258391);
    border: none;
}

.btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(54, 185, 204, 0.4);
    background: linear-gradient(135deg, #26a9bc, #157381);
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d, #495057);
    border: none;
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
    background: linear-gradient(135deg, #5c656d, #394047);
}

.btn-outline-primary {
    border: 2px solid #4e73df;
    color: #4e73df;
    font-weight: 600;
}

.btn-outline-primary:hover {
    background: #4e73df;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(78, 115, 223, 0.3);
}

/* ==================== FLEX GAP FIX ==================== */
.d-grid.gap-2 {
    gap: 15px !important;
}

/* ==================== FLEX GAP FIX ==================== */
.d-grid.gap-2.d-md-flex {
    gap: 15px !important;
}

.ms-auto {
    margin-left: auto !important;
}

/* ==================== FASILITAS LIST ==================== */
.fasilitas-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.fasilitas-list .badge {
    padding: 8px 15px;
    font-size: 0.85rem;
    font-weight: 500;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
}

.fasilitas-list .badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* ==================== TOAST NOTIFICATION ==================== */
.toast-notification {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: white;
    border-radius: 12px;
    padding: 18px 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-width: 350px;
    max-width: 450px;
    z-index: 9999;
    animation: slideIn 0.3s ease;
    border-left: 5px solid;
}

.toast-success {
    border-left-color: #4CAF50;
}

.toast-error {
    border-left-color: #f44336;
}

.toast-info {
    border-left-color: #2196F3;
}

.toast-content {
    display: flex;
    align-items: center;
    flex: 1;
}

.toast-content i {
    font-size: 24px;
    margin-right: 12px;
}

.toast-success .toast-content i {
    color: #4CAF50;
}

.toast-error .toast-content i {
    color: #f44336;
}

.toast-info .toast-content i {
    color: #2196F3;
}

.toast-close {
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    color: #999;
    padding: 0;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.toast-close:hover {
    background: #f0f0f0;
    color: #333;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* ==================== RESPONSIVE DESIGN ==================== */
@media (max-width: 1200px) {
    .card-body {
        padding: 20px;
    }

    .detail-label {
        min-width: 130px;
    }
}

@media (max-width: 992px) {
    .card-detail {
        margin-bottom: 25px;
    }

    .detail-item {
        flex-direction: column;
    }

    .detail-label {
        min-width: auto;
        margin-bottom: 5px;
    }

    .btn-lg {
        padding: 10px 20px;
        font-size: 15px;
    }
}

@media (max-width: 768px) {
    .card-header {
        padding: 15px 20px;
    }

    .card-body {
        padding: 15px;
    }

    .form-control-lg {
        padding: 10px 12px;
        font-size: 15px;
    }

    .upload-label {
        padding: 15px;
        font-size: 15px;
    }

    .toast-notification {
        min-width: 280px;
        max-width: 320px;
        left: 50%;
        right: auto;
        transform: translateX(-50%);
        bottom: 20px;
    }
}

@media (max-width: 576px) {
    .card-header {
        padding: 12px 15px;
    }

    .card-body {
        padding: 12px;
    }

    .d-grid.gap-2.d-md-flex {
        flex-direction: column;
    }

    .btn-lg {
        width: 100%;
        margin-bottom: 8px;
    }

    .ms-auto {
        margin-left: 0 !important;
    }
}
</style>

@endsection
