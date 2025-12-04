<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Buat Akun Keluarga - RumahAduan</title>

  <!-- Bootstrap 5 -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
  
  <!-- Viewport untuk Mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <style>
    /* CSS DARI TEMANMU (BASE) */
    :root {
      --purple: #6d28d9;
      --purple-soft: #a855f7;
      --purple-dark: #4c1d95;
      --bg-soft: #f5f3ff;
      --text-main: #111827;
      --text-muted: #6b7280;
      --radius-lg: 28px;
      --radius-md: 18px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    body {
      min-height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 32px 12px 40px;
      background:
        radial-gradient(circle at top left, #ede9fe 0, transparent 55%),
        radial-gradient(circle at bottom right, #e0f2fe 0, transparent 55%),
        #f9fafb;
      color: var(--text-main);
    }

    .app-shell {
      width: 100%;
      max-width: 1180px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: var(--radius-lg);
      padding: 26px 30px 30px;
      box-shadow:
        0 24px 60px rgba(15, 23, 42, 0.12),
        0 0 0 1px rgba(148, 163, 184, 0.15);
      backdrop-filter: blur(18px);
    }

    /* HEADER */
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 18px;
    }

    .top-left {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .top-subtitle {
      font-size: 0.8rem;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--text-muted);
    }

    .top-title {
      font-size: 1.4rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--purple-dark);
    }

    .logo-top {
      height: 40px;
    }

    .breadcrumb-mini {
      font-size: 0.8rem;
      color: var(--text-muted);
      margin-bottom: 18px;
    }

    .breadcrumb-mini a {
      text-decoration: none;
      color: #4f46e5;
    }

    .breadcrumb-mini a:hover {
      text-decoration: underline;
    }

    .section-label {
      font-size: 0.8rem;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: #4338ca;
    }

    .section-title {
      font-size: 1.05rem;
      font-weight: 700;
      margin-bottom: 4px;
      color: #111827;
    }

    .section-desc {
      font-size: 0.85rem;
      color: var(--text-muted);
      margin-bottom: 14px;
    }

    .card-soft {
        border-radius: 24px;
        background: #ffffff;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(226, 232, 240, 0.9);
        padding: 20px 24px 18px;
        max-width: 100%;
        margin: 0;
    }

    .card-soft-header { margin-bottom: 14px; }
    .card-soft-title { font-size: 0.96rem; font-weight: 600; color: var(--purple-dark); }
    .card-soft-desc { font-size: 0.8rem; color: var(--text-muted); }

    .form-label { font-size: 0.8rem; font-weight: 500; color: #374151; }
    
    /* INPUT STYLE KHUSUS */
    .form-control, .form-select {
      border-radius: 999px; font-size: 0.86rem; padding: 10px 18px; border-color: #e5e7eb;
    }
    .form-control::placeholder { color: #9ca3af; }
    .form-control:focus, .form-select:focus { border-color: #6366f1; box-shadow: 0 0 0 2px rgba(129, 140, 248, 0.35); }
    input[type="file"].form-control { padding: 8px 10px; border-radius: 999px; background: white; }

    .helper-text { font-size: 0.72rem; color: var(--text-muted); }

    .btn-register {
        width: 100%; border-radius: 999px; padding: 12px 20px; font-size: 0.88rem; font-weight: 600;
        border: none; color: #ffffff; background: linear-gradient(135deg, #6366f1, #4f46e5);
        box-shadow: 0 12px 26px rgba(79, 70, 229, 0.40); transition: 0.2s; margin-top: 10px;
    }
    .btn-register:hover { background: linear-gradient(135deg, #4f46e5, #4338ca); transform: translateY(-2px); }

    .error-msg { color: #dc2626; font-size: 0.75rem; margin-top: 4px; margin-left: 5px; }

    footer {
      margin-top: 22px; padding-top: 10px; border-top: 1px solid #e5e7eb;
      font-size: 0.8rem; color: var(--text-muted); display: flex; justify-content: space-between; align-items: center;
    }
    footer img { height: 24px; }

    /* ========================================= */
    /* MODIFIKASI RESPONSIVE (LAYOUT MOBILE)     */
    /* ========================================= */
    @media (max-width: 576px) {
      /* Kurangi padding body agar layar tidak penuh sesak */
      body {
        padding: 15px 10px;
      }

      /* Card Utama (Shell) dibuat lebih lega untuk HP */
      .app-shell {
        padding: 20px 16px 24px;
        border-radius: 20px;
      }

      /* Judul Header disesuaikan ukurannya */
      .top-title {
        font-size: 1.25rem;
      }
      .logo-top {
        height: 35px;
      }

      /* Card Form dibuat paddingnya pas di jempol */
      .card-soft {
        padding: 18px 15px;
        border-radius: 18px;
      }

      /* FIX PENTING: Input Font 16px Mencegah Auto-Zoom di iPhone/iOS */
      .form-control, .form-select {
        font-size: 16px !important;
        padding: 10px 15px; /* Sedikit lebih besar untuk touch target */
      }

      /* Footer ditumpuk ke bawah (Stack) */
      footer {
        flex-direction: column;
        gap: 10px;
        text-align: center;
      }
    }
  </style>

<link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

</head>
<body>

<div class="app-shell">

  <!-- HEADER -->
  <header class="top-bar">
    <div class="top-left">
      <div class="top-subtitle">REGISTRASI</div>
      <div class="top-title">Buat Akun Keluarga</div>
    </div>
    <!-- Logo -->
    <img src="{{ asset('images/logo-rumah-aduan.png') }}" alt="RumahAduan" class="logo-top" onerror="this.style.display='none'">
  </header>

  <div class="breadcrumb-mini">
    Sudah punya akun?
    <a href="{{ route('login') }}">Masuk di sini</a>
  </div>

  <section>
    <div class="section-label">DATA AKUN</div>
    <div class="section-title">Informasi Keluarga & Kontak</div>
    <p class="section-desc">
      Isi formulir berikut sesuai dengan data yang tercatat di RT/RW. Nomor KK akan digunakan
      sebagai verifikasi dasar akun keluarga.
    </p>

    <div class="card-soft">
      <div class="card-soft-header">
        <div class="card-soft-title">Form Registrasi Akun Keluarga</div>
        <div class="card-soft-desc">
          Pastikan seluruh data terisi dan foto kartu keluarga terbaca dengan jelas.
        </div>
      </div>

      <!-- FORM LARAVEL -->
      <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- 1. Nama Akun -->
        <div class="mb-3">
          <label class="form-label">Nama Akun Keluarga</label>
          <input type="text" name="name" class="form-control" placeholder="Contoh: Keluarga Bpk. Budi" value="{{ old('name') }}" required>
          @error('name') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <!-- 2. Nomor KK -->
        <div class="mb-3">
          <label class="form-label">Nomor Kartu Keluarga (Sesuai Data RT)</label>
          <input type="text" name="no_kk" class="form-control" placeholder="Masukkan 16 digit No KK" value="{{ old('no_kk') }}" required>
          <div class="helper-text mt-1">*Akun hanya bisa dibuat jika No KK terdaftar di database Admin.</div>
          @error('no_kk') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <!-- 3. Nomor HP -->
        <div class="mb-3">
          <label class="form-label">Nomor HP / WhatsApp Aktif</label>
          <input type="tel" name="no_hp" class="form-control" placeholder="Contoh: 0812 3456 7890" value="{{ old('no_hp') }}" required>
          @error('no_hp') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <!-- 4. Email -->
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="contoh: keluarga.budi@mail.com" value="{{ old('email') }}" required>
          @error('email') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <!-- 5. Foto KK -->
        <div class="mb-3">
          <label class="form-label">Upload Foto Kartu Keluarga (Bukti)</label>
          <input type="file" name="foto_kk" class="form-control" accept="image/png, image/jpeg" required>
          <div class="helper-text mt-1">PNG, JPG, atau JPEG (maks. 5MB). Pastikan data pada KK terlihat jelas.</div>
          @error('foto_kk') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <!-- 6. Password -->
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
          @error('password') <div class="error-msg">{{ $message }}</div> @enderror
        </div>

        <!-- 7. Confirm Password -->
        <div class="mb-1">
          <label class="form-label">Confirm Password</label>
          <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password yang sama" required>
        </div>

        <div class="helper-text mb-2 mt-3 text-center">
          Dengan mendaftar, Anda menyetujui penggunaan data untuk layanan resmi RT/RW.
        </div>

        <button type="submit" class="btn-register">DAFTAR SEKARANG</button>
      </form>

    </div>
  </section>

  <footer>
    <div style="display:flex; align-items:center; gap:6px;">
      <!-- Logo Footer -->
      <img src="{{ asset('images/logo-rumah-aduan.png') }}" alt="RumahAduan" onerror="this.style.display='none'">
      <span>RumahAduan — Solusi Cepat untuk Masalah Warga</span>
    </div>
    <span>&copy; 2025 Komplek Bougenville</span>
  </footer>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>