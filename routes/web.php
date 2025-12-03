<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\AdminController; // Pastikan import ini ada
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- LOGIKA UTAMA (ROOT URL) ---
Route::get('/', function () {
    // 1. Cek apakah user sudah login (punya sesi/cache)
    if (Auth::check()) {
        
        // 2. Jika ADMIN -> Ke Dashboard Admin
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 3. Jika WARGA -> Ke Dashboard Warga
        return redirect()->route('dashboard');
    }

    // 4. Jika BELUM LOGIN -> Arahkan ke halaman Login
    return redirect()->route('login');
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

Route::middleware(['auth', 'cek.aktif'])->group(function () {
    
    // MODIFIKASI ROUTE DASHBOARD
    // Jika Admin -> Ke Dashboard Admin
    // Jika Warga -> Ke Dashboard Warga
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // === GROUP KHUSUS ADMIN ===
    Route::middleware('role:admin')->group(function () { // Kita butuh middleware role sebentar lagi
        Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/verifikasi/{id}', [App\Http\Controllers\AdminController::class, 'verifikasiWarga'])->name('admin.verifikasi');
        Route::patch('/admin/laporan/{id}', [App\Http\Controllers\AdminController::class, 'updateStatusLaporan'])->name('admin.laporan.update');
    });

    // ... Route Pengaduan Warga (yang sudah dibuat sebelumnya) ...
});