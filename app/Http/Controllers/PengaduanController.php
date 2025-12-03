<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    /**
     * HALAMAN RIWAYAT: Menampilkan daftar aduan milik user yang sedang login.
     */
    public function index()
    {
        // 1. Ambil Laporan
        $laporans = Pengaduan::where('user_id', Auth::id())
                            ->latest()
                            ->get();

        // 2. MATIKAN NOTIFIKASI (Reset is_unread jadi 0)
        // Kita update semua laporan milik user ini yang statusnya unread
        Pengaduan::where('user_id', Auth::id())
                    ->where('is_unread', 1)
                    ->update(['is_unread' => 0]);

        return view('pengaduan.index', compact('laporans'));
    }

    /**
     * HALAMAN FORM: Menampilkan formulir pembuatan aduan.
     */
    public function create()
    {
        return view('pengaduan.create');
    }

    /**
     * LOGIKA PENYIMPANAN: Menangani data yang dikirim dari form.
     */
    public function store(Request $request)
    {
        // 1. Validasi Inputan Warga
        $request->validate([
            'judul_laporan' => 'required|max:255',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'lokasi_kejadian' => 'required',
            'foto_bukti' => 'required|image|max:5120', // Wajib foto, max 5MB
        ]);

        // 2. Proses Upload Foto
        // Simpan foto ke folder 'storage/app/public/bukti_aduan'
        $path = $request->file('foto_bukti')->store('bukti_aduan', 'public');

        // 3. Simpan ke Database
        Pengaduan::create([
            'user_id' => Auth::id(), // ID user yang login otomatis
            'pelapor_nama' => Auth::user()->name, // Sementara pakai nama akun keluarga
            'judul_laporan' => $request->judul_laporan,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'foto_bukti' => $path,
            'urgensi' => 'Sedang', // Default urgency (bisa diubah nanti)
            'status' => 'Terkirim', // Status awal selalu Terkirim
        ]);

        // 4. Balikkan ke halaman riwayat dengan pesan sukses
        return redirect()->route('pengaduan.index')->with('success', 'Laporan berhasil dikirim!');
    }
}
