<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Jejak Aduan - RumahAduan</title>
  <!-- Viewport Mobile (Wajib) -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* CSS TEMANMU (BASE) */
    :root {
      --purple: #6d28d9; --purple-soft: #a855f7; --purple-dark: #4c1d95;
      --bg-soft: #f5f3ff; --text-main: #111827; --text-muted: #6b7280;
      --radius-lg: 28px; --radius-md: 18px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; font-family: system-ui, -apple-system, sans-serif; }

    body {
      min-height: 100vh; margin: 0; display: flex; justify-content: center; align-items: flex-start;
      padding: 32px 12px 40px;
      background: radial-gradient(circle at top left, #ede9fe 0, transparent 55%), radial-gradient(circle at bottom right, #e0f2fe 0, transparent 55%), #f9fafb;
      color: var(--text-main);
    }

    .app-shell {
      width: 100%; max-width: 1180px; background: rgba(255, 255, 255, 0.9);
      border-radius: var(--radius-lg); padding: 26px 30px 30px;
      box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12); backdrop-filter: blur(18px);
    }

    /* HEADER */
    .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
    .top-left { display: flex; flex-direction: column; gap: 4px; }
    .top-subtitle { font-size: 0.8rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--text-muted); }
    .top-title { font-size: 1.4rem; font-weight: 700; display: flex; align-items: center; gap: 10px; color: var(--purple-dark); }
    .top-chip { font-size: 0.75rem; padding: 3px 10px; border-radius: 999px; background: #eef2ff; color: #4c1d95; border: 1px solid #c7d2fe; }
    .logo-top { height: 40px; }

    .breadcrumb-mini { font-size: 0.8rem; color: var(--text-muted); margin-bottom: 18px; }
    .breadcrumb-mini a { text-decoration: none; color: #4f46e5; }
    .breadcrumb-mini a:hover { text-decoration: underline; }

    .section-label { font-size: 0.8rem; letter-spacing: 0.15em; text-transform: uppercase; color: #4338ca; }
    .section-title { font-size: 1.05rem; font-weight: 700; margin-bottom: 4px; color: #111827; }
    .section-desc { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 14px; }

    .card-soft {
      border-radius: 22px; background: #ffffff;
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08); padding: 16px 18px 18px;
    }

    .card-soft-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
    .card-soft-title { font-size: 0.96rem; font-weight: 600; color: var(--purple-dark); }

    .btn-pill-main {
      border-radius: 999px; padding: 7px 18px; font-size: 0.85rem; font-weight: 600;
      border: none; color: #ffffff; background: linear-gradient(135deg, #6366f1, #4f46e5);
      box-shadow: 0 10px 22px rgba(79, 70, 229, 0.35); text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
    }
    .btn-pill-main:hover { background: linear-gradient(135deg, #4f46e5, #4338ca); color: #ffffff; }

    .table-wrapper { 
        margin-top: 4px; border-radius: 18px; border: 1px solid #e5e7eb;
        /* Updated: Agar bisa scroll horizontal di HP */
        overflow-x: auto; 
        -webkit-overflow-scrolling: touch; 
    }
    
    .table-jejak { width: 100%; border-collapse: collapse; font-size: 0.86rem; min-width: 600px; /* Min-width agar tabel tidak gepeng di HP */ }
    .table-jejak thead { background: #f9fafb; }
    .table-jejak th, .table-jejak td { padding: 10px 14px; text-align: left; }
    .table-jejak th { font-weight: 600; color: #4b5563; border-bottom: 1px solid #e5e7eb; }
    .table-jejak tbody tr:nth-child(odd) td { background: #ffffff; }
    .table-jejak tbody tr:nth-child(even) td { background: #f9fafb; }
    .table-jejak tbody tr:hover td { background: #eef2ff; }

    /* BADGE STATUS CUSTOM */
    .badge-kategori { font-size: 0.72rem; padding: 4px 10px; border-radius: 999px; background: #e5e7eb; color: #374151; }
    
    .badge-status { font-size: 0.75rem; padding: 4px 10px; border-radius: 999px; font-weight: 600; white-space: nowrap; }
    .status-terkirim { background: #dbeafe; color: #1e40af; } 
    .status-diproses { background: #fef3c7; color: #92400e; } 
    .status-selesai { background: #dcfce7; color: #166534; }  
    .status-ditolak { background: #fee2e2; color: #991b1b; }  

    .foto-icon { height: 38px; width: 38px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; }

    /* ALERT SUKSES */
    .alert-sukses {
        background: #dcfce7; color: #166534; border: 1px solid #bbf7d0;
        padding: 15px; border-radius: 16px; margin-bottom: 20px;
        display: flex; align-items: center; gap: 10px;
    }

    footer { display: flex; justify-content: space-between; align-items: center; margin-top: 22px; padding-top: 10px; border-top: 1px solid #e5e7eb; font-size: 0.8rem; color: var(--text-muted); }
    footer img { height: 24px; }

    /* ========================================= */
    /* MODIFIKASI RESPONSIVE (LAYOUT MOBILE)     */
    /* ========================================= */
    @media (max-width: 576px) {
      /* 1. Body & Shell */
      body { padding: 15px 10px; }
      .app-shell { padding: 20px 15px; border-radius: 20px; }

      /* 2. Header Logo Pindah */
      .top-bar { flex-direction: row; flex-wrap: wrap; }
      .logo-top { height: 35px; margin-left: auto; } /* Logo geser ke kanan */
      
      /* 3. Tombol Buat Laporan Full Width */
      .card-soft-header { flex-direction: column; align-items: stretch; gap: 15px; }
      .btn-pill-main { 
        justify-content: center; width: 100%; padding: 12px; font-size: 0.95rem; 
      }

      /* 4. Tabel Scrollable */
      .table-jejak th, .table-jejak td { 
        white-space: nowrap; /* Mencegah teks turun ke bawah yg bikin tabel aneh */
        font-size: 0.75rem; 
        padding: 8px 10px;
      }

      /* 5. Footer */
      footer { flex-direction: column; gap: 10px; text-align: center; }
    }
  </style>

<link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

</head>
<body>

<div class="app-shell">

  <!-- HEADER -->
  <header class="top-bar">
    <div class="top-left">
      <div class="top-subtitle">RIWAYAT</div>
      <div class="top-title">
        Jejak Aduan
        <span class="top-chip">Daftar laporan yang pernah dikirim</span>
      </div>
    </div>
    <img src="{{ asset('images/logo-rumah-aduan.png') }}" alt="RumahAduan" class="logo-top" onerror="this.style.display='none'">
  </header>

  <div class="breadcrumb-mini">
    <a href="{{ route('dashboard') }}">&larr; Kembali ke Dashboard</a> &nbsp;•&nbsp;
    Lihat riwayat laporan dan status penanganan aduan keluarga Anda.
  </div>

  <!-- ALERT SUKSES (Dari Redirect Form) -->
  @if(session('success'))
    <div class="alert-sukses">
        <span style="font-size: 1.2rem;">✅</span>
        <div><strong>Berhasil!</strong> {{ session('success') }}</div>
    </div>
  @endif

  <!-- SECTION JEJAK ADUAN -->
  <section>
    <div class="section-label">JEJAK ADUAN</div>
    <div class="section-title">Daftar Laporan Keluarga</div>
    <p class="section-desc">
      Halaman ini menampilkan semua laporan yang pernah dikirim. Anda bisa menambahkan laporan baru
      kapan saja jika ada masalah di lingkungan komplek.
    </p>

    <div class="card-soft">
      <div class="card-soft-header">
        <div class="card-soft-title">Riwayat Pengaduan</div>
        <a href="{{ route('pengaduan.create') }}" class="btn-pill-main">
          + Buat Laporan Baru
        </a>
      </div>

      <div class="table-wrapper">
        
        <!-- LOGIKA: JIKA KOSONG -->
        @if($laporans->isEmpty())
            <div style="text-align: center; padding: 40px; color: #9ca3af;">
                <span style="font-size: 2rem; display: block; margin-bottom: 10px;">📭</span>
                Belum ada laporan yang dikirim.
            </div>
        @else
            <!-- TABEL DATA -->
            <table class="table-jejak">
            <thead>
                <tr>
                <th style="width: 16%;">Tanggal</th>
                <th style="width: 34%;">Judul & Balasan Admin</th>
                <th style="width: 14%;">Kategori</th>
                <th style="width: 16%;">Status</th>
                <th style="width: 10%;">Foto</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporans as $laporan)
                <tr>
                    <!-- Tanggal -->
                    <td>
                        {{ $laporan->created_at->format('d M Y') }}
                        <br><small style="color: #9ca3af;">{{ $laporan->created_at->format('H:i') }}</small>
                    </td>
                    
                    <!-- Judul & Tanggapan -->
                    <td>
                        <strong>{{ $laporan->judul_laporan }}</strong>
                        <div style="font-size: 0.75rem; color: #6b7280; margin-top: 2px;">{{ Str::limit($laporan->lokasi_kejadian, 30) }}</div>
                        
                        @if($laporan->tanggapan_admin)
                            <div style="margin-top: 6px; background: #eff6ff; padding: 6px; border-radius: 8px; font-size: 0.75rem; color: #1e3a8a;">
                                💬 <strong>Admin:</strong> {{ $laporan->tanggapan_admin }}
                            </div>
                        @endif
                    </td>

                    <!-- Kategori -->
                    <td>
                        <span class="badge-kategori">{{ $laporan->kategori }}</span>
                    </td>

                    <!-- Status (Warna Warni) -->
                    <td>
                        @php
                            $warnaStatus = match($laporan->status) {
                                'Terkirim' => 'status-terkirim',
                                'Diproses' => 'status-diproses',
                                'Selesai'  => 'status-selesai',
                                'Ditolak'  => 'status-ditolak',
                                default    => 'status-terkirim'
                            };
                        @endphp
                        <span class="badge-status {{ $warnaStatus }}">
                            {{ $laporan->status }}
                        </span>
                    </td>

                    <!-- Foto (Klik untuk lihat full) -->
                    <td class="text-center">
                        <!-- Menggunakan ASSET (Link langsung) -->
                        <a href="{{ asset('storage/' . $laporan->foto_bukti) }}" target="_blank">
                            <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" class="foto-icon" alt="Bukti">
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        @endif

      </div>

    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div style="display:flex; align-items:center; gap:6px;">
      <img src="{{ asset('images/logo-rumah-aduan.png') }}" alt="Logo" onerror="this.style.display='none'">
      <span>RumahAduan — Solusi Cepat untuk Masalah Warga</span>
    </div>
    <span>&copy; 2025 Komplek Bougenville</span>
  </footer>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>