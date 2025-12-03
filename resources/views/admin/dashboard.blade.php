<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - RumahAduan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* === CSS TEMA UTAMA (Sama dengan User) === */
    :root {
      --purple: #6d28d9; --purple-soft: #a855f7; --purple-dark: #4c1d95;
      --bg-soft: #f5f3ff; --text-main: #111827; --text-muted: #6b7280;
      --radius-lg: 28px; --radius-md: 18px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; font-family: system-ui, -apple-system, sans-serif; }

    body {
      min-height: 100vh; margin: 0; display: flex; justify-content: center; align-items: flex-start;
      padding: 32px 12px 40px;
      /* Background Tema Temanmu */
      background: radial-gradient(circle at top left, #ede9fe 0, transparent 55%), radial-gradient(circle at bottom right, #e0f2fe 0, transparent 55%), #f9fafb;
      color: var(--text-main);
    }

    .app-shell {
      width: 100%; max-width: 1200px; background: rgba(255, 255, 255, 0.9);
      border-radius: var(--radius-lg); padding: 26px 30px 30px;
      box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12); backdrop-filter: blur(18px);
    }

    /* HEADER */
    .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
    .top-left { display: flex; flex-direction: column; gap: 4px; }
    .top-subtitle { font-size: 0.8rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--text-muted); font-weight: 700; }
    .top-title { font-size: 1.4rem; font-weight: 800; display: flex; align-items: center; gap: 10px; color: var(--purple-dark); }
    .logo-top { height: 40px; }

    /* CARD STYLE */
    .card-soft {
      border-radius: 22px; background: #ffffff;
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08); padding: 20px;
      border: 1px solid #e5e7eb;
    }

    .card-header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .card-title { font-size: 1.1rem; font-weight: 700; color: #1e3a8a; display: flex; align-items: center; gap: 8px; }
    
    /* BADGE COUNTER */
    .badge-count { background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; }

    /* TABEL STYLE (Adaptasi dari Jejak Aduan) */
    .table-responsive { border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; }
    .table-admin { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
    .table-admin thead { background: #f8fafc; }
    .table-admin th { padding: 12px 16px; text-align: left; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }
    .table-admin td { padding: 14px 16px; vertical-align: top; border-bottom: 1px solid #f1f5f9; }
    .table-admin tbody tr:hover { background: #f8fafc; }

    /* ELEMEN TABEL */
    .user-info { font-weight: 700; color: #0f172a; margin-bottom: 2px; }
    .date-info { font-size: 0.75rem; color: #94a3b8; }
    .report-title { font-weight: 600; color: #334155; font-size: 0.95rem; margin-bottom: 4px; }
    .report-loc { font-size: 0.8rem; color: #64748b; margin-bottom: 8px; display: flex; align-items: center; gap: 4px; }
    .report-desc { background: #f1f5f9; padding: 8px 12px; border-radius: 12px; font-size: 0.8rem; color: #475569; line-height: 1.4; border-left: 3px solid #cbd5e1; }

    .foto-thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 12px; border: 1px solid #e2e8f0; transition: transform 0.2s; }
    .foto-thumb:hover { transform: scale(1.5); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }

    /* FORM AKSI ADMIN */
    .action-box { background: #f8fafc; padding: 12px; border-radius: 16px; border: 1px solid #e2e8f0; }
    .form-select-sm { border-radius: 8px; border-color: #cbd5e1; font-size: 0.8rem; margin-bottom: 8px; }
    .form-control-sm { border-radius: 8px; border-color: #cbd5e1; font-size: 0.8rem; margin-bottom: 8px; }
    
    .btn-update {
      width: 100%; border-radius: 8px; padding: 6px; font-size: 0.8rem; font-weight: 600; border: none; color: white;
      background: linear-gradient(135deg, #2563eb, #1d4ed8); box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2); transition: 0.2s;
    }
    .btn-update:hover { background: linear-gradient(135deg, #1d4ed8, #1e40af); transform: translateY(-1px); }

    /* LOGOUT BUTTON */
    .btn-logout { 
      border: 1px solid #fca5a5; color: #991b1b; background: #fef2f2; 
      padding: 6px 16px; border-radius: 99px; font-size: 0.8rem; text-decoration: none; font-weight: 600; 
    }
    .btn-logout:hover { background: #fee2e2; }

    /* BADGE STATUS */
    .status-badge { padding: 4px 10px; border-radius: 99px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; }
    .bg-terkirim { background: #dbeafe; color: #1e40af; }
    .bg-diproses { background: #fef9c3; color: #854d0e; }
    .bg-selesai { background: #dcfce7; color: #166534; }
    .bg-ditolak { background: #fee2e2; color: #991b1b; }

    footer { display: flex; justify-content: space-between; align-items: center; margin-top: 22px; padding-top: 10px; border-top: 1px solid #e5e7eb; font-size: 0.8rem; color: var(--text-muted); }
    footer img { height: 24px; }

    @media (max-width: 900px) { .app-shell { padding: 20px; } .table-admin th, .table-admin td { padding: 10px; } }
  </style>
</head>
<body>

<div class="app-shell">

  <!-- HEADER -->
  <header class="top-bar">
    <div class="top-left">
      <div class="top-subtitle">ADMINISTRATOR</div>
      <div class="top-title">
        Dashboard Pak RT
      </div>
    </div>
    
    <div style="display: flex; align-items: center; gap: 15px;">
        <span style="font-size: 0.9rem; color: #4b5563;">Halo, <strong>{{ Auth::user()->name }}</strong></span>
        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Keluar</button>
        </form>
        <img src="{{ asset('images/logo-rumah-aduan.png') }}" class="logo-top" alt="Logo" onerror="this.style.display='none'">
    </div>
  </header>

  <!-- ALERT -->
  @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center" role="alert">
        <span style="font-size: 1.2rem; margin-right: 10px;">✅</span>
        <div><strong>Berhasil!</strong> {{ session('success') }}</div>
    </div>
  @endif

  <!-- TABEL LAPORAN -->
  <section>
    <div class="card-soft">
        <div class="card-header-flex">
            <div class="card-title">
                <span>📨 Laporan Masuk</span>
                <span class="badge-count">{{ $laporans->count() }} Total</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-admin">
                <thead>
                    <tr>
                        <th style="width: 20%;">Pelapor & Waktu</th>
                        <th style="width: 35%;">Detail Masalah</th>
                        <th style="width: 10%;">Foto</th>
                        <th style="width: 35%;">Tindakan & Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $laporan)
                    <tr>
                        <!-- KOLOM 1: PELAPOR -->
                        <td>
                            <div class="user-info">{{ $laporan->user->name ?? 'Warga (Anonim)' }}</div>
                            <div class="date-info">{{ $laporan->created_at->format('d M Y, H:i') }}</div>
                            <div class="mt-2">
                                @php
                                    $bgClass = match($laporan->status) {
                                        'Terkirim' => 'bg-terkirim',
                                        'Diproses' => 'bg-diproses',
                                        'Selesai'  => 'bg-selesai',
                                        'Ditolak'  => 'bg-ditolak',
                                        default    => 'bg-terkirim'
                                    };
                                @endphp
                                <span class="status-badge {{ $bgClass }}">{{ $laporan->status }}</span>
                            </div>
                        </td>

                        <!-- KOLOM 2: DETAIL -->
                        <td>
                            <div class="report-title">{{ $laporan->judul_laporan }}</div>
                            <div class="report-loc">📍 {{ $laporan->lokasi_kejadian }} <span class="badge bg-light text-dark border ms-1">{{ $laporan->kategori }}</span></div>
                            <div class="report-desc">
                                "{{ $laporan->deskripsi }}"
                            </div>
                        </td>

                        <!-- KOLOM 3: FOTO -->
                        <td class="text-center">
                            <a href="{{ asset('storage/'.$laporan->foto_bukti) }}" target="_blank">
                                <img src="{{ asset('storage/'.$laporan->foto_bukti) }}" class="foto-thumb" alt="Bukti">
                            </a>
                            <br>
                            <a href="{{ asset('storage/'.$laporan->foto_bukti) }}" target="_blank" style="font-size: 0.7rem; text-decoration: none;">Lihat</a>
                        </td>

                        <!-- KOLOM 4: AKSI -->
                        <td>
                            <div class="action-box">
                                <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <label style="font-size: 0.7rem; font-weight: 700; color: #64748b; margin-bottom: 2px; display:block;">Update Status:</label>
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="Terkirim" {{ $laporan->status == 'Terkirim' ? 'selected' : '' }}>🔵 Terkirim (Baru)</option>
                                        <option value="Diproses" {{ $laporan->status == 'Diproses' ? 'selected' : '' }}>🟡 Sedang Diproses</option>
                                        <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                                        <option value="Ditolak" {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>🔴 Tolak Laporan</option>
                                    </select>

                                    <label style="font-size: 0.7rem; font-weight: 700; color: #64748b; margin-bottom: 2px; display:block;">Balasan ke Warga:</label>
                                    <input type="text" name="tanggapan" value="{{ $laporan->tanggapan_admin }}" 
                                           class="form-control form-control-sm" placeholder="Contoh: Petugas OTW...">
                                    
                                    <button type="submit" class="btn-update">Simpan Perubahan</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <span style="font-size: 2rem;">📭</span><br>
                            Belum ada laporan masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
  </section>

  <footer>
    <div style="display:flex; align-items:center; gap:6px;">
      <img src="{{ asset('images/logo-rumah-aduan.png') }}" alt="Logo" onerror="this.style.display='none'">
      <span>Panel Admin — RumahAduan</span>
    </div>
    <span>&copy; 2025 Komplek Bougenville</span>
  </footer>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>