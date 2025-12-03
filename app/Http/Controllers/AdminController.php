<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    // === HALAMAN DASHBOARD ADMIN ===
    public function index()
    {
        // 1. Data Tabel (Seperti Sebelumnya)
        $laporans = Pengaduan::with('user')->latest()->get();
        $wargas = User::where('role', 'warga')->with('masterWarga')->latest()->get();

        // 2. DATA GRAFIK 1: KATEGORI (Doughnut Chart)
        // Menghitung jumlah laporan per kategori
        // Hasil: ['Sampah' => 5, 'Keamanan' => 2, ...]
        $grafikKategori = Pengaduan::selectRaw('kategori, count(*) as total')
                            ->groupBy('kategori')
                            ->pluck('total', 'kategori');

        // 3. DATA GRAFIK 2: TREN HARIAN (Line Chart - 7 Hari Terakhir)
        // Kita siapkan array kosong untuk 7 hari ke belakang
        $grafikTren = [];
        for ($i = 6; $i >= 0; $i--) {
            // Ambil tanggal (H-6 sampai Hari Ini)
            $date = now()->subDays($i)->format('Y-m-d');
            
            // Hitung jumlah laporan pada tanggal tersebut
            $jumlah = Pengaduan::whereDate('created_at', $date)->count();
            
            // Masukkan ke array (Format: '04 Dec' => 5)
            $grafikTren[now()->subDays($i)->format('d M')] = $jumlah;
        }

        return view('admin.dashboard', compact('laporans', 'wargas', 'grafikKategori', 'grafikTren'));
    }


    // === UPDATE STATUS LAPORAN ===

    public function updateStatusLaporan(Request $request, $id)
    {
    $laporan = Pengaduan::findOrFail($id);

    $laporan->status = $request->status;
    $laporan->tanggapan_admin = $request->tanggapan;

    // --- TAMBAHAN: NYALAKAN NOTIFIKASI ---
    $laporan->is_unread = 1; // Tandai sebagai belum dibaca oleh warga
    // -------------------------------------

    $laporan->save();

    return back()->with('success', 'Status laporan diperbarui & notifikasi dikirim ke warga.');
    }

    // === HAPUS AKUN WARGA (FITUR BARU) ===
    public function destroyUser($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Pastikan yang dihapus bukan admin sendiri (Safety check)
        if ($user->role === 'admin') {
            return back()->with('error', 'Anda tidak bisa menghapus akun Admin!');
        }

        // Hapus User
        // Note: Karena kita set 'onDelete cascade' di database, 
        // semua laporan & data keluarga user ini akan otomatis terhapus juga.
        $user->delete();

        return back()->with('success', 'Akun warga berhasil dihapus bersih.');
    }

    // === FITUR EXPORT LAPORAN (CSV / EXCEL) ===
    public function exportLaporan()
    {
        // 1. Ambil data laporan sebulan terakhir
        $laporans = Pengaduan::with('user')
                    ->where('created_at', '>=', now()->subMonth()) // Filter 1 bulan
                    ->latest()
                    ->get();

        // 2. Nama File saat didownload
        $fileName = 'Laporan_Warga_' . date('Y-m-d_H-i') . '.csv';

        // 3. Header agar browser tahu ini file Excel/CSV
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // 4. Fungsi Callback untuk menulis isi file
        $callback = function() use ($laporans) {
            $file = fopen('php://output', 'w');

            // Header Kolom (Baris Pertama)
            fputcsv($file, ['No', 'Tanggal', 'Pelapor', 'Judul Laporan', 'Lokasi', 'Kategori', 'Status', 'Isi Laporan', 'Tanggapan Admin']);

            // Isi Data (Looping)
            foreach ($laporans as $index => $row) {
                fputcsv($file, [
                    $index + 1,
                    $row->created_at->format('d-m-Y H:i'),
                    $row->user->name ?? 'Anonim',
                    $row->judul_laporan,
                    $row->lokasi_kejadian,
                    $row->kategori,
                    $row->status,
                    $row->deskripsi,
                    $row->tanggapan_admin ?? '-'
                ]);
            }

            fclose($file);
        };

        // 5. Download File
        return response()->stream($callback, 200, $headers);
    }

    // === FITUR EXPORT PDF (RESMI) ===
    public function exportPdf()
    {
        // 1. Ambil data (sama seperti excel)
        $laporans = Pengaduan::with('user')
                    ->where('created_at', '>=', now()->subMonth())
                    ->latest()
                    ->get();

        // 2. Load View khusus PDF dan kirim datanya
        $pdf = Pdf::loadView('admin.pdf_report', compact('laporans'));

        // 3. Download file
        return $pdf->stream('Laporan_Resmi_Bulanan.pdf');
        
        // Opsional: Kalau mau lihat di browser dulu (preview), ganti ->download() jadi ->stream()
    }
}