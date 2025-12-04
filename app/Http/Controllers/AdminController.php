<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengaduan;
use App\Models\MasterWarga;
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

    // === HALAMAN & LOGIC MANAJEMEN MASTER WARGA ===
    public function masterWargaIndex(Request $request)
    {
        $q = $request->query('q');

        $masters = MasterWarga::with('user')
            ->when($q, function($query) use ($q) {
                $query->where('no_kk', 'like', "%{$q}%")
                      ->orWhere('nama_kepala_keluarga', 'like', "%{$q}%")
                      ->orWhere('blok', 'like', "%{$q}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.warga.index', compact('masters', 'q'));
    }

    // Simpan Manual (Tambah / Update berdasarkan no_kk)
    public function storeMasterWarga(Request $request)
    {
        $data = $request->validate([
            'no_kk' => 'required|string|max:16',
            'nama_kepala_keluarga' => 'required|string|max:255',
            'blok' => 'required|string|max:10',
            'no_rumah' => 'required|string|max:10',
            'rt_rw' => 'nullable|string|max:10',
            'status_rumah' => 'nullable|in:Dihuni,Kosong'
        ]);

        $master = MasterWarga::updateOrCreate(
            ['no_kk' => $data['no_kk']],
            [
                'nama_kepala_keluarga' => $data['nama_kepala_keluarga'],
                'blok' => $data['blok'],
                'no_rumah' => $data['no_rumah'],
                'rt_rw' => $data['rt_rw'] ?? null,
                'status_rumah' => $data['status_rumah'] ?? 'Dihuni'
            ]
        );

        return back()->with('success', 'Data master warga berhasil disimpan.');
    }

    // Import CSV sederhana tanpa library eksternal
    public function importMasterWarga(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        $handle = fopen($path, 'r');
        if ($handle === false) {
            return back()->with('error', 'Gagal membuka file CSV.');
        }

        $header = null;
        $rowCount = 0; $created = 0; $updated = 0; $skipped = 0;
        $errors = [];

        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            // Jika header belum di-set, gunakan baris pertama sebagai header
            if (!$header) {
                $header = array_map(function($h){ return strtolower(trim($h)); }, $row);
                continue;
            }

            $rowCount++;
            $data = array_combine($header, $row);
            if (!$data) { $skipped++; $errors[] = "Baris {$rowCount}: gagal membaca kolom."; continue; }

            // Ambil dan bersihkan no_kk
            $noKKraw = $data['no_kk'] ?? '';
            $noKK = preg_replace('/\D/', '', $noKKraw); // hanya digit

            // Validasi ketat no_kk: harus numeric dan panjang 8-16
            if (empty($noKK) || strlen($noKK) < 8 || strlen($noKK) > 16) {
                $skipped++; $errors[] = "Baris {$rowCount}: no_kk tidak valid ('{$noKKraw}').";
                continue;
            }

            // Siapkan payload dengan trim dan batas panjang
            $payload = [
                'nama_kepala_keluarga' => substr(trim($data['nama_kepala_keluarga'] ?? ($data['nama'] ?? 'Unknown')), 0, 255),
                'blok' => substr(trim($data['blok'] ?? ($data['blok_rumah'] ?? '')), 0, 10),
                'no_rumah' => substr(trim($data['no_rumah'] ?? ($data['nomor'] ?? '')), 0, 10),
                'rt_rw' => substr(trim($data['rt_rw'] ?? ''), 0, 10),
                'status_rumah' => in_array(trim($data['status_rumah'] ?? 'Dihuni'), ['Dihuni','Kosong']) ? trim($data['status_rumah']) : 'Dihuni'
            ];

            // UpdateOrCreate berdasarkan no_kk
            $existing = MasterWarga::where('no_kk', $noKK)->first();
            if ($existing) {
                $existing->update($payload);
                $updated++;
            } else {
                MasterWarga::create(array_merge(['no_kk' => $noKK], $payload));
                $created++;
            }
        }

        fclose($handle);

        $summary = "Import selesai: total baris={$rowCount}, dibuat={$created}, diperbarui={$updated}, dilewati={$skipped}.";
        if (!empty($errors)) {
            $summary .= ' Contoh error: ' . implode(' | ', array_slice($errors, 0, 5));
        }

        return back()->with('success', $summary);
    }

    // Hapus master warga
    public function destroyMasterWarga($id)
    {
        $master = MasterWarga::with('user')->findOrFail($id);

        // Hapus user terkait (jika ada) agar data di database konsisten
        \DB::transaction(function() use ($master) {
            if ($master->user) {
                // Menghapus user akan menghapus pengaduan & anggota keluarga (cascade di migration)
                $master->user->delete();
            }

            // Hapus master warga
            $master->delete();
        });

        return back()->with('success', 'Data master warga dan akun terkait berhasil dihapus.');
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