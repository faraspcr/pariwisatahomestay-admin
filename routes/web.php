<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PariwisataDestinasiAdminController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});



// Route untuk auth

// Route untuk auth
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout'); // ✅ TAMBAHKAN ROUTE LOGOUT

// Route untuk admin - HARUS SETELAH LOGIN
Route::get('/admin/pariwisata', [PariwisataDestinasiAdminController::class, 'index'])->name('pariwisata.admin');
