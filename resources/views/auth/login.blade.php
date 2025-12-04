<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login RumahAduan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* CSS TEMANMU (BASE) */
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
    html, body { height: 100%; }

    /* BACKGROUND */
    body {
      background: url("{{ asset('images/komplek-bougenville.png') }}") center/cover no-repeat;
      position: relative; overflow-x: hidden;
    }
    /* Overlay Gelap */
    body::before {
      content: ""; position: fixed; inset: 0; background: rgba(0, 0, 30, 0.55); /* Sedikit digelapkan agar teks lebih kontras di HP */
      backdrop-filter: brightness(0.7); z-index: 0;
    }

    /* CONTAINER UTAMA */
    .center-box {
      position: relative; z-index: 5; min-height: 100vh;
      display: flex; flex-direction: column; align-items: center; justify-content: center;
      padding: 20px; /* Default padding */
      text-align: center; color: #fff;
    }

    .hero-logo { width: 140px; margin-bottom: 20px; filter: drop-shadow(0 4px 12px rgba(0,0,0,0.5)); }
    
    .hero-title {
      font-size: 2.8rem; font-weight: 800; line-height: 1.2; max-width: 900px;
      text-shadow: 0 8px 30px rgba(0,0,0,0.55); color: #ffffff;
    }
    
    .hero-subtitle {
      margin-top: 10px; font-size: 1.2rem; opacity: 0.9; font-weight: 400;
      max-width: 800px; text-shadow: 0 8px 30px rgba(0,0,0,0.5); color: #ffffff;
    }

    /* CARD LOGIN */
    .login-card {
      margin-top: 30px; background: white; color: #111827; width: 100%; max-width: 450px; /* Sedikit dirampingkan */
      padding: 30px 32px 35px; border-radius: 26px;
      box-shadow: 0 26px 70px rgba(15,23,42,0.45); position: relative;
    }

    .login-title { font-size: 1.2rem; font-weight: 700; margin-bottom: 22px; text-align: left; color: #1e1b4b; }
    
    .form-group { margin-bottom: 20px; text-align: left; }
    .form-label { display: block; font-size: 0.85rem; margin-bottom: 6px; color: #4b5563; font-weight: 600; }
    
    .form-input {
      width: 100%; height: 48px; border-radius: 12px; border: 1px solid #d1d5db;
      padding: 0 15px; font-size: 0.95rem; outline: none; transition: 0.2s ease; background: #f9fafb;
    }
    .form-input:focus { border-color: #6366f1; background: #fff; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }

    .btn-login {
      width: 100%; margin-top: 10px; padding: 12px; border-radius: 999px; border: none;
      background: linear-gradient(135deg, #6366f1, #4f46e5); color: white;
      font-size: 1rem; font-weight: 700; cursor: pointer; transition: 0.2s ease;
      box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
    }
    .btn-login:active { transform: scale(0.98); }

    .login-footer-text { margin-top: 20px; font-size: 0.9rem; color: #6b7280; text-align: center; }
    .login-footer-text a { color: #4f46e5; font-weight: 600; text-decoration: none; }
    
    .text-danger { font-size: 0.8rem; color: #dc2626; margin-top: 5px; }

    /* === OPTIMASI MOBILE (RESPONSIVE) === */
    @media (max-width: 576px) {
      .center-box {
        padding: 15px; /* Padding lebih tipis di HP */
        justify-content: center;
      }
      
      .hero-logo { width: 100px; margin-bottom: 15px; } /* Logo lebih kecil */
      
      .hero-title { 
        font-size: 1.8rem; /* Font judul tidak terlalu besar */
        margin-bottom: 5px;
      }
      
      .hero-subtitle { 
        font-size: 0.95rem; 
        line-height: 1.4;
        padding: 0 10px;
      }

      .login-card {
        margin-top: 25px;
        padding: 25px 20px; /* Card lebih lega isinya */
        border-radius: 20px;
      }

      .login-title { font-size: 1.1rem; margin-bottom: 18px; }
      
      .form-input { height: 45px; font-size: 16px; /* Mencegah zoom otomatis di iOS */ }
    }
  </style>

<link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

</head>

<body>

  <div class="center-box">
    <!-- Logo -->
    <img src="{{ asset('images/logo-rumah-aduan.png') }}" class="hero-logo" alt="RumahAduan" onerror="this.style.display='none'">

    <!-- Judul -->
    <h1 class="hero-title">Selamat Datang</h1>
    <p class="hero-subtitle">Platform Pengaduan Warga Komplek Bougenville</p>

    <!-- Card Login -->
    <div class="login-card">
      <h2 class="login-title">Masuk ke Dashboard</h2>

      <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-input" placeholder="contoh@email.com" value="{{ old('email') }}" required autofocus>
          @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-input" placeholder="••••••••" required>
          @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div style="text-align: right; margin-bottom: 15px;">
            <a href="{{ route('password.request') }}" style="font-size: 0.8rem; color: #6b7280; text-decoration: none;">
                Lupa Password?
            </a>
        </div>

        <button type="submit" class="btn-login">Masuk Sekarang</button>
      </form>

      <p class="login-footer-text">
        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>