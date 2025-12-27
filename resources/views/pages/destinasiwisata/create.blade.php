@extends('layouts.app')
@section('content')

        <!-- Header -->
        <div class="page-header">
            <h3 class="page-title">
                <i class="mdi mdi-map-marker-plus text-primary mr-2"></i>
                Tambah Destinasi Wisata
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('destinasiwisata.index') }}">Destinasi Wisata</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Destinasi</li>
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

        <!-- Error List -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle-outline mr-2"></i>
                <strong>Terjadi kesalahan!</strong> Silakan perbaiki data berikut:
                <ul class="mt-2 mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Card Form Tambah Destinasi Wisata -->
        <div class="card create-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">
                        <i class="mdi mdi-plus-circle text-primary mr-2"></i>
                        Form Tambah Destinasi Wisata
                    </h4>
                    <a href="{{ route('destinasiwisata.index') }}" class="btn btn-outline-secondary btn-action">
                        <i class="mdi mdi-arrow-left mr-1"></i>Kembali ke Destinasi Wisata
                    </a>
                </div>

                <form action="{{ route('destinasiwisata.store') }}" method="POST" id="destinasiForm" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <!-- Nama Destinasi -->
                            <div class="form-group">
                                <label for="nama" class="form-label">
                                    <i class="mdi mdi-map-marker text-primary mr-1"></i>
                                    Nama Destinasi <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                       id="nama" name="nama" value="{{ old('nama') }}"
                                       placeholder="Masukkan nama destinasi wisata" required>
                                <small class="form-text text-muted">Nama resmi destinasi wisata</small>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group">
                                <label for="deskripsi" class="form-label">
                                    <i class="mdi mdi-text-box text-primary mr-1"></i>
                                    Deskripsi <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                          id="deskripsi" name="deskripsi" rows="4"
                                          placeholder="Masukkan deskripsi destinasi yang menarik dan informatif"
                                          required>{{ old('deskripsi') }}</textarea>
                                <small class="form-text text-muted">Jelaskan keunikan dan daya tarik destinasi ini</small>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="form-group">
                                <label for="alamat" class="form-label">
                                    <i class="mdi mdi-home-map-marker text-primary mr-1"></i>
                                    Alamat Lengkap <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror"
                                          id="alamat" name="alamat" rows="3"
                                          placeholder="Masukkan alamat lengkap termasuk nama jalan, kelurahan, kecamatan"
                                          required>{{ old('alamat') }}</textarea>
                                <small class="form-text text-muted">Alamat lengkap untuk navigasi</small>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <!-- RT & RW -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rt" class="form-label">
                                            <i class="mdi mdi-numeric text-primary mr-1"></i>
                                            RT <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                               id="rt" name="rt" value="{{ old('rt') }}"
                                               placeholder="Contoh: 001" maxlength="3" required>
                                        <small class="form-text text-muted">3 digit angka</small>
                                        @error('rt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rw" class="form-label">
                                            <i class="mdi mdi-numeric text-primary mr-1"></i>
                                            RW <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                               id="rw" name="rw" value="{{ old('rw') }}"
                                               placeholder="Contoh: 002" maxlength="3" required>
                                        <small class="form-text text-muted">3 digit angka</small>
                                        @error('rw')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Jam Buka -->
                            <div class="form-group">
                                <label for="jam_buka" class="form-label">
                                    <i class="mdi mdi-clock-outline text-primary mr-1"></i>
                                    Jam Buka <span class="text-danger">*</span>
                                </label>
                                <input type="time" class="form-control @error('jam_buka') is-invalid @enderror"
                                       id="jam_buka" name="jam_buka" value="{{ old('jam_buka', '08:00') }}" required>
                                <small class="form-text text-muted">Jam operasional destinasi</small>
                                @error('jam_buka')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Harga Tiket -->
                            <div class="form-group">
                                <label for="tiket" class="form-label">
                                    <i class="mdi mdi-ticket text-primary mr-1"></i>
                                    Harga Tiket (Rp) <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control @error('tiket') is-invalid @enderror"
                                           id="tiket" name="tiket" value="{{ old('tiket') }}"
                                           placeholder="Masukkan harga tiket" min="0" step="1000" required>
                                </div>
                                <small class="form-text text-muted">Masukkan angka tanpa titik atau koma</small>
                                @error('tiket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kontak -->
                            <div class="form-group">
                                <label for="kontak" class="form-label">
                                    <i class="mdi mdi-phone text-primary mr-1"></i>
                                    Kontak <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-whatsapp"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                           id="kontak" name="kontak" value="{{ old('kontak') }}"
                                           placeholder="Contoh: 081234567890" maxlength="15" required>
                                </div>
                                <small class="form-text text-muted">Nomor telepon atau WhatsApp yang dapat dihubungi</small>
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Upload File -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card upload-card">
                                <div class="card-header bg-gradient-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="mdi mdi-camera mr-2"></i>Upload Foto Destinasi
                                        <span class="badge bg-light text-primary ml-2" id="fileCount">0 File</span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <!-- File Upload Area -->
                                    <div class="custom-file-upload mb-4">
                                        <input type="file"
                                               class="form-control-file @error('foto_destinasi.*') is-invalid @enderror"
                                               id="foto_destinasi"
                                               name="foto_destinasi[]"
                                               multiple
                                               accept="image/*,.pdf,.doc,.docx"
                                               onchange="previewFiles(this)">
                                        <label for="foto_destinasi" class="upload-label">
                                            <div class="upload-icon">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="upload-text">
                                                <h5>Drop files here or click to upload</h5>
                                                <p class="text-muted">Format yang didukung: JPG, PNG, GIF, WEBP, PDF, DOC</p>
                                                <p class="text-muted">Maksimal 5MB per file</p>
                                            </div>
                                        </label>
                                        @error('foto_destinasi.*')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- File List Preview -->
                                    <div class="file-list-section">
                                        <h6 class="section-title">
                                            <i class="mdi mdi-file-multiple mr-2"></i>
                                            Daftar File yang akan diupload
                                            <span class="badge badge-pill badge-info" id="selectedCount">0</span>
                                        </h6>

                                        <!-- Empty State -->
                                        <div class="empty-state text-center py-5" id="emptyState">
                                            <i class="mdi mdi-file-image text-muted" style="font-size: 80px;"></i>
                                            <h5 class="text-muted mt-3">Belum ada file yang dipilih</h5>
                                            <p class="text-muted">Upload foto atau dokumen pendukung destinasi</p>
                                        </div>

                                        <!-- File Preview Container -->
                                        <div class="file-preview-container" id="filePreviewContainer" style="display: none;">
                                            <div class="row" id="filePreviewRow"></div>

                                            <!-- File Info Summary -->
                                            <div class="file-summary mt-3 p-3 bg-light rounded">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <small class="text-muted">
                                                            <i class="mdi mdi-file mr-1"></i>
                                                            Total File: <span id="totalFiles">0</span>
                                                        </small>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <small class="text-muted">
                                                            <i class="mdi mdi-weight mr-1"></i>
                                                            Total Size: <span id="totalSize">0 KB</span>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('destinasiwisata.index') }}" class="btn btn-outline-secondary btn-action">
                                    <i class="mdi mdi-close mr-1"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary btn-action" id="submitBtn">
                                    <i class="mdi mdi-content-save mr-1"></i>Simpan Destinasi
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

<!-- Modal Preview Gambar -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h6 class="modal-title" id="imagePreviewTitle"></h6>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <img id="modalPreviewImage" src="" class="img-fluid w-100" alt="Preview">
            </div>
            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-light" data-dismiss="modal">
                    <i class="mdi mdi-close mr-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Variables
    let selectedFiles = [];
    let totalSize = 0;
    const MAX_SIZE = 5 * 1024 * 1024; // 5MB in bytes

    // Auto format untuk input RT dan RW (hanya angka)
    document.getElementById('rt').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 3) {
            this.value = this.value.substring(0, 3);
        }
    });

    document.getElementById('rw').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 3) {
            this.value = this.value.substring(0, 3);
        }
    });

    // Auto format untuk input kontak (hanya angka dan +)
    document.getElementById('kontak').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9+]/g, '');
    });

    // Format harga tiket saat kehilangan fokus
    document.getElementById('tiket').addEventListener('blur', function(e) {
        let value = this.value.replace(/[^0-9]/g, '');
        if (value) {
            this.value = Number(value).toLocaleString('id-ID');
        }
    });

    // Format harga tiket saat fokus (hapus separator)
    document.getElementById('tiket').addEventListener('focus', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Helper functions untuk preview file
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function getFileType(mimeType) {
        if (mimeType.startsWith('image/')) {
            return mimeType.split('/')[1].toUpperCase();
        } else if (mimeType.includes('pdf')) {
            return 'PDF';
        } else if (mimeType.includes('word') || mimeType.includes('document')) {
            return 'DOC';
        } else {
            return 'File';
        }
    }

    function getFileIcon(mimeType) {
        if (mimeType.startsWith('image/')) {
            return 'mdi-image';
        } else if (mimeType.includes('pdf')) {
            return 'mdi-file-pdf-box';
        } else if (mimeType.includes('word') || mimeType.includes('document')) {
            return 'mdi-file-word-box';
        } else {
            return 'mdi-file-document-box';
        }
    }

    function getFileColor(mimeType) {
        if (mimeType.startsWith('image/')) {
            return 'text-info';
        } else if (mimeType.includes('pdf')) {
            return 'text-danger';
        } else if (mimeType.includes('word') || mimeType.includes('document')) {
            return 'text-primary';
        } else {
            return 'text-secondary';
        }
    }

    function truncateFileName(name, maxLength = 15) {
        if (name.length <= maxLength) return name;
        return name.substring(0, maxLength) + '...';
    }

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

    // Preview Files Function
    function previewFiles(input) {
        const files = input.files;
        selectedFiles = Array.from(files);

        const emptyState = document.getElementById('emptyState');
        const filePreviewContainer = document.getElementById('filePreviewContainer');
        const filePreviewRow = document.getElementById('filePreviewRow');
        const fileCountElement = document.getElementById('fileCount');
        const selectedCountElement = document.getElementById('selectedCount');
        const totalFilesElement = document.getElementById('totalFiles');
        const totalSizeElement = document.getElementById('totalSize');
        const submitBtn = document.getElementById('submitBtn');

        // Reset
        filePreviewRow.innerHTML = '';
        totalSize = 0;

        if (files.length > 0) {
            // Hide empty state, show preview
            emptyState.style.display = 'none';
            filePreviewContainer.style.display = 'block';

            // Update counters
            fileCountElement.textContent = `${files.length} File`;
            selectedCountElement.textContent = files.length;
            totalFilesElement.textContent = files.length;

            // Process each file
            Array.from(files).forEach((file, index) => {
                totalSize += file.size;

                const fileSize = formatFileSize(file.size);
                const fileType = getFileType(file.type);
                const fileIcon = getFileIcon(file.type);
                const fileColor = getFileColor(file.type);

                // Create preview card
                const colDiv = document.createElement('div');
                colDiv.className = 'col-md-3 col-sm-4 col-6 mb-3';

                colDiv.innerHTML = `
                    <div class="file-preview-card">
                        <div class="file-preview-header">
                            <span class="file-badge">${index + 1}</span>
                            <button type="button" class="btn-remove-file" onclick="removeFile(${index})" title="Hapus file">
                                <i class="mdi mdi-close"></i>
                            </button>
                        </div>
                        <div class="file-preview-body" onclick="viewFilePreview(${index})">
                            ${file.type.startsWith('image/') ?
                                `<img src="${URL.createObjectURL(file)}" class="file-preview-img" alt="${file.name}">` :
                                `<div class="file-icon-preview ${fileColor}">
                                    <i class="mdi ${fileIcon}"></i>
                                </div>`
                            }
                        </div>
                        <div class="file-preview-footer">
                            <div class="file-name" title="${file.name}">${truncateFileName(file.name)}</div>
                            <div class="file-info">
                                <span class="file-type">${fileType}</span>
                                <span class="file-size">${fileSize}</span>
                            </div>
                        </div>
                    </div>
                `;

                filePreviewRow.appendChild(colDiv);

                // Check file size
                if (file.size > MAX_SIZE) {
                    showToast('error', `File ${file.name} melebihi 5MB`);
                    colDiv.classList.add('file-error');
                }
            });

            // Update total size
            totalSizeElement.textContent = formatFileSize(totalSize);

        } else {
            // Show empty state, hide preview
            emptyState.style.display = 'block';
            filePreviewContainer.style.display = 'none';
            fileCountElement.textContent = '0 File';
            selectedCountElement.textContent = '0';
        }

        // Enable/disable submit button
        submitBtn.disabled = files.length === 0;
    }

    // Remove file from selection
    function removeFile(index) {
        const dataTransfer = new DataTransfer();
        const input = document.getElementById('foto_destinasi');

        // Remove file from selectedFiles array
        selectedFiles.splice(index, 1);

        // Update DataTransfer with remaining files
        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        // Update file input
        input.files = dataTransfer.files;

        // Trigger change event to update preview
        const event = new Event('change', { bubbles: true });
        input.dispatchEvent(event);

        showToast('info', 'File dihapus dari daftar upload');
    }

    // View file preview in modal
    function viewFilePreview(index) {
        const file = selectedFiles[index];

        if (file.type.startsWith('image/')) {
            const modal = document.getElementById('imagePreviewModal');
            const modalImage = document.getElementById('modalPreviewImage');
            const modalTitle = document.getElementById('imagePreviewTitle');

            modalImage.src = URL.createObjectURL(file);
            modalTitle.textContent = file.name;

            $(modal).modal('show');
        } else {
            // For non-image files, show info
            showToast('info', `File: ${file.name} (${formatFileSize(file.size)})`);
        }
    }

    // Form validation
    document.getElementById('destinasiForm').addEventListener('submit', function(e) {
        let hasError = false;

        // Check required fields
        const requiredFields = ['nama', 'deskripsi', 'alamat', 'rt', 'rw', 'jam_buka', 'tiket', 'kontak'];
        requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                hasError = true;
            }
        });

        // Check if files are selected
        if (selectedFiles.length === 0) {
            showToast('warning', 'Harap pilih minimal 1 foto destinasi');
            hasError = true;
        }

        // Check file sizes
        selectedFiles.forEach(file => {
            if (file.size > MAX_SIZE) {
                showToast('error', `File ${file.name} melebihi batas 5MB`);
                hasError = true;
            }
        });

        if (hasError) {
            e.preventDefault();
            showToast('error', 'Harap perbaiki data yang masih salah');
        }
    });

    // Auto dismiss alerts setelah 5 detik
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
</script>

<style>
/* ==================== CREATE FORM STYLES ==================== */
.create-card {
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease;
    border: none;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.create-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.create-card .card-title {
    color: #333;
    font-weight: 600;
    font-size: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
}

.form-label i {
    font-size: 18px;
    margin-right: 8px;
}

.form-control, .form-control-file {
    border-radius: 10px;
    border: 2px solid #e0e0e0;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-control-file:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    transform: translateY(-1px);
}

.input-group {
    border-radius: 10px;
    overflow: hidden;
}

.input-group-prepend .input-group-text {
    background: linear-gradient(135deg, #4e73df, #224abe);
    color: white;
    border: none;
    font-weight: 600;
}

/* ==================== UPLOAD CARD STYLES ==================== */
.upload-card {
    border-radius: 12px;
    overflow: hidden;
    border: 3px dashed #e0e0e0;
    transition: all 0.3s ease;
}

.upload-card:hover {
    border-color: #4e73df;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(78, 115, 223, 0.15);
}

.upload-card .card-header {
    background: linear-gradient(135deg, #4e73df, #224abe);
    border-bottom: none;
    padding: 15px 20px;
}

.upload-card .card-header h5 {
    font-size: 1.25rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.upload-card .card-header .badge {
    font-size: 0.8rem;
    padding: 5px 10px;
    border-radius: 12px;
    font-weight: 600;
}

/* ==================== CUSTOM FILE UPLOAD ==================== */
.custom-file-upload {
    position: relative;
    margin-bottom: 20px;
}

.custom-file-upload input[type="file"] {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 3px dashed #4e73df;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.upload-label:hover {
    background: linear-gradient(135deg, #e9ecef, #dee2e6);
    border-color: #224abe;
    transform: translateY(-3px);
}

.upload-icon {
    font-size: 60px;
    color: #4e73df;
    margin-bottom: 15px;
    transition: transform 0.3s ease;
}

.upload-label:hover .upload-icon {
    transform: scale(1.1);
    color: #224abe;
}

.upload-text h5 {
    color: #333;
    font-weight: 600;
    margin-bottom: 10px;
}

.upload-text p {
    margin-bottom: 5px;
    color: #666;
}

/* ==================== FILE LIST SECTION ==================== */
.file-list-section {
    margin-top: 20px;
}

.section-title {
    color: #495057;
    font-weight: 600;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}

.section-title .badge {
    margin-left: 10px;
    font-size: 0.8rem;
    padding: 4px 8px;
}

.empty-state {
    padding: 60px 20px;
    background: #f8f9fa;
    border-radius: 12px;
    border: 2px dashed #dee2e6;
    transition: all 0.3s ease;
}

.empty-state:hover {
    border-color: #4e73df;
    background: #f0f5ff;
}

.empty-state i {
    opacity: 0.5;
    transition: opacity 0.3s ease;
}

.empty-state:hover i {
    opacity: 0.8;
}

.empty-state h5 {
    font-size: 1.2rem;
    margin-top: 20px;
    margin-bottom: 10px;
}

/* ==================== FILE PREVIEW CARDS ==================== */
.file-preview-card {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    background: white;
    border: 2px solid #e0e0e0;
    transition: all 0.3s ease;
    height: 100%;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
}

.file-preview-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    border-color: #4e73df;
}

.file-preview-card.file-error {
    border-color: #dc3545;
    animation: shake 0.5s;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.file-preview-header {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-between;
    padding: 8px;
    z-index: 2;
}

.file-badge {
    background: rgba(0, 0, 0, 0.7);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
}

.btn-remove-file {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    border: none;
    background: rgba(220, 53, 69, 0.9);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    opacity: 0;
}

.file-preview-card:hover .btn-remove-file {
    opacity: 1;
}

.btn-remove-file:hover {
    background: #dc3545;
    transform: scale(1.1);
}

.file-preview-body {
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    overflow: hidden;
    background: #f8f9fa;
}

.file-preview-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.file-preview-card:hover .file-preview-img {
    transform: scale(1.1);
}

.file-icon-preview {
    font-size: 50px;
    text-align: center;
}

.file-preview-footer {
    padding: 12px;
    background: white;
    border-top: 1px solid #f0f0f0;
}

.file-name {
    font-weight: 600;
    color: #333;
    font-size: 14px;
    margin-bottom: 5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.file-info {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
}

.file-type {
    color: #6c757d;
    background: #f8f9fa;
    padding: 2px 8px;
    border-radius: 4px;
    font-weight: 500;
}

.file-size {
    color: #495057;
    font-weight: 500;
}

.file-summary {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 1px solid #dee2e6;
}

.file-summary small {
    font-weight: 500;
}

.file-summary i {
    font-size: 14px;
    margin-right: 5px;
}

/* ==================== BUTTON ACTIONS ==================== */
.btn-action {
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 120px;
}

.btn-action:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

.btn-outline-secondary.btn-action:hover {
    background-color: #6c757d;
    color: white;
    border-color: #6c757d;
}

.btn-primary.btn-action {
    background: linear-gradient(135deg, #4e73df, #224abe);
    border: none;
}

.btn-primary.btn-action:hover {
    background: linear-gradient(135deg, #224abe, #4e73df);
    transform: translateY(-3px) scale(1.02);
}

.btn-primary.btn-action:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
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

.toast-warning {
    border-left-color: #FF9800;
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

.toast-warning .toast-content i {
    color: #FF9800;
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

/* ==================== RESPONSIVE STYLES ==================== */
@media (max-width: 1200px) {
    .file-preview-card {
        height: 160px;
    }

    .file-preview-body {
        height: 130px;
    }
}

@media (max-width: 992px) {
    .create-card .card-title {
        font-size: 1.3rem;
    }

    .upload-label {
        padding: 30px 15px;
    }

    .upload-icon {
        font-size: 50px;
    }

    .upload-text h5 {
        font-size: 1.1rem;
    }

    .file-preview-card {
        height: 150px;
    }

    .file-preview-body {
        height: 120px;
    }

    .btn-action {
        padding: 10px 20px;
        min-width: 110px;
    }
}

@media (max-width: 768px) {
    .create-card {
        margin: 0 -15px;
        border-radius: 0;
    }

    .form-label {
        font-size: 0.95rem;
    }

    .upload-card .card-header h5 {
        font-size: 1.1rem;
    }

    .upload-label {
        padding: 25px 10px;
    }

    .upload-icon {
        font-size: 40px;
    }

    .upload-text h5 {
        font-size: 1rem;
        text-align: center;
    }

    .upload-text p {
        font-size: 0.85rem;
        text-align: center;
    }

    .file-preview-card {
        height: 140px;
    }

    .file-preview-body {
        height: 110px;
    }

    .file-name {
        font-size: 12px;
    }

    .file-info {
        font-size: 11px;
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
    .create-card .card-title {
        font-size: 1.2rem;
    }

    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 10px;
    }

    .btn-action {
        width: 100%;
        margin-top: 10px;
    }

    .upload-label {
        padding: 20px 10px;
    }

    .upload-icon {
        font-size: 35px;
    }

    .upload-text h5 {
        font-size: 0.95rem;
    }

    .upload-text p {
        font-size: 0.8rem;
    }

    .file-preview-card {
        height: 130px;
    }

    .file-preview-body {
        height: 100px;
    }

    .btn-remove-file {
        opacity: 1;
    }

    .file-summary .row {
        flex-direction: column;
        gap: 10px;
    }

    .file-summary .text-right {
        text-align: left !important;
    }
}

@media (max-width: 400px) {
    .file-preview-card {
        height: 120px;
    }

    .file-preview-body {
        height: 90px;
    }

    .file-preview-footer {
        padding: 8px;
    }

    .file-name {
        font-size: 11px;
    }

    .toast-notification {
        min-width: 250px;
        max-width: 280px;
        padding: 15px 20px;
    }
}
</style>
@endsection
