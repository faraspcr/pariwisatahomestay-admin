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
use App\Http\Controllers\HomestayController;

// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    return view('pages.auth.login');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// ==================== HARUS LOGIN ====================
Route::middleware(['checkislogin'])->group(function () {
    // ============ DASHBOARD & LOGOUT ============
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // ============ PROFILE SENDIRI (SEMUA ROLE) ============
    Route::prefix('my-profile')->group(function () {
        Route::get('/', [UserController::class, 'myProfile'])->name('user.my-profile');
        Route::put('/', [UserController::class, 'updateMyProfile'])->name('user.update-my-profile');
        Route::delete('/photo', [UserController::class, 'deleteMyProfilePhoto'])->name('user.delete-my-profile-photo');
    });

    // ============ ADMIN: FULL ACCESS ============
    Route::middleware(['checkrole:admin'])->prefix('admin')->name('admin.')->group(function () {
        // User Management
        Route::resource('user', UserController::class);

        // Warga Management
        Route::resource('warga', WargaController::class);

        // Destinasi Wisata
        Route::resource('destinasiwisata', DestinasiWisataController::class);

        // ⭐⭐⭐ ROUTE UNTUK FILE DESTINASI WISATA ⭐⭐⭐
        Route::prefix('destinasiwisata')->name('destinasiwisata.')->group(function () {
            Route::get('/{destinasi}/file/{fileId}/show', [DestinasiWisataController::class, 'showFile'])->name('show-file');
            Route::get('/{destinasi}/file/{fileId}/download', [DestinasiWisataController::class, 'downloadFile'])->name('download-file');
            Route::delete('/{destinasi}/file/{fileId}', [DestinasiWisataController::class, 'deleteFile'])->name('delete-file');
            Route::post('/{destinasi}/upload', [DestinasiWisataController::class, 'uploadFiles'])->name('upload-files');
        });

        // Homestay (semua)
        Route::resource('homestay', HomestayController::class);

        // ⭐⭐⭐ ROUTE UNTUK FILE HOMESTAY (TAMBAHKAN INI) ⭐⭐⭐
        Route::prefix('homestay')->name('homestay.')->group(function () {
            Route::get('/{homestay}/file/{fileId}/show', [HomestayController::class, 'showFile'])->name('show-file');
            Route::get('/{homestay}/file/{fileId}/download', [HomestayController::class, 'downloadFile'])->name('download-file');
            Route::delete('/{homestay}/file/{fileId}', [HomestayController::class, 'deleteFile'])->name('delete-file');
            Route::post('/{homestay}/upload', [HomestayController::class, 'uploadFiles'])->name('upload-files');
        });

        // Kamar (semua)
        Route::resource('kamarhomestay', KamarHomestayController::class);

        // ⭐⭐⭐ ROUTE UNTUK FILE KAMAR (TAMBAHKAN INI) ⭐⭐⭐
        Route::prefix('kamarhomestay')->name('kamarhomestay.')->group(function () {
            Route::get('/{kamar}/file/{fileId}/show', [KamarHomestayController::class, 'showFile'])->name('show-file');
            Route::get('/{kamar}/file/{fileId}/download', [KamarHomestayController::class, 'downloadFile'])->name('download-file');
            Route::delete('/{kamar}/file/{fileId}', [KamarHomestayController::class, 'deleteFile'])->name('delete-file');
            Route::post('/{kamar}/upload', [KamarHomestayController::class, 'uploadFiles'])->name('upload-files');
        });

        // Booking (semua)
        Route::resource('booking-homestay', BookingHomestayController::class)->parameters([
            'booking-homestay' => 'booking'
        ]);

        // ⭐⭐⭐ ROUTE UNTUK FILE BOOKING (TAMBAHKAN INI) ⭐⭐⭐
        Route::prefix('booking-homestay')->name('booking-homestay.')->group(function () {
            Route::get('/{booking}/file/{fileId}/show', [BookingHomestayController::class, 'showFile'])->name('show-file');
            Route::get('/{booking}/file/{fileId}/download', [BookingHomestayController::class, 'downloadFile'])->name('download-file');
            Route::delete('/{booking}/file/{fileId}', [BookingHomestayController::class, 'deleteFile'])->name('delete-file');
            Route::post('/{booking}/upload', [BookingHomestayController::class, 'uploadFiles'])->name('upload-files');
        });

        // Ulasan (semua)
        Route::resource('ulasan_wisata', UlasanWisataController::class)->parameters([
            'ulasan_wisata' => 'ulasan'
        ]);
    });

    // ============ PEMILIK HOMESTAY ============
    Route::middleware(['checkrole:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
        // Dashboard Pemilik
        Route::get('/dashboard', [DashboardController::class, 'pemilikDashboard'])->name('dashboard');

        // ✅ Homestay miliknya sendiri (CRUD)
        Route::get('/homestay', [HomestayController::class, 'myHomestay'])->name('homestay.index');
        Route::get('/homestay/create', [HomestayController::class, 'create'])->name('homestay.create');
        Route::post('/homestay', [HomestayController::class, 'store'])->name('homestay.store');
        Route::get('/homestay/{homestay}', [HomestayController::class, 'show'])->name('homestay.show');
        Route::get('/homestay/{homestay}/edit', [HomestayController::class, 'edit'])->name('homestay.edit');
        Route::put('/homestay/{homestay}', [HomestayController::class, 'update'])->name('homestay.update');
        Route::delete('/homestay/{homestay}', [HomestayController::class, 'destroy'])->name('homestay.destroy');

        // ✅ Kamar di homestay miliknya (CRUD)
        Route::get('/kamar', [KamarHomestayController::class, 'myHomestayKamar'])->name('kamar.index');
        Route::get('/kamar/create', [KamarHomestayController::class, 'create'])->name('kamar.create');
        Route::post('/kamar', [KamarHomestayController::class, 'store'])->name('kamar.store');
        Route::get('/kamar/{kamar}', [KamarHomestayController::class, 'show'])->name('kamar.show');
        Route::get('/kamar/{kamar}/edit', [KamarHomestayController::class, 'edit'])->name('kamar.edit');
        Route::put('/kamar/{kamar}', [KamarHomestayController::class, 'update'])->name('kamar.update');
        Route::delete('/kamar/{kamar}', [KamarHomestayController::class, 'destroy'])->name('kamar.destroy');

        // ✅ Booking di homestay miliknya (lihat & kelola)
        Route::get('/booking', [BookingHomestayController::class, 'myHomestayBooking'])->name('booking.index');
        Route::get('/booking/{booking}', [BookingHomestayController::class, 'show'])->name('booking.show');
        Route::put('/booking/{booking}', [BookingHomestayController::class, 'update'])->name('booking.update');

        // ✅ Ulasan Wisata (HANYA LIHAT)
        Route::get('/ulasan', [UlasanWisataController::class, 'index'])->name('ulasan.index');
        Route::get('/ulasan/{ulasan}', [UlasanWisataController::class, 'show'])->name('ulasan.show');

        // ✅ Destinasi Wisata (HANYA LIHAT)
        Route::get('/destinasi', [DestinasiWisataController::class, 'index'])->name('destinasi.index');
        Route::get('/destinasi/{destinasi}', [DestinasiWisataController::class, 'show'])->name('destinasi.show');

        // ✅ Data Warga (HANYA LIHAT)
        Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
        Route::get('/warga/{warga}', [WargaController::class, 'show'])->name('warga.show');
    });

    // ============ WARGA ============
    Route::middleware(['checkrole:warga'])->prefix('warga')->name('warga.')->group(function () {
        // Dashboard Warga
        Route::get('/dashboard', [DashboardController::class, 'wargaDashboard'])->name('dashboard');

        // ✅ Booking miliknya sendiri (lihat & buat)
        Route::get('/booking', [BookingHomestayController::class, 'myBooking'])->name('booking.index');
        Route::get('/booking/create', [BookingHomestayController::class, 'create'])->name('booking.create');
        Route::post('/booking', [BookingHomestayController::class, 'store'])->name('booking.store');
        Route::get('/booking/{booking}', [BookingHomestayController::class, 'show'])->name('booking.show');
        Route::get('/booking/{booking}/edit', [BookingHomestayController::class, 'edit'])->name('booking.edit');
        Route::put('/booking/{booking}', [BookingHomestayController::class, 'update'])->name('booking.update');
        Route::delete('/booking/{booking}', [BookingHomestayController::class, 'destroy'])->name('booking.destroy');

        // ✅ Ulasan miliknya sendiri (buat, lihat, edit)
        Route::get('/ulasan', [UlasanWisataController::class, 'myUlasan'])->name('ulasan.index');
        Route::get('/ulasan/create', [UlasanWisataController::class, 'create'])->name('ulasan.create');
        Route::post('/ulasan', [UlasanWisataController::class, 'store'])->name('ulasan.store');
        Route::get('/ulasan/{ulasan}/edit', [UlasanWisataController::class, 'edit'])->name('ulasan.edit');
        Route::put('/ulasan/{ulasan}', [UlasanWisataController::class, 'update'])->name('ulasan.update');
        Route::delete('/ulasan/{ulasan}', [UlasanWisataController::class, 'destroy'])->name('ulasan.destroy');

        // ✅ Data dirinya sendiri (lihat & edit)
        Route::get('/data-saya', [WargaController::class, 'myData'])->name('warga.my-data');
        Route::get('/data-saya/edit', [WargaController::class, 'editMyData'])->name('warga.edit-my-data');
        Route::put('/data-saya', [WargaController::class, 'updateMyData'])->name('warga.update-my-data');

        // ✅ Destinasi Wisata (HANYA LIHAT)
        Route::get('/destinasi', [DestinasiWisataController::class, 'index'])->name('destinasi.index');
        Route::get('/destinasi/{destinasi}', [DestinasiWisataController::class, 'show'])->name('destinasi.show');

        // ✅ Homestay (HANYA LIHAT)
        Route::get('/homestay', [HomestayController::class, 'index'])->name('homestay.index');
        Route::get('/homestay/{homestay}', [HomestayController::class, 'show'])->name('homestay.show');

        // ✅ Kamar (HANYA LIHAT)
        Route::get('/kamar', [KamarHomestayController::class, 'index'])->name('kamar.index');
        Route::get('/kamar/{kamar}', [KamarHomestayController::class, 'show'])->name('kamar.show');
    });

    // ============ VIEW ONLY UNTUK SEMUA ROLE ============
    // Semua role bisa akses route ini (view only)
    Route::prefix('view')->name('view.')->group(function () {
        // Destinasi: view only
        Route::get('/destinasi', [DestinasiWisataController::class, 'publicIndex'])->name('destinasi.index');
        Route::get('/destinasi/{destinasi}', [DestinasiWisataController::class, 'publicShow'])->name('destinasi.show');

        // Homestay: view only
        Route::get('/homestay', [HomestayController::class, 'publicIndex'])->name('homestay.index');
        Route::get('/homestay/{homestay}', [HomestayController::class, 'publicShow'])->name('homestay.show');

        // Kamar: view only
        Route::get('/kamar', [KamarHomestayController::class, 'publicIndex'])->name('kamar.index');
        Route::get('/kamar/{kamar}', [KamarHomestayController::class, 'publicShow'])->name('kamar.show');

        // Ulasan: view only
        Route::get('/ulasan', [UlasanWisataController::class, 'publicIndex'])->name('ulasan.index');
        Route::get('/ulasan/{ulasan}', [UlasanWisataController::class, 'publicShow'])->name('ulasan.show');
    });

    // ============ FILE UPLOAD ROUTES (DENGAN AUTHORIZATION DI CONTROLLER) ============
    Route::prefix('files')->name('files.')->group(function () {
        // Homestay files
        Route::post('/homestay/{homestay}/upload', [HomestayController::class, 'uploadFiles'])->name('homestay.upload');
        Route::delete('/homestay/{homestay}/{fileId}', [HomestayController::class, 'deleteFile'])->name('homestay.delete-file');
        // ✅ TAMBAHKAN INI:
        Route::get('/homestay/{homestay}/{fileId}/show', [HomestayController::class, 'showFile'])->name('homestay.show-file');
        Route::get('/homestay/{homestay}/{fileId}/download', [HomestayController::class, 'downloadFile'])->name('homestay.download-file');

        // Kamar files
        Route::post('/kamar/{kamar}/upload', [KamarHomestayController::class, 'uploadFiles'])->name('kamar.upload');
        Route::delete('/kamar/{kamar}/{fileId}', [KamarHomestayController::class, 'deleteFile'])->name('kamar.delete-file');
        // ✅ TAMBAHKAN INI:
        Route::get('/kamar/{kamar}/{fileId}/show', [KamarHomestayController::class, 'showFile'])->name('kamar.show-file');
        Route::get('/kamar/{kamar}/{fileId}/download', [KamarHomestayController::class, 'downloadFile'])->name('kamar.download-file');

        // Destinasi files
        Route::post('/destinasi/{destinasi}/upload', [DestinasiWisataController::class, 'uploadFiles'])->name('destinasi.upload');
        Route::delete('/destinasi/{destinasi}/{fileId}', [DestinasiWisataController::class, 'deleteFile'])->name('destinasi.delete-file');
        // ✅ TAMBAHKAN INI:
        Route::get('/destinasi/{destinasi}/{fileId}/show', [DestinasiWisataController::class, 'showFile'])->name('destinasi.show-file');
        Route::get('/destinasi/{destinasi}/{fileId}/download', [DestinasiWisataController::class, 'downloadFile'])->name('destinasi.download-file');

        // Booking files
        Route::post('/booking/{booking}/upload', [BookingHomestayController::class, 'uploadFiles'])->name('booking.upload');
        Route::delete('/booking/{booking}/{fileId}', [BookingHomestayController::class, 'deleteFile'])->name('booking.delete-file');
        // ✅ TAMBAHKAN INI:
        Route::get('/booking/{booking}/{fileId}/show', [BookingHomestayController::class, 'showFile'])->name('booking.show-file');
        Route::get('/booking/{booking}/{fileId}/download', [BookingHomestayController::class, 'downloadFile'])->name('booking.download-file');
    });
});
