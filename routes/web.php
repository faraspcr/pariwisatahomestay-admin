<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinasiWisataController;
use App\Http\Controllers\PariwisataDestinasiAdminController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk auth
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Route untuk admin
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

// Route CRUD DestinasiWisata
Route::get('/destinasivisata', [DestinasiWisataController::class, 'index'])->name('destinasivisata.index');
Route::get('/destinasivisata/create', [DestinasiWisataController::class, 'create'])->name('destinasivisata.create');
Route::post('/destinasivisata', [DestinasiWisataController::class, 'store'])->name('destinasivisata.store');
Route::get('/destinasivisata/{id}/edit', [DestinasiWisataController::class, 'edit'])->name('destinasivisata.edit');
Route::put('/destinasivisata/{id}', [DestinasiWisataController::class, 'update'])->name('destinasivisata.update');
Route::delete('/destinasivisata/{id}', [DestinasiWisataController::class, 'destroy'])->name('destinasivisata.destroy');
