<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laman Utama RumahAduan</title>
  <!-- Viewport Mobile Friendly (Updated) -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>

    @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(239, 68, 68, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }
    /* CSS TEMANMU (PERSIS - BASE) */
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
      width: 100%; max-width: 1180px; background: rgba(255, 255, 255, 0.88);
      border-radius: var(--radius-lg); padding: 26px 30px 30px;
      box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12); backdrop-filter: blur(18px);
    }

    /* HEADER */
    .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; }
    .left-header { display: flex; align-items: center; gap: 16px; }
    .profile-text { display: flex; flex-direction: column; align-items: flex-start; }
    .profile-text small { font-size: 0.73rem; letter-spacing: 0.16em; text-transform: uppercase; color: var(--text-muted); }
    .profile-text h1 { margin-top: 3px; font-size: 1.35rem; font-weight: 700; display: flex; align-items: center; gap: 8px; }
    .badge-status { font-size: 0.7rem; padding: 2px 8px; border-radius: 999px; background: #ecfdf5; color: #15803d; border: 1px solid #bbf7d0; }
    .logo-top { height: 46px; }

    .sub-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; color: var(--text-muted); font-size: 0.83rem; }
    .pill-small { padding: 4px 10px; border-radius: 999px; background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 6px; }

    /* TOMBOL PROFIL & LOGOUT */
    .btn-action { font-size: 0.78rem; padding: 6px 16px; border-radius: 999px; text-decoration: none; border: 1px solid; transition: 0.2s; }
    .btn-outline-primary-custom { border-color: #6366f1; color: #4c1d95; background: #eef2ff; }
    .btn-outline-primary-custom:hover { background: #e0e7ff; color: #312e81; }
    .btn-outline-danger-custom { border-color: #fca5a5; color: #991b1b; background: #fef2f2; margin-left: 5px; }
    .btn-outline-danger-custom:hover { background: #fee2e2; }

    /* HERO BANNER */
    .hero-banner { position: relative; width: 100%; height: 380px; border-radius: 26px; overflow: hidden; display: flex; align-items: stretch; margin-bottom: 35px; box-shadow: 0 18px 40px rgba(15, 23, 42, 0.35); }
    .hero-slider { position: absolute; inset: 0; }
    .hero-slide { width: 100%; height: 100%; object-fit: cover; position: absolute; opacity: 0; transition: opacity 1.3s ease-in-out; }
    .hero-slide.active { opacity: 1; }
    .hero-gradient { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,0.15)), radial-gradient(circle at top left, rgba(255,255,255,0.10), transparent 70%), linear-gradient(135deg, rgba(76, 29, 149, 0.10), rgba(30, 27, 75, 0.20)); pointer-events: none; }
    
    .hero-overlay-wrapper { position: relative; z-index: 5; display: flex; flex-direction: column; justify-content: space-between; padding: 26px 34px; height: 100%; color: #f9fafb; }
    .big-logo { height: 120px !important; filter: drop-shadow(0 8px 20px rgba(0, 0, 0, 0.5)); }
    
    .blok-outline { border: 1px solid rgba(255,255,255,0.85); padding: 6px 14px; border-radius: 12px; font-size: 0.85rem; color: #ffffff; display: inline-flex; align-items: center; width: fit-content; backdrop-filter: blur(6px); background: rgba(15,23,42,0.35); }

    /* FEATURES */
    .section-title { font-size: 1rem; margin: 4px 2px 10px; font-weight: 700; color: var(--purple); display: flex; align-items: center; gap: 8px; }
    .section-title span { font-size: 0.74rem; color: var(--text-muted); font-weight: 500; }
    
    .feature-row { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin-bottom: 26px; }
    .feature-card { position: relative; border-radius: 22px; padding: 18px 14px 17px; text-align: left; cursor: pointer; transition: 0.25s ease; box-shadow: 0 14px 34px rgba(15, 23, 42, 0.16); color: #f9fafb; overflow: hidden; text-decoration: none; display: block; }
    .feature-card:hover { transform: translateY(-6px); box-shadow: 0 18px 44px rgba(15, 23, 42, 0.22); }
    .feature-header { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; position: relative; z-index: 1; }
    .feature-icon-wrap { width: 40px; height: 40px; border-radius: 999px; background: rgba(15, 23, 42, 0.2); display: flex; align-items: center; justify-content: center; font-size: 22px; }
    .feature-title { font-size: 0.98rem; font-weight: 700; }
    .feature-sub { font-size: 0.76rem; opacity: 0.92; }
    .feature-meta-chip { position: relative; z-index: 1; margin: 4px 0; font-size: 0.7rem; padding: 4px 9px; border-radius: 999px; background: rgba(15, 23, 42, 0.25); display: inline-block; }
    .feature-btn { position: relative; z-index: 1; margin-top: 10px; padding: 6px 16px; font-size: 0.78rem; font-weight: 600; border-radius: 999px; border: none; color: #111827; background: #f9fafb; box-shadow: 0 8px 18px rgba(15, 23, 42, 0.22); display: inline-block; }
    
    .purple-grad { background: linear-gradient(135deg, #7c3aed, #4c1d95); }
    .pink-grad   { background: linear-gradient(135deg, #ec4899, #be185d); }

    /* INFO & MAP */
    .pill-card { position: relative; border-radius: 24px; padding: 16px 18px 18px; margin-bottom: 18px; color: #0f172a; background: #ffffff; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08); overflow: hidden; border: 1px solid #e5e7eb; }
    .pill-label { position: absolute; top: 14px; left: 18px; background: #eef2ff; padding: 4px 12px; border-radius: 999px; font-size: 0.73rem; letter-spacing: 0.18em; text-transform: uppercase; color: #4338ca; border: 1px solid #c7d2fe; }
    .pill-title { margin-top: 34px; margin-bottom: 4px; font-size: 1.02rem; font-weight: 700; color: var(--purple); }
    .pill-desc { font-size: 0.82rem; color: var(--text-muted); margin-bottom: 8px; }
    
    .info-table { width: 100%; border-collapse: collapse; font-size: 0.83rem; }
    .info-table th, .info-table td { padding: 7px 10px; text-align: left; border-bottom: 1px solid #e5e7eb; }
    .info-table th { background: #f9fafb; font-weight: 600; color: #4b5563; }
    
    .map-box iframe { width: 100%; height: 260px; border: 0; display: block; border-radius: 18px; }

    footer { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 10px; border-top: 1px solid #e5e7eb; font-size: 0.8rem; color: var(--text-muted); }
    footer img { height: 28px; }

    /* ========================================= */
    /* MODIFIKASI RESPONSIVE (LAYOUT MOBILE)     */
    /* ========================================= */
    @media (max-width: 576px) {
      /* 1. Body & Container lebih lega */
      body { padding: 15px 10px; }
      .app-shell { padding: 20px 15px; border-radius: 20px; }

      /* 2. Header (Top Bar) */
      .top-bar { flex-direction: row; flex-wrap: wrap; gap: 10px; }
      .left-header { width: 100%; justify-content: space-between; } /* Nama user & logo sejajar */
      .logo-top { height: 35px; } /* Logo sedikit dikecilkan */
      .profile-text h1 { font-size: 1.1rem; } /* Font nama user disesuaikan */
      
      /* Tombol Profil & Logout (Supaya ga dempet) */
      .btn-action { padding: 5px 12px; font-size: 0.75rem; margin-top: 5px; display: inline-block; }

      /* 3. Sub-Header (Teks Selamat Datang) */
      .sub-header { flex-direction: column; align-items: flex-start; gap: 10px; font-size: 0.8rem; }

      /* 4. Hero Banner (Slider) */
      .hero-banner { 
        height: 220px; /* Tinggi slider dikurangi drastis agar tidak menuhin layar HP */
        border-radius: 18px; 
      }
      .hero-overlay-wrapper { padding: 15px; }
      .big-logo { height: 60px !important; } /* Logo di slider dikecilkan */
      .blok-outline { font-size: 0.7rem; padding: 4px 10px; }

      /* 5. Menu Grid (Akses Cepat) */
      .feature-row { 
        grid-template-columns: 1fr; /* Jadi 1 kolom ke bawah */
        gap: 15px;
      }
      .feature-card { padding: 20px 15px; } /* Padding dalam kartu */

      /* 6. Info & Peta */
      .pill-card { padding: 15px; }
      .info-table th, .info-table td { 
        padding: 8px 5px; 
        font-size: 0.75rem; /* Font tabel dikecilkan sedikit */
      }
      .map-box iframe { height: 200px; }

      /* 7. Footer */
      footer { flex-direction: column; gap: 10px; text-align: center; }
    }
    </style>

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

</head>
<body>

<div class="app-shell">

  <!-- HEADER ATAS -->
  <header class="top-bar">
    <div class="left-header">
      <div class="profile-text">
        <small>DASHBOARD KELUARGA</small>
        <h1>
          <!-- MENAMPILKAN NO KK ASLI -->
          {{ Auth::user()->masterWarga->no_kk ?? 'Data KK Tidak Ditemukan' }}
          <span class="badge-status">Akun Aktif</span>
        </h1>
        
        <div class="mt-2">
            <!-- Tombol Lihat Profil (Sementara ke edit profil) -->
            <a href="{{ route('profile.edit') }}" class="btn-action btn-outline-primary-custom">
                👤 Profil
            </a>

            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-action btn-outline-danger-custom">
                    Keluar
                </button>
            </form>
        </div>
      </div>
      
      <!-- Logo dipindah ke kanan di mobile via flexbox -->
      <img src="{{ asset('images/logo-rumah-aduan.png') }}" class="logo-top" alt="RumahAduan" onerror="this.style.display='none'">
    </div>
  </header>

  <div class="sub-header">
    <div>
      <strong>Halo, {{ Auth::user()->name }}!</strong> &mdash; Solusi Cepat untuk Masalah Warga Komplek Bougenville.
    </div>
    <div class="pill-small">
      <span style="font-size:11px;">●</span> Keluarga Terverifikasi
    </div>
  </div>

  <!-- HERO BANNER -->
  <section class="hero-banner">
    <div class="hero-slider">
      <!-- Pastikan gambar ada di public/images -->
      <img src="{{ asset('images/slide1.png') }}" class="hero-slide active" alt="slide1">
      <img src="{{ asset('images/slide2.png') }}" class="hero-slide" alt="slide2">
      <img src="{{ asset('images/slide3.png') }}" class="hero-slide" alt="slide3">
    </div>

    <div class="hero-gradient"></div>

    <div class="hero-overlay-wrapper">
      <div class="hero-banner-top">
        <img src="{{ asset('images/logo-rumah-aduan.png') }}" class="hero-banner-logo big-logo" alt="" onerror="this.style.display='none'">
      </div>

      <div class="hero-bottom-rev">
        <div class="blok-outline">
          <!-- Menampilkan Alamat Asli dari Database Master Warga -->
          📍 Blok {{ Auth::user()->masterWarga->blok ?? '-' }} No. {{ Auth::user()->masterWarga->no_rumah ?? '-' }} 
          • Komplek Bougenville
        </div>
      </div>
    </div>
  </section>

  <!-- FITUR UTAMA -->
  <section>
    <h3 class="section-title">
      Akses Cepat
      <span>Fitur utama RumahAduan</span>
    </h3>

    <div class="feature-row">
      <!-- Jejak Aduan -->
        <a href="{{ route('pengaduan.index') }}" class="feature-card purple-grad" style="position: relative;">
            
            <!-- NOTIFIKASI BADGE (Hanya muncul jika ada pesan belum dibaca) -->
            @if(isset($unreadCount) && $unreadCount > 0)
                <div style="position: absolute; top: 15px; right: 15px; background: #ef4444; color: white; width: 25px; height: 25px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: bold; border: 2px solid white; box-shadow: 0 4px 6px rgba(0,0,0,0.2); animation: pulse 2s infinite;">
                    {{ $unreadCount }}
                </div>
            @endif

            <div class="feature-header">
            <div class="feature-icon-wrap">📜</div>
            <div>
                <div class="feature-title">Jejak Aduan</div>
                <div class="feature-sub">
                    @if(isset($unreadCount) && $unreadCount > 0)
                        <span style="color: #fbbf24; font-weight: bold;">{{ $unreadCount }} update baru dari Admin!</span>
                    @else
                        Lihat riwayat & status penanganan.
                    @endif
                </div>
            </div>
            </div>
        <!-- Menghitung Jumlah Laporan User Ini -->
        @php
            $jumlahLaporan = \App\Models\Pengaduan::where('user_id', Auth::id())->count();
        @endphp
        <div class="feature-meta-chip">
          {{ $jumlahLaporan }} aduan aktif saat ini
        </div>
        <div class="feature-btn">Lihat Jejak Aduan</div>
      </a>

      <!-- Aduan Baru -->
      <a href="{{ route('pengaduan.create') }}" class="feature-card pink-grad">
        <div class="feature-header">
          <div class="feature-icon-wrap">➕</div>
          <div>
            <div class="feature-title">Aduan Baru</div>
            <div class="feature-sub">Laporkan keluhan keamanan & kebersihan.</div>
          </div>
        </div>
        <div class="feature-meta-chip">
          Klik untuk mulai formulir
        </div>
        <div class="feature-btn">Buat Aduan Baru</div>
      </a>
    </div>
  </section>

  <!-- PAPAN INFORMASI -->
  <section class="pill-card info-pill">
    <div class="pill-label">Papan Informasi</div>
    <h3 class="pill-title">Kegiatan Komplek Bougenville</h3>
    <p class="pill-desc">
      Daftar kegiatan resmi yang akan dilaksanakan di lingkungan komplek.
    </p>

    <div class="info-table-wrapper">
      <table class="info-table">
        <thead>
          <tr>
            <th>Kegiatan</th>
            <th>Tanggal</th>
            <th>Deskripsi Singkat</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>Kerja Bakti</td><td>05 Feb 2025</td><td>Pembersihan selokan blok A–C.</td></tr>
          <tr><td>Senam Pagi</td><td>09 Feb 2025</td><td>Senam bersama di lapangan komplek.</td></tr>
          <tr><td>Rapat Warga</td><td>15 Feb 2025</td><td>Bahas keamanan & iuran kebersihan.</td></tr>
          <tr><td>Fogging</td><td>01 Mar 2025</td><td>Fogging nyamuk seluruh blok.</td></tr>
          <tr><td>Bazar UMKM</td><td>16 Mar 2025</td><td>Stand kuliner & produk UMKM warga.</td></tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- DENAH KOMPLEK -->
  <section class="pill-card map-pill">
    <div class="pill-label">Denah Komplek</div>
    <h3 class="pill-title">Lokasi & Akses</h3>
    <p class="pill-desc">
      Denah lokasi komplek untuk memudahkan tamu dan layanan darurat.
    </p>

    <div class="map-box">
      <!-- Google Maps Embed (Bisa diganti koordinat asli nanti) -->
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3!2d106.8!3d-6.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDgnMDAuMCJF!5e0!3m2!1sen!2sid!4v1600000000000!5m2!1sen!2sid"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div style="display:flex; align-items:center; gap:8px;">
      <img src="{{ asset('images/logo-rumah-aduan.png') }}" alt="Logo" onerror="this.style.display='none'">
      <span>RumahAduan — Solusi Cepat untuk Masalah Warga</span>
    </div>
    <span>&copy; 2025 Komplek Bougenville</span>
  </footer>
</div>

<!-- SCRIPT SLIDER -->
<script>
  const slides = document.querySelectorAll('.hero-slide');
  let current = 0;

  function showSlide(index) {
    slides.forEach(s => s.classList.remove('active'));
    if(slides[index]) slides[index].classList.add('active');
  }

  function nextSlide() {
    current = (current + 1) % slides.length;
    showSlide(current);
  }

  if (slides.length > 0) {
    showSlide(0);
    setInterval(nextSlide, 5000); // Ganti gambar setiap 5 detik
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>