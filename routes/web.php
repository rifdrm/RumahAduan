<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengaduanController; // Pastikan controller ini di-import
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Jalur Login/Register/Logout bawaan Breeze
require __DIR__.'/auth.php';

// --- AREA WARGA ---

// 1. Halaman Ruang Tunggu (Bisa diakses user 'pending')
Route::middleware(['auth'])->group(function () {
    Route::get('/menunggu-verifikasi', function () {
        return view('auth.verify-notice');
    })->name('verifikasi.notice');
});

// 2. Halaman Dashboard & Fitur Utama (HANYA user 'active')
Route::middleware(['auth', 'cek.aktif'])->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // === FITUR PENGADUAN (CRUD) ===
    // Pastikan 3 baris ini ada:
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/buat', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});