<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinasiWisataController;
use App\Http\Controllers\PariwisataDestinasiAdminController;

Route::get('/', function () {
    return view('welcome');
});

// PERBAIKI: Gunakan AuthController (bukan AuthorHandler/AuthorController)
Route::get('/auth/login', [AuthController::class, 'showLoginForm'])->name('auth.login'); // PERBAIKI: ->name() bukan ->login()
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::get('/auth/register', [AuthController::class, 'showRegisterForm'])->name('auth.register'); // PERBAIKI: tambahkan titik koma
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register.submit'); // PERBAIKI: tambahkan titik koma
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Route untuk admin - PERBAIKI ROUTE YANG RUSAK
Route::get('/admin/pariwisata', [PariwisataDestinasiAdminController::class, 'index'])->name('pariwisata.admin');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route CRUD Warga
Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
Route::put('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
Route::delete('/warga/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');

Route::resource('destinasiwisata', DestinasiWisataController::class);

// Tambahkan route untuk user
Route::resource('user', UserController::class);
