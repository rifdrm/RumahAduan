<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Buat Aduan Baru - RumahAduan</title>
  <!-- Viewport Mobile (Wajib) -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* CSS DARI TEMANMU (PERSIS - BASE) */
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
    .logo-top { height: 40px; }

    .breadcrumb-mini { font-size: 0.8rem; color: var(--text-muted); margin-bottom: 18px; }
    .breadcrumb-mini a { text-decoration: none; color: #4f46e5; }
    .breadcrumb-mini a:hover { text-decoration: underline; }

    .section-label { font-size: 0.8rem; letter-spacing: 0.15em; text-transform: uppercase; color: #4338ca; }
    .section-title { font-size: 1.05rem; font-weight: 700; margin-bottom: 4px; color: #111827; }
    .section-desc { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 14px; }

    .card-soft {
      border-radius: 24px; background: #ffffff;
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
      padding: 20px 22px 18px; max-width: 900px; margin: 0 auto;
    }

    .card-soft-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
    .card-soft-title { font-size: 0.96rem; font-weight: 600; color: var(--purple-dark); }
    .badge-soft { font-size: 0.72rem; padding: 3px 9px; border-radius: 999px; background: #fef3c7; color: #92400e; }

    .form-label { font-size: 0.8rem; font-weight: 500; color: #374151; }
    .form-control, .form-select { border-radius: 999px; font-size: 0.86rem; padding: 8px 14px; border-color: #e5e7eb; }
    .form-control:focus, .form-select:focus { border-color: #6366f1; box-shadow: 0 0 0 2px rgba(129, 140, 248, 0.35); }
    textarea.form-control { border-radius: 18px; min-height: 90px; resize: vertical; }

    /* UPLOAD AREA STYLE */
    .upload-area {
      margin-top: 6px; border-radius: 20px; border: 1px dashed #cbd5f5;
      background: radial-gradient(circle at top left, #eef2ff, transparent 60%), radial-gradient(circle at bottom right, #e0f2fe, transparent 55%), #ffffff;
      padding: 18px 16px; text-align: center; font-size: 0.8rem; color: var(--text-muted);
      cursor: pointer; transition: 0.2s ease; display: block;
    }
    .upload-area strong { color: #4f46e5; }
    .upload-area:hover { border-color: #6366f1; box-shadow: 0 12px 28px rgba(79, 70, 229, 0.25); transform: translateY(-1px); }
    .upload-area input[type="file"] { display: none; }
    .upload-sub { font-size: 0.72rem; margin-top: 4px; }

    .btn-row { display: flex; justify-content: flex-end; gap: 10px; margin-top: 18px; }
    
    .btn-secondary-pill {
      border-radius: 999px; padding: 8px 18px; font-size: 0.86rem; font-weight: 500;
      border: 1px solid #d1d5db; background: #f3f4f6; color: #374151; text-decoration: none;
    }
    .btn-secondary-pill:hover { background: #e5e7eb; color: #111827; }

    .btn-primary-pill {
      border-radius: 999px; padding: 8px 20px; font-size: 0.88rem; font-weight: 600;
      border: none; color: #ffffff; background: linear-gradient(135deg, #6366f1, #4f46e5);
      box-shadow: 0 12px 26px rgba(79, 70, 229, 0.40); display: inline-flex; align-items: center; gap: 6px;
    }
    .btn-primary-pill:hover { background: linear-gradient(135deg, #4f46e5, #4338ca); color: #ffffff; }

    .text-danger { font-size: 0.75rem; color: #dc2626; margin-top: 4px; }
    .file-preview { margin-top: 8px; font-size: 0.8rem; font-weight: 600; color: #4f46e5; }

    footer { display: flex; justify-content: space-between; align-items: center; margin-top: 22px; padding-top: 10px; border-top: 1px solid #e5e7eb; font-size: 0.8rem; color: var(--text-muted); }
    footer img { height: 24px; }

    /* ========================================= */
    /* MODIFIKASI RESPONSIVE (LAYOUT MOBILE)     */
    /* ========================================= */
    @media (max-width: 576px) {
      /* 1. Body & Shell */
      body { padding: 15px 10px; }
      .app-shell { padding: 20px 15px; border-radius: 20px; }

      /* 2. Header */
      .top-bar { flex-wrap: wrap; }
      .logo-top { height: 35px; margin-left: auto; } /* Logo geser ke kanan */

      /* 3. Form Card & Input */
      .card-soft { padding: 20px 15px; border-radius: 18px; }
      .card-soft-header { flex-direction: column; align-items: flex-start; gap: 5px; margin-bottom: 18px; }
      
      .form-control, .form-select { 
        font-size: 16px; /* Mencegah auto-zoom iOS */
        padding: 10px 15px; 
      }

      /* 4. Tombol Aksi (Batal & Kirim) */
      .btn-row { 
        flex-direction: column-reverse; /* Tombol Kirim di ATAS Batal (UX Jempol) */
        gap: 12px; 
        margin-top: 25px;
      }
      .btn-primary-pill, .btn-secondary-pill {
        width: 100%; /* Tombol lebar penuh */
        justify-content: center;
        padding: 12px;
        font-size: 0.95rem;
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
      <div class="top-subtitle">LAPORAN BARU</div>
      <div class="top-title">Buat Aduan Baru</div>
    </div>
    <img src="{{ asset('images/logo-rumah-aduan.png') }}" alt="RumahAduan" class="logo-top" onerror="this.style.display='none'">
  </header>

  <div class="breadcrumb-mini">
    <a href="{{ route('dashboard') }}">&larr; Kembali ke Dashboard</a> &nbsp;•&nbsp;
    Isi formulir di bawah ini untuk melaporkan masalah di lingkungan komplek.
  </div>

  <!-- FORM START -->
  <section>
    <div class="section-label">FORMULIR ADUAN</div>
    <div class="section-title">Detail Laporan</div>
    <p class="section-desc">Mohon isi data selengkap mungkin agar pengurus bisa menindaklanjuti laporan Anda dengan cepat.</p>

    <!-- Form Laravel -->
    <form id="form-aduan" action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="card-soft">
        <div class="card-soft-header">
          <div class="card-soft-title">Informasi Utama</div>
          <span class="badge-soft">Foto bukti wajib diunggah</span>
        </div>

        <!-- Judul -->
        <div class="mb-3">
          <label class="form-label">Judul Laporan</label>
          <input type="text" name="judul_laporan" class="form-control" placeholder="Contoh: Sampah menumpuk di selokan" required>
          @error('judul_laporan') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Kategori -->
        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select name="kategori" class="form-select" required>
            <option value="" disabled selected>Pilih kategori laporan</option>
            <option value="Sampah">Sampah & Kebersihan</option>
            <option value="Keamanan">Keamanan</option>
            <option value="Fasilitas">Fasilitas</option>
            <option value="Sosial">Sosial & Tetangga</option>
            <option value="Darurat">Lainnya</option>
          </select>
          @error('kategori') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Lokasi -->
        <div class="mb-3">
          <label class="form-label">Lokasi Kejadian</label>
          <input type="text" name="lokasi_kejadian" class="form-control" placeholder="Contoh: Depan Blok A3 No. 10" required>
          @error('lokasi_kejadian') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
          <label class="form-label">Deskripsi Lengkap</label>
          <textarea name="deskripsi" class="form-control" placeholder="Ceritakan detail masalahnya di sini..." required></textarea>
          @error('deskripsi') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Upload Foto (Desain Drag & Drop Temanmu) -->
        <div class="mb-1">
          <label class="form-label d-block">Foto Bukti (Wajib)</label>

          <label class="upload-area" for="foto">
            <input type="file" id="foto" name="foto_bukti" accept="image/png, image/jpeg" required onchange="previewFile()">
            <div><strong>Klik untuk upload</strong> atau drag and drop</div>
            <div class="upload-sub">PNG, JPG atau JPEG (maks. 5MB)</div>
          </label>
          
          <!-- Teks Preview Nama File -->
          <div id="file-name-display" class="file-preview"></div>
          
          @error('foto_bukti') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="btn-row">
          <a href="{{ route('pengaduan.index') }}" class="btn-secondary-pill">Batal</a>
          <button type="submit" class="btn-primary-pill">
            <span>🚀</span> Kirim Laporan
          </button>
        </div>
      </div>
    </form>
  </section>

  <footer>
    <div style="display:flex; align-items:center; gap:6px;">
      <img src="{{ asset('images/logo-rumah-aduan.png') }}" alt="Logo" onerror="this.style.display='none'">
      <span>RumahAduan — Solusi Cepat untuk Masalah Warga</span>
    </div>
    <span>&copy; 2025 Komplek Bougenville</span>
  </footer>
</div>

<!-- SCRIPT SEDERHANA: Preview Nama File -->
<script>
  function previewFile() {
    const input = document.getElementById('foto');
    const display = document.getElementById('file-name-display');
    
    if (input.files && input.files[0]) {
      display.textContent = "📄 File terpilih: " + input.files[0].name;
      display.style.color = "#4f46e5"; // Warna ungu tema
    } else {
      display.textContent = "";
    }
  }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>