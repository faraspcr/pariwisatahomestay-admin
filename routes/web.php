<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // ============ PROFILE SENDIRI ============
    Route::prefix('my-profile')->group(function () {
        Route::get('/', [UserController::class, 'myProfile'])->name('user.my-profile');
        Route::put('/', [UserController::class, 'updateMyProfile'])->name('user.update-my-profile');
        Route::delete('/photo', [UserController::class, 'deleteMyProfilePhoto'])->name('user.delete-my-profile-photo');
    });

    // ============ HANYA ADMIN ============
    Route::middleware(['checkrole:admin'])->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('warga', WargaController::class);
        Route::resource('destinasiwisata', DestinasiWisataController::class);

        // File upload untuk destinasi
        Route::post('destinasiwisata/{id}/upload-files', [DestinasiWisataController::class, 'uploadFiles'])
            ->name('destinasiwisata.upload-files');
        Route::delete('destinasiwisata/{id}/files/{fileId}', [DestinasiWisataController::class, 'deleteFile'])
            ->name('destinasiwisata.delete-file');
        Route::get('destinasiwisata/{id}/files/{fileId}/download', [DestinasiWisataController::class, 'downloadFile'])
            ->name('destinasiwisata.download-file');
        Route::get('destinasiwisata/{id}/files/{fileId}/show', [DestinasiWisataController::class, 'showFile'])
            ->name('destinasiwisata.show-file');
        Route::post('/destinasi-wisata/{id}/files/{fileId}/rename', [DestinasiWisataController::class, 'renameFile'])
            ->name('destinasiwisata.rename-file');

        // Homestay
        Route::get('homestay', [HomestayController::class, 'index'])->name('homestay.index');
        Route::get('homestay/create', [HomestayController::class, 'create'])->name('homestay.create');
        Route::post('homestay', [HomestayController::class, 'store'])->name('homestay.store');
        Route::get('homestay/{id}', [HomestayController::class, 'show'])->name('homestay.show');
        Route::get('homestay/{id}/edit', [HomestayController::class, 'edit'])->name('homestay.edit');
        Route::put('homestay/{id}', [HomestayController::class, 'update'])->name('homestay.update');
        Route::delete('homestay/{id}', [HomestayController::class, 'destroy'])->name('homestay.destroy');

        // Kamar Homestay
        Route::get('kamar_homestay', [KamarHomestayController::class, 'index'])->name('kamar_homestay.index');
        Route::get('kamar_homestay/create', [KamarHomestayController::class, 'create'])->name('kamar_homestay.create');
        Route::post('kamar_homestay', [KamarHomestayController::class, 'store'])->name('kamar_homestay.store');
        Route::get('kamar_homestay/{id}', [KamarHomestayController::class, 'show'])->name('kamar_homestay.show');
        Route::get('kamar_homestay/{id}/edit', [KamarHomestayController::class, 'edit'])->name('kamar_homestay.edit');
        Route::put('kamar_homestay/{id}', [KamarHomestayController::class, 'update'])->name('kamar_homestay.update');
        Route::delete('kamar_homestay/{id}', [KamarHomestayController::class, 'destroy'])->name('kamar_homestay.destroy');

        // Booking Homestay
        Route::get('booking-homestay', [BookingHomestayController::class, 'index'])->name('booking-homestay.index');
        Route::get('booking-homestay/{id}', [BookingHomestayController::class, 'show'])->name('booking-homestay.show');

        // Ulasan Wisata - ADMIN BISA SEMUA
        Route::get('ulasan_wisata', [UlasanWisataController::class, 'index'])->name('ulasan_wisata.index');
        Route::get('ulasan_wisata/{id}', [UlasanWisataController::class, 'show'])->name('ulasan_wisata.show');
        Route::get('ulasan_wisata/{id}/edit', [UlasanWisataController::class, 'edit'])->name('ulasan_wisata.edit'); // TAMBAH INI
        Route::put('ulasan_wisata/{id}', [UlasanWisataController::class, 'update'])->name('ulasan_wisata.update'); // TAMBAH INI
        Route::delete('ulasan_wisata/{id}', [UlasanWisataController::class, 'destroy'])->name('ulasan_wisata.destroy');
    });

    // ============ HANYA PEMILIK ============
    Route::middleware(['checkrole:pemilik'])->group(function () {
        // Homestay Saya
        Route::get('homestay-saya', [HomestayController::class, 'myHomestay'])->name('homestay.my');
        Route::get('homestay-saya/create', [HomestayController::class, 'create'])->name('homestay.my.create');
        Route::post('homestay-saya', [HomestayController::class, 'store'])->name('homestay.my.store');
        Route::get('homestay-saya/{id}/edit', [HomestayController::class, 'edit'])->name('homestay.my.edit');
        Route::put('homestay-saya/{id}', [HomestayController::class, 'update'])->name('homestay.my.update');

        // Kamar Homestay Saya
        Route::get('kamar-homestay-saya', [KamarHomestayController::class, 'myKamar'])->name('kamar.my');
        Route::resource('kamar-homestay', KamarHomestayController::class)->except(['index', 'show']);

        // Booking di homestay saya
        Route::get('booking-homestay-saya', [BookingHomestayController::class, 'myHomestayBooking'])->name('booking.my-homestay');

        // Ulasan Wisata - PEMILIK BISA CREATE, EDIT, DELETE SENDIRI
        Route::get('ulasan_wisata/create', [UlasanWisataController::class, 'create'])->name('ulasan_wisata.create');
        Route::post('ulasan_wisata', [UlasanWisataController::class, 'store'])->name('ulasan_wisata.store');
        Route::get('ulasan_wisata/{id}/edit', [UlasanWisataController::class, 'edit'])->name('ulasan_wisata.edit'); // TAMBAH INI
        Route::put('ulasan_wisata/{id}', [UlasanWisataController::class, 'update'])->name('ulasan_wisata.update'); // TAMBAH INI

        // Booking
        Route::get('booking-homestay/create', [BookingHomestayController::class, 'create'])->name('booking-homestay.create');
        Route::post('booking-homestay', [BookingHomestayController::class, 'store'])->name('booking-homestay.store');
        Route::get('booking-saya', [BookingHomestayController::class, 'myBooking'])->name('booking-homestay.my');

        // Destinasi
        Route::get('destinasi', [DestinasiWisataController::class, 'publicIndex'])->name('destinasi.public');
        Route::get('destinasi/{id}', [DestinasiWisataController::class, 'publicShow'])->name('destinasi.show');
    });

    // ============ HANYA WARGA ============
    Route::middleware(['checkrole:warga'])->group(function () {
        // Ulasan Wisata - WARGA BISA CREATE, EDIT, DELETE SENDIRI
        Route::get('ulasan_wisata/create', [UlasanWisataController::class, 'create'])->name('ulasan_wisata.create');
        Route::post('ulasan_wisata', [UlasanWisataController::class, 'store'])->name('ulasan_wisata.store');
        Route::get('ulasan_wisata/{id}/edit', [UlasanWisataController::class, 'edit'])->name('ulasan_wisata.edit'); // TAMBAH INI
        Route::put('ulasan_wisata/{id}', [UlasanWisataController::class, 'update'])->name('ulasan_wisata.update'); // TAMBAH INI

        // Booking
        Route::get('booking-homestay/create', [BookingHomestayController::class, 'create'])->name('booking-homestay.create');
        Route::post('booking-homestay', [BookingHomestayController::class, 'store'])->name('booking-homestay.store');
        Route::get('booking-saya', [BookingHomestayController::class, 'myBooking'])->name('booking-homestay.my');

        // Destinasi
        Route::get('destinasi', [DestinasiWisataController::class, 'publicIndex'])->name('destinasi.public');
        Route::get('destinasi/{id}', [DestinasiWisataController::class, 'publicShow'])->name('destinasi.show');
    });

    // ============ Pemilik dan w ============
    Route::middleware(['checkrole:pemilik,warga'])->group(function () {
        // Ulasan Wisata - VIEW & DELETE OWN
        Route::get('ulasan_wisata/{id}', [UlasanWisataController::class, 'show'])->name('ulasan_wisata.show');
        Route::delete('ulasan_wisata/{id}', [UlasanWisataController::class, 'destroy'])->name('ulasan_wisata.destroy');
    });

    // ============ ADMIN & PEMILIK ============
    Route::middleware(['checkrole:admin,pemilik'])->group(function () {
        // File upload untuk homestay & kamar
        Route::post('homestay/{id}/upload-files', [HomestayController::class, 'uploadFiles'])
            ->name('homestay.upload-files');
        Route::delete('homestay/{id}/delete-file/{fileId}', [HomestayController::class, 'deleteFile'])
            ->name('homestay.delete-file');
        Route::get('homestay/{id}/download-file/{fileId}', [HomestayController::class, 'downloadFile'])
            ->name('homestay.download-file');
        Route::get('homestay/{id}/show-file/{fileId}', [HomestayController::class, 'showFile'])
            ->name('homestay.show-file');

        Route::post('kamar_homestay/{id}/upload-files', [KamarHomestayController::class, 'uploadFiles'])
            ->name('kamar_homestay.upload-files');
        Route::delete('kamar_homestay/{id}/delete-file/{fileId}', [KamarHomestayController::class, 'deleteFile'])
            ->name('kamar_homestay.delete-file');
        Route::get('kamar_homestay/{id}/download-file/{fileId}', [KamarHomestayController::class, 'downloadFile'])
            ->name('kamar_homestay.download-file');
        Route::get('kamar_homestay/{id}/show-file/{fileId}', [KamarHomestayController::class, 'showFile'])
            ->name('kamar_homestay.show-file');
        Route::post('kamar_homestay/{id}/rename-file/{fileId}', [KamarHomestayController::class, 'renameFile'])
            ->name('kamar_homestay.rename-file');
    });

    // ============ PEMILIK & WARGA ============
    Route::middleware(['checkrole:pemilik,warga'])->group(function () {
        // Booking Homestay - UPDATE/DELETE OWN
        Route::get('booking-homestay/{id}/edit', [BookingHomestayController::class, 'edit'])->name('booking-homestay.edit');
        Route::put('booking-homestay/{id}', [BookingHomestayController::class, 'update'])->name('booking-homestay.update');
        Route::delete('booking-homestay/{id}', [BookingHomestayController::class, 'destroy'])->name('booking-homestay.destroy');
        Route::post('booking-homestay/{id}/upload-files', [BookingHomestayController::class, 'uploadFiles'])
            ->name('booking-homestay.upload-files');
        Route::delete('booking-homestay/{id}/delete-file/{fileId}', [BookingHomestayController::class, 'deleteFile'])
            ->name('booking-homestay.delete-file');
        Route::get('booking-homestay/{id}/download-file/{fileId}', [BookingHomestayController::class, 'downloadFile'])
            ->name('booking-homestay.download-file');
        Route::get('booking-homestay/{id}/show-file/{fileId}', [BookingHomestayController::class, 'showFile'])
            ->name('booking-homestay.show-file');
        Route::put('booking-homestay/{id}/rename-file/{fileId}', [BookingHomestayController::class, 'renameFile'])
            ->name('booking-homestay.rename-file');
    });
});
