<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login RumahAduan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* CSS DARI TEMANMU (PERSIS) */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    html, body {
      height: 100%;
    }

    /* BACKGROUND FOTO KOMPLEK */
    body {
      /* Pastikan gambar ada di public/images/komplek-bougenville.png */
      background: url("{{ asset('images/komplek-bougenville.png') }}") center/cover no-repeat;
      position: relative;
      overflow-x: hidden;
    }

    /* OVERLAY GELAP FULL SCREEN */
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 30, 0.45);
      backdrop-filter: brightness(0.7);
      z-index: 0;
    }

    /* CONTAINER UTAMA */
    .center-box {
      position: relative;
      z-index: 5;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 30px;
      text-align: center;
      color: #fff;
    }

    .hero-logo {
      width: 140px;
      margin-bottom: 20px;
      filter: drop-shadow(0 4px 12px rgba(0,0,0,0.5));
    }

    .hero-title {
      font-size: 2.8rem;
      font-weight: 800;
      line-height: 1.2;
      max-width: 900px;
      text-shadow: 0 8px 30px rgba(0,0,0,0.55);
      color: #ffffff;
    }

    .hero-subtitle {
      margin-top: 10px;
      font-size: 1.2rem;
      opacity: 0.9;
      font-weight: 400;
      max-width: 800px;
      text-shadow: 0 8px 30px rgba(0,0,0,0.5);
      color: #ffffff;
    }

    /* LOGIN CARD STYLE PREMIUM */
    .login-card {
      margin-top: 30px;
      background: white;
      color: #111827;
      width: 100%;
      max-width: 480px;
      padding: 30px 32px 35px;
      border-radius: 26px;
      box-shadow: 0 26px 70px rgba(15,23,42,0.45);
      position: relative;
    }

    .login-title {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 22px;
      text-align: left; /* Sesuaikan dengan desain temanmu */
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .form-label {
      display: block;
      font-size: 0.9rem;
      margin-bottom: 6px;
      color: #374151;
      font-weight: 500;
    }

    .form-input {
      width: 100%;
      height: 50px;
      border-radius: 12px;
      border: 1px solid #d1d5db;
      padding: 0 15px;
      font-size: 0.98rem;
      outline: none;
      transition: 0.2s ease;
      background: white;
    }

    .form-input:focus {
      border-color: #6366f1;
      box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.35);
    }

    .btn-login {
      width: 100%;
      margin-top: 10px;
      padding: 13px;
      border-radius: 999px;
      border: none;
      background: linear-gradient(135deg, #6366f1, #4f46e5);
      color: white;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: 0.2s ease;
      box-shadow: 0 12px 26px rgba(79, 70, 229, 0.40);
    }

    .btn-login:hover {
      background: linear-gradient(135deg, #4f46e5, #4338ca);
      transform: translateY(-1px);
      box-shadow: 0 14px 40px rgba(79, 70, 229, 0.55);
    }

    .login-footer-text {
      margin-top: 18px;
      font-size: 0.9rem;
      color: #6b7280;
      text-align: center;
    }

    .login-footer-text a {
      color: #4f46e5;
      font-weight: 600;
      text-decoration: none;
    }

    .login-footer-text a:hover {
      text-decoration: underline;
    }

    /* Tambahan untuk pesan error Laravel */
    .text-danger {
      font-size: 0.8rem;
      color: #dc2626;
      margin-top: 5px;
    }

    @media (max-width: 768px) {
      .hero-title { font-size: 2rem; }
      .hero-subtitle { font-size: 1rem; }
      .hero-logo { width: 110px; }
      .login-card { padding: 22px; }
    }
  </style>
</head>

<body>

  <div class="center-box">

    <!-- LOGO -->
    <!-- Pastikan file logo ada di public/images/ -->
    <img src="{{ asset('images/logo-rumah-aduan.png') }}" class="hero-logo" alt="RumahAduan" onerror="this.style.display='none'">

    <!-- JUDUL -->
    <h1 class="hero-title">Selamat Datang di RumahAduan</h1>
    <p class="hero-subtitle">Platform Pengaduan Warga Komplek Bougenville</p>

    <!-- LOGIN CARD -->
    <div class="login-card">
      <h2 class="login-title">Masuk ke Dashboard Keluarga</h2>

      <!-- FORM LARAVEL (MODIFIKASI DI SINI) -->
      <form action="{{ route('login') }}" method="POST">
        @csrf

        <!-- Input Email -->
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-input" placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
          <!-- Pesan Error Email -->
          @error('email')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- Input Password -->
        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-input" placeholder="Masukkan password" required>
          <!-- Pesan Error Password -->
          @error('password')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn-login">Log In</button>

      </form>

      <p class="login-footer-text">
        Klik <a href="{{ route('register') }}">daftar</a> apabila belum memiliki akun.
      </p>
    </div>

  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>