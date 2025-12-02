<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengaduan;
use App\Models\MasterWarga;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // === HALAMAN DASHBOARD ADMIN ===
    public function index()
    {
        // 1. Ambil data warga yang statusnya PENDING (Butuh Verifikasi)
        $pendingUsers = User::where('status_akun', 'pending')->get();

        // 2. Ambil semua laporan pengaduan (Urutkan dari yang terbaru)
        $laporans = Pengaduan::with('user')->latest()->get();

        // 3. Kirim data ke tampilan dashboard admin
        return view('admin.dashboard', compact('pendingUsers', 'laporans'));
    }

    // === LOGIKA VERIFIKASI WARGA (SUDAH DIPERBAIKI) ===
    public function verifikasiWarga(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Validasi Input (Action: approve / reject)
        $action = $request->input('action');

        if ($action == 'approve') {
            // FIX: Tidak perlu cari No KK lagi karena sudah tersimpan di master_warga_id saat register
            // Cukup ubah status jadi active
            $user->status_akun = 'active';
            $user->save();
            
            return back()->with('success', 'Akun warga berhasil diaktifkan. Sekarang mereka bisa login.');
        } 
        
        elseif ($action == 'reject') {
            $user->status_akun = 'rejected';
            $user->alasan_penolakan = $request->input('alasan'); // Simpan alasan
            $user->save();

            return back()->with('success', 'Akun warga ditolak.');
        }
    }

    // === LOGIKA UPDATE STATUS LAPORAN ===
    public function updateStatusLaporan(Request $request, $id)
    {
        $laporan = Pengaduan::findOrFail($id);
        
        $laporan->status = $request->status; // Diproses / Selesai / Ditolak
        $laporan->tanggapan_admin = $request->tanggapan; // Pesan balik ke warga
        $laporan->save();

        return back()->with('success', 'Status laporan diperbarui.');
    }
}