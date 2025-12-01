<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman Ruang Tunggu (Boleh diakses user pending)
Route::middleware(['auth'])->group(function () {
    Route::get('/menunggu-verifikasi', function () {
        return view('auth.verify-notice');
    })->name('verifikasi.notice');
});

// Halaman Dashboard & Profile (HANYA boleh diakses user AKTIF)
// Perhatikan kita tambah middleware 'cek.aktif' di sini
Route::middleware(['auth', 'cek.aktif'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
