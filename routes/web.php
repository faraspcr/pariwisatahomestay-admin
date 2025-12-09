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


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');


// PERBAIKI: Gunakan AuthController (bukan AuthorHandler/AuthorController)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login'); // PERBAIKI: ->name() bukan ->login()
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register'); // PERBAIKI: tambahkan titik koma
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit'); // PERBAIKI: tambahkan titik koma
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Route untuk admin - PERBAIKI ROUTE YANG RUSAK
// Route::get('/admin/pariwisata', [PariwisataDestinasiAdminController::class, 'index'])->name('pariwisata.admin');
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

// Tambah route untuk upload dan delete file
Route::post('destinasiwisata/{id}/upload-files', [DestinasiWisataController::class, 'uploadFiles'])
    ->name('destinasiwisata.upload-files');

Route::delete('destinasiwisata/{id}/delete-file/{fileId}', [DestinasiWisataController::class, 'deleteFile'])
    ->name('destinasiwisata.delete-file');

// Tambahkan route untuk user
Route::resource('user', UserController::class);


Route::resource('ulasan_wisata', UlasanWisataController::class);
Route::resource('homestay', HomestayController::class);
Route::resource('kamar_homestay', KamarHomestayController::class);
Route::resource('booking-homestay', BookingHomestayController::class);

