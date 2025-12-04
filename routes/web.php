<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\AdminController; // Pastikan import ini ada
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // --- HITUNG JUMLAH NOTIFIKASI ---
    // Hitung berapa laporan milik user ini yang is_unread = 1
    $unreadCount = \App\Models\Pengaduan::where('user_id', Auth::id())
                                        ->where('is_unread', 1)
                                        ->count();

        return view('dashboard', compact('unreadCount')); // Kirim variabel ke view
    })->name('dashboard');
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
        Route::delete('/admin/warga/{id}', [AdminController::class, 'destroyUser'])->name('admin.warga.destroy');
        Route::get('/admin/export', [AdminController::class, 'exportLaporan'])->name('admin.laporan.export');
        Route::get('/admin/export-pdf', [AdminController::class, 'exportPdf'])->name('admin.laporan.export_pdf');
        // Manajemen Master Warga (List / Manual Create / Import CSV)
        Route::get('/admin/warga', [App\Http\Controllers\AdminController::class, 'masterWargaIndex'])->name('admin.warga.index');
        Route::post('/admin/warga', [App\Http\Controllers\AdminController::class, 'storeMasterWarga'])->name('admin.warga.store');
        Route::post('/admin/warga/import', [App\Http\Controllers\AdminController::class, 'importMasterWarga'])->name('admin.warga.import');
        Route::delete('/admin/warga/master/{id}', [App\Http\Controllers\AdminController::class, 'destroyMasterWarga'])->name('admin.warga.master.destroy');
    });

    // ... Route Pengaduan Warga (yang sudah dibuat sebelumnya) ...
});