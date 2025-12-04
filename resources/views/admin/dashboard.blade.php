<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - RumahAduan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* CSS TEMA UTAMA */
    :root {
      --purple: #6d28d9; --purple-dark: #4c1d95; --text-main: #111827; --text-muted: #6b7280;
      --radius-lg: 28px;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: system-ui, -apple-system, sans-serif; }
    body {
      min-height: 100vh; padding: 32px 12px 40px;
      background: radial-gradient(circle at top left, #ede9fe 0, transparent 55%), radial-gradient(circle at bottom right, #e0f2fe 0, transparent 55%), #f9fafb;
      color: var(--text-main);
    }
    .app-shell {
      width: 100%; max-width: 1200px; background: rgba(255, 255, 255, 0.9); margin: 0 auto;
      border-radius: var(--radius-lg); padding: 26px 30px 30px;
      box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12); backdrop-filter: blur(18px);
    }

    /* Header & General */
    .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .top-title { font-size: 1.4rem; font-weight: 800; color: var(--purple-dark); }
    .logo-top { height: 40px; }
    .btn-logout { border: 1px solid #fca5a5; color: #991b1b; background: #fef2f2; padding: 6px 16px; border-radius: 99px; font-size: 0.8rem; font-weight: 600; text-decoration: none;}
    .btn-logout:hover { background: #fee2e2; }

    /* CARD STYLE */
    .card-soft {
      border-radius: 22px; background: #ffffff; margin-bottom: 40px;
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08); padding: 20px; border: 1px solid #e5e7eb;
    }
    .card-title { font-size: 1.1rem; font-weight: 700; color: #1e3a8a; display: flex; align-items: center; gap: 8px; margin-bottom: 20px;}
    .badge-count { background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; }

    /* TABLE */
    .table-responsive { border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; }
    .table-admin { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
    .table-admin th { padding: 12px 16px; text-align: left; background: #f8fafc; color: #64748b; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; }
    .table-admin td { padding: 14px 16px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
    
    /* Elements */
    .foto-thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 12px; border: 1px solid #e2e8f0; }
    .status-badge { padding: 4px 10px; border-radius: 99px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; }
    
    /* Delete Button */
    .btn-delete {
        border: none; background: #fee2e2; color: #991b1b; padding: 6px 12px; 
        border-radius: 8px; font-size: 0.75rem; font-weight: 600; transition: 0.2s;
    }
    .btn-delete:hover { background: #fca5a5; }

    /* Update Form */
    .form-select-sm, .form-control-sm { border-radius: 8px; font-size: 0.8rem; margin-bottom: 6px; }
    .btn-update { width: 100%; border-radius: 8px; padding: 6px; font-size: 0.8rem; font-weight: 600; border: none; color: white; background: linear-gradient(135deg, #2563eb, #1d4ed8); }

    /* Status Colors */
    .bg-terkirim { background: #dbeafe; color: #1e40af; }
    .bg-diproses { background: #fef9c3; color: #854d0e; }
    .bg-selesai { background: #dcfce7; color: #166534; }
    .bg-ditolak { background: #fee2e2; color: #991b1b; }
  </style>

<link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

</head>
<body>

<div class="app-shell">

  <!-- HEADER -->
  <header class="top-bar">
    <div>
        <div style="font-size: 0.8rem; font-weight: 700; color: #6b7280; letter-spacing: 2px;">ADMINISTRATOR</div>
        <div class="top-title">Dashboard Pak RT</div>
    </div>
    
    <div style="display: flex; align-items: center; gap: 15px;">
        <span style="font-size: 0.9rem;">Halo, <strong>{{ Auth::user()->name }}</strong></span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Keluar</button>
        </form>
        <img src="{{ asset('images/logo-rumah-aduan.png') }}" class="logo-top" alt="Logo" onerror="this.style.display='none'">
    </div>
  </header>

  <!-- ALERT NOTIFIKASI -->
  @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center" role="alert">
        <span style="font-size: 1.2rem; margin-right: 10px;">✅</span>
        <div><strong>Berhasil!</strong> {{ session('success') }}</div>
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center" role="alert">
        <span style="font-size: 1.2rem; margin-right: 10px;">⚠️</span>
        <div><strong>Gagal!</strong> {{ session('error') }}</div>
    </div>
  @endif

  <!-- ================= SECTION GRAFIK STATISTIK (BARU) ================= -->
  <section style="margin-bottom: 30px;">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
        
        <!-- GRAFIK 1: KOMPOSISI MASALAH -->
        <div class="card-soft">
            <div class="card-title" style="margin-bottom: 15px;">
                <span>📊 Komposisi Masalah</span>
            </div>
            <!-- Wadah Grafik -->
            <div style="height: 250px; position: relative;">
                <canvas id="chartKategori"></canvas>
            </div>
        </div>

        <!-- GRAFIK 2: TREN SEMINGGU TERAKHIR -->
        <div class="card-soft">
            <div class="card-title" style="margin-bottom: 15px;">
                <span>📈 Tren Aduan (7 Hari)</span>
            </div>
            <!-- Wadah Grafik -->
            <div style="height: 250px; position: relative;">
                <canvas id="chartTren"></canvas>
            </div>
        </div>

    </div>
  </section>


  <!-- ================= TABEL 1: LAPORAN MASUK ================= -->
<section class="card-soft">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <!-- Judul Kiri -->
        <div class="card-title" style="margin-bottom: 0;">
            <span>📨 Laporan Masuk</span>
            <span class="badge-count">{{ $laporans->count() }}</span>
        </div>

        <!-- Tombol Kanan -->
        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ route('admin.laporan.export') }}" class="btn btn-success btn-sm d-flex align-items-center gap-2" style="border-radius: 12px; padding: 10px 18px; font-weight: 600; font-size: 0.85rem; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(34, 197, 94, 0.2);">
                📥 Excel (30 Hari)
            </a>
            <a href="{{ route('admin.laporan.export_pdf') }}" class="btn btn-danger btn-sm d-flex align-items-center gap-2" style="border-radius: 12px; padding: 10px 18px; font-weight: 600; font-size: 0.85rem; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.2);">
                📄 PDF
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-admin">
            <thead>
                <tr>
                    <th width="20%">Pelapor & Waktu</th>
                    <th width="35%">Detail Masalah</th>
                    <th width="10%" class="text-center">Foto</th>
                    <th width="35%">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporans as $laporan)
                <tr>
                    <td>
                        <div style="font-weight: 700;">{{ $laporan->user->name ?? 'Anonim' }}</div>
                        <div style="font-size: 0.75rem; color: #94a3b8;">{{ $laporan->created_at->format('d M Y, H:i') }}</div>
                        <div class="mt-2">
                            @php
                                $bgClass = match($laporan->status) {
                                    'Terkirim' => 'bg-terkirim', 'Diproses' => 'bg-diproses',
                                    'Selesai'  => 'bg-selesai', 'Ditolak'  => 'bg-ditolak', default => 'bg-terkirim'
                                };
                            @endphp
                            <span class="status-badge {{ $bgClass }}">{{ $laporan->status }}</span>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 600;">{{ $laporan->judul_laporan }}</div>
                        <div style="font-size: 0.8rem; color: #64748b;">📍 {{ $laporan->lokasi_kejadian }}</div>
                        <div style="background: #f1f5f9; padding: 8px; border-radius: 8px; margin-top: 6px; font-size: 0.8rem;">
                            "{{ $laporan->deskripsi }}"
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="{{ asset('storage/' . $laporan->foto_bukti) }}" target="_blank">
                            <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" class="foto-thumb" alt="Bukti">
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <select name="status" class="form-select form-select-sm">
                                <option value="Terkirim" {{ $laporan->status == 'Terkirim' ? 'selected' : '' }}>🔵 Terkirim</option>
                                <option value="Diproses" {{ $laporan->status == 'Diproses' ? 'selected' : '' }}>🟡 Diproses</option>
                                <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                                <option value="Ditolak" {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>🔴 Tolak</option>
                            </select>
                            <input type="text" name="tanggapan" value="{{ $laporan->tanggapan_admin }}" class="form-control form-control-sm" placeholder="Balasan ke warga...">
                            <button type="submit" class="btn-update">Update</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada laporan masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
  </section>

  <!-- ================= TABEL 2: DAFTAR WARGA ================= -->
  <section class="card-soft">
    <div class="card-title">
        <span>👥 Daftar Warga Terdaftar</span>
        <span class="badge-count">{{ $wargas->count() }}</span>
    </div>

    <div class="table-responsive">
        <table class="table-admin">
            <thead>
                <tr>
                    <th width="25%">Nama Keluarga</th>
                    <th width="20%">No KK</th>
                    <th width="20%">Kontak</th>
                    <th width="20%">Alamat</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wargas as $warga)
                <tr>
                    <td>
                        <div style="font-weight: 700; color: var(--text-main);">{{ $warga->name }}</div>
                        <div style="font-size: 0.75rem; color: #94a3b8;">Bergabung: {{ $warga->created_at->format('d M Y') }}</div>
                    </td>
                    <td>
                        <span style="font-family: monospace; font-size: 0.9rem; background: #f1f5f9; padding: 6px 10px; border-radius: 8px; font-weight: 600; color: #1e3a8a;">
                            {{ $warga->masterWarga->no_kk ?? '-' }}
                        </span>
                    </td>
                    <td>
                        <div style="font-size: 0.85rem; display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
                            <span>📧</span> 
                            <span style="color: #1e40af; word-break: break-all;">{{ $warga->email }}</span>
                        </div>
                        <div style="font-size: 0.85rem; display: flex; align-items: center; gap: 6px;">
                            <span>📞</span> 
                            <span style="color: #1e40af;">{{ $warga->no_hp ?? '-' }}</span>
                        </div>
                    </td>
                    <td>
                        <div style="font-size: 0.9rem; font-weight: 500; color: #374151;">
                            @if($warga->masterWarga)
                                📍 Blok {{ $warga->masterWarga->blok }} No. {{ $warga->masterWarga->no_rumah }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('admin.warga.destroy', $warga->id) }}" method="POST" onsubmit="return confirm('⚠️ Yakin ingin menghapus akun ini?\n\nSemua data laporan dan anggota keluarga akun ini akan ikut terhapus permanen!');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" style="width: 100%; padding: 8px 12px; border-radius: 8px;">
                                🗑️ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-6" style="padding: 20px 16px; color: #9ca3af; font-size: 0.9rem;">Belum ada warga terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
  </section>

</div>

<!-- 1. LOAD LIBRARY CHART.JS (Via CDN) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- 2. KONFIGURASI GRAFIK -->
<script>
    // --- GRAFIK 1: KATEGORI (DONAT) ---
    const ctxKategori = document.getElementById('chartKategori');
    new Chart(ctxKategori, {
        type: 'doughnut',
        data: {
            // Ambil Label (Keys) dari PHP: ['Sampah', 'Keamanan', ...]
            labels: {!! json_encode($grafikKategori->keys()) !!},
            datasets: [{
                data: {!! json_encode($grafikKategori->values()) !!}, // Ambil Angka
                backgroundColor: [
                    '#4c1d95', '#ec4899', '#3b82f6', '#10b981', '#f59e0b', '#ef4444'
                ],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' } // Legenda di kanan
            }
        }
    });

    // --- GRAFIK 2: TREN (GARIS) ---
    const ctxTren = document.getElementById('chartTren');
    new Chart(ctxTren, {
        type: 'line',
        data: {
            // Label Tanggal (Sumbu X)
            labels: {!! json_encode(array_keys($grafikTren)) !!},
            datasets: [{
                label: 'Jumlah Laporan',
                data: {!! json_encode(array_values($grafikTren)) !!}, // Data Sumbu Y
                borderColor: '#6366f1', // Warna Garis Ungu
                backgroundColor: 'rgba(99, 102, 241, 0.1)', // Warna Arsiran Bawah
                fill: true,
                tension: 0.4, // Membuat garis melengkung (smooth)
                pointRadius: 4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#6366f1',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }, // Sembunyikan legenda "Jumlah Laporan"
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }, // Sumbu Y mulai dari 0, kelipatan 1
                x: { grid: { display: false } } // Hilangkan garis vertikal biar bersih
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>