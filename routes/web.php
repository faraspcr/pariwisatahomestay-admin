<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UlasanWisataController;
use App\Http\Controllers\KamarHomestayController;
use App\Http\Controllers\BookingHomestayController;
use App\Http\Controllers\DestinasiWisataController;
use App\Http\Controllers\HomestayController; // ✅ PASTIKAN INI ADA!


// TAMBAHKAN: Route untuk authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');

// TAMBAHKAN: Route logout
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route CRUD Warga
Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
Route::put('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
Route::delete('/warga/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');

// Destinasi Wisata Routes
Route::resource('destinasiwisata', DestinasiWisataController::class);

// Route untuk upload files
Route::post('destinasiwisata/{id}/upload-files', [DestinasiWisataController::class, 'uploadFiles'])
    ->name('destinasiwisata.upload-files');

// Route untuk delete file - PASTIKAN METHODNYA DELETE
Route::delete('destinasiwisata/{id}/files/{fileId}', [DestinasiWisataController::class, 'deleteFile'])
    ->name('destinasiwisata.delete-file');

// Route untuk download file
Route::get('destinasiwisata/{id}/files/{fileId}/download', [DestinasiWisataController::class, 'downloadFile'])
    ->name('destinasiwisata.download-file');

// Route untuk show file di browser (preview gambar/PDF)
Route::get('destinasiwisata/{id}/files/{fileId}/show', [DestinasiWisataController::class, 'showFile'])
    ->name('destinasiwisata.show-file');

Route::post('/destinasi-wisata/{id}/files/{fileId}/rename', [DestinasiWisataController::class, 'renameFile'])
    ->name('destinasiwisata.rename-file');


// Tambahkan route untuk user
Route::resource('user', UserController::class);


Route::resource('ulasan_wisata', UlasanWisataController::class);

// Homestay Routes
Route::resource('homestay', HomestayController::class);

// File Upload Routes untuk Homestay
Route::post('homestay/{id}/upload-files', [HomestayController::class, 'uploadFiles'])->name('homestay.upload-files');
Route::delete('homestay/{id}/delete-file/{fileId}', [HomestayController::class, 'deleteFile'])->name('homestay.delete-file');
Route::get('homestay/{id}/download-file/{fileId}', [HomestayController::class, 'downloadFile'])->name('homestay.download-file');
Route::get('homestay/{id}/show-file/{fileId}', [HomestayController::class, 'showFile'])->name('homestay.show-file');


// Route untuk Kamar Homestay dengan file upload
Route::resource('kamar_homestay', KamarHomestayController::class);
Route::post('kamar_homestay/{id}/upload-files', [KamarHomestayController::class, 'uploadFiles'])->name('kamar_homestay.upload-files');
Route::delete('kamar_homestay/{id}/delete-file/{fileId}', [KamarHomestayController::class, 'deleteFile'])->name('kamar_homestay.delete-file');
Route::get('kamar_homestay/{id}/download-file/{fileId}', [KamarHomestayController::class, 'downloadFile'])->name('kamar_homestay.download-file');
Route::get('kamar_homestay/{id}/show-file/{fileId}', [KamarHomestayController::class, 'showFile'])->name('kamar_homestay.show-file');
Route::post('kamar_homestay/{id}/rename-file/{fileId}', [KamarHomestayController::class, 'renameFile'])->name('kamar_homestay.rename-file');

// Booking Homestay Routes dengan Multiple Upload
Route::resource('booking-homestay', BookingHomestayController::class);
Route::post('booking-homestay/{id}/upload-files', [BookingHomestayController::class, 'uploadFiles'])->name('booking-homestay.upload-files');
Route::delete('booking-homestay/{id}/delete-file/{fileId}', [BookingHomestayController::class, 'deleteFile'])->name('booking-homestay.delete-file');
Route::get('booking-homestay/{id}/download-file/{fileId}', [BookingHomestayController::class, 'downloadFile'])->name('booking-homestay.download-file');
Route::get('booking-homestay/{id}/show-file/{fileId}', [BookingHomestayController::class, 'showFile'])->name('booking-homestay.show-file');
Route::put('booking-homestay/{id}/rename-file/{fileId}', [BookingHomestayController::class, 'renameFile'])->name('booking-homestay.rename-file');
