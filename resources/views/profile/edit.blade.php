<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Keluarga RumahAduan</title>
  <!-- Viewport Mobile (Wajib) -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* CSS TEMANMU (PERSIS - BASE) */
    :root { --purple: #6d28d9; --purple-dark: #4c1d95; --bg-soft: #f5f3ff; --text-main: #111827; --text-muted: #6b7280; --radius-lg: 28px; }
    body { background: radial-gradient(circle at top left, #ede9fe 0, transparent 55%), #f9fafb; min-height: 100vh; padding: 20px; font-family: system-ui, sans-serif; color: var(--text-main); }
    .app-shell { max-width: 1100px; margin: 0 auto; background: rgba(255,255,255,0.9); border-radius: var(--radius-lg); padding: 30px; box-shadow: 0 24px 60px rgba(15,23,42,0.12); backdrop-filter: blur(18px); }
    
    .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .logo-top { height: 40px; }
    
    .section-label { font-size: 0.8rem; letter-spacing: 2px; color: #4338ca; font-weight: bold; margin-bottom: 5px; }
    .section-title { font-size: 1.2rem; font-weight: 700; margin-bottom: 5px; }
    .section-desc { font-size: 0.9rem; color: #6b7280; margin-bottom: 20px; }

    .card-soft { background: white; border-radius: 22px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; margin-bottom: 30px; }
    .card-soft-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .card-soft-title { font-weight: 700; color: var(--purple-dark); }
    .badge-soft { background: #f3e8ff; color: #6b21a8; padding: 5px 12px; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }

    .form-control, .form-select { border-radius: 99px; padding: 10px 20px; border-color: #e5e7eb; background: #f9fafb; font-size: 0.9rem; }
    .form-control:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }
    .form-control[readonly] { background-color: #e9ecef; color: #6c757d; cursor: not-allowed; } /* Style Readonly */
    textarea.form-control { border-radius: 20px; }

    .btn-pill-main { background: linear-gradient(135deg, #6366f1, #4f46e5); color: white; border: none; padding: 10px 25px; border-radius: 99px; font-weight: 600; box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3); transition: 0.2s; }
    .btn-pill-main:hover { transform: translateY(-2px); box-shadow: 0 15px 30px rgba(79, 70, 229, 0.4); }
    
    .btn-outline-soft { border: 1px dashed #6366f1; color: #6366f1; background: #eef2ff; padding: 8px 20px; border-radius: 99px; font-weight: 600; transition: 0.2s; }
    .btn-outline-soft:hover { background: #e0e7ff; border-style: solid; }

    /* CARD ANGGOTA KELUARGA */
    .penghuni-card { background: linear-gradient(135deg, #f5f3ff, #eff6ff); border: 1px solid #e0e7ff; border-radius: 20px; padding: 20px; margin-bottom: 15px; position: relative; }
    .penghuni-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 10px; }
    .penghuni-badge { background: #dbeafe; color: #1e40af; font-size: 0.7rem; padding: 3px 8px; border-radius: 6px; font-weight: bold; }
    
    .btn-remove { color: #dc2626; font-size: 0.8rem; background: none; border: none; font-weight: 600; cursor: pointer; }
    .btn-remove:hover { text-decoration: underline; }

    footer { border-top: 1px solid #e5e7eb; padding-top: 20px; margin-top: 30px; display: flex; justify-content: space-between; color: #9ca3af; font-size: 0.85rem; }

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

      /* 3. Card & Form */
      .card-soft { padding: 20px 15px; border-radius: 18px; margin-bottom: 25px; }
      .card-soft-header { flex-direction: column; align-items: flex-start; gap: 8px; margin-bottom: 15px; }
      
      .form-control, .form-select { 
        font-size: 16px; /* Mencegah auto-zoom iOS */
        padding: 10px 15px; 
      }

      /* 4. Penghuni Card (Agar tidak terlalu rapat di HP) */
      .penghuni-card { padding: 15px; margin-bottom: 12px; }
      
      /* 5. Tombol Simpan Full Width */
      .btn-pill-main { width: 100%; margin-top: 10px; }

      /* 6. Footer */
      footer { flex-direction: column; gap: 10px; text-align: center; }
    }
    </style>

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}"></head>
<body>

<div class="app-shell">

  <!-- HEADER -->
  <header class="top-bar">
    <div>
      <div style="font-size: 0.8rem; letter-spacing: 2px; color: #6b7280;">PENGATURAN</div>
      <h2 style="font-weight: 800; color: #4c1d95; margin: 0;">Profil Keluarga</h2>
    </div>
    <img src="{{ asset('images/logo-rumah-aduan.png') }}" class="logo-top" alt="Logo" onerror="this.style.display='none'">
  </header>

  <div style="margin-bottom: 30px;">
    <a href="{{ route('dashboard') }}" style="color: #4f46e5; text-decoration:none; font-weight: 500;">&larr; Kembali ke Dashboard</a>
  </div>

  <!-- FORM UTAMA -->
  <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <!-- 1. DATA AKUN (USERNAME DIHAPUS, DIGANTI NAMA & EMAIL) -->
    <section>
      <div class="section-label">DATA AKUN</div>
      <div class="section-title">Info Login Pengguna</div>
      <p class="section-desc">Data ini digunakan untuk masuk ke aplikasi RumahAduan.</p>

      <div class="card-soft">
        <div class="card-soft-header">
          <div class="card-soft-title">Akun RumahAduan</div>
          <span class="badge-soft">Wajib Diisi</span>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-bold small">Nama Akun Keluarga</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold small">Email Login</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
          </div>
        </div>
      </div>
    </section>

    <!-- 2. DATA KELUARGA (READONLY) -->
    <section>
      <div class="section-label">DATA KELUARGA</div>
      <div class="section-title">Identitas Kartu Keluarga</div>
      <p class="section-desc">Data resmi dari Admin RT/RW. Hubungi admin jika ada kesalahan data.</p>

      <div class="card-soft">
        <div class="card-soft-header">
          <div class="card-soft-title">Detail Keluarga</div>
          <span class="badge-soft">🔒 Tidak dapat diedit</span>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-bold small">Nomor Kartu Keluarga</label>
            <!-- Mengambil data dari relasi MasterWarga -->
            <input type="text" class="form-control" value="{{ $user->masterWarga->no_kk ?? '-' }}" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold small">Alamat Rumah</label>
            <textarea class="form-control" readonly>Blok {{ $user->masterWarga->blok ?? '-' }} No. {{ $user->masterWarga->no_rumah ?? '-' }} - RT {{ $user->masterWarga->rt_rw ?? '-' }}</textarea>
          </div>
        </div>
      </div>
    </section>

    <!-- 3. ANGGOTA KELUARGA (FORM DINAMIS) -->
    <section>
      <div class="section-label">ANGGOTA KELUARGA</div>
      <div class="section-title">Penghuni di Kartu Keluarga</div>
      <p class="section-desc">Tambahkan seluruh anggota keluarga yang tinggal di alamat ini.</p>

      <div class="card-soft">
        <div class="card-soft-header">
          <div class="card-soft-title">Daftar Penghuni</div>
          <button type="button" id="btnTambahPenghuni" class="btn-outline-soft">+ Tambah Penghuni</button>
        </div>

        <!-- CONTAINER INPUT -->
        <div id="anggota-list">
            
            <!-- LOOPING DATA LAMA DARI DATABASE -->
            @foreach($anggotaKeluarga as $index => $anggota)
            <div class="penghuni-card" data-index="{{ $index }}">
                <input type="hidden" name="anggota[{{ $index }}][id]" value="{{ $anggota->id }}"> <!-- ID untuk Update -->
                
                <div class="penghuni-head">
                    <div class="fw-bold text-primary">Penghuni #{{ $index + 1 }}</div>
                    <!-- Tombol hapus hanya visual (backend logic belum dibuat untuk delete) -->
                    <span class="penghuni-badge">Terdaftar</span>
                </div>

                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label small">Nama Lengkap</label>
                        <input type="text" name="anggota[{{ $index }}][nama]" class="form-control" value="{{ $anggota->nama_lengkap }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Status Hubungan</label>
                        <select name="anggota[{{ $index }}][status]" class="form-select">
                            <option value="Kepala Keluarga" {{ $anggota->status_hubungan == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                            <option value="Istri" {{ $anggota->status_hubungan == 'Istri' ? 'selected' : '' }}>Istri</option>
                            <option value="Anak" {{ $anggota->status_hubungan == 'Anak' ? 'selected' : '' }}>Anak</option>
                            <option value="Famili Lain" {{ $anggota->status_hubungan == 'Famili Lain' ? 'selected' : '' }}>Famili Lain</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Tanggal Lahir</label>
                        <input type="date" name="anggota[{{ $index }}][tgl_lahir]" class="form-control" value="{{ $anggota->tgl_lahir }}">
                    </div>
                </div>
            </div>
            @endforeach

        </div>
      </div>
    </section>

    <!-- TOMBOL SIMPAN -->
    <div class="d-flex justify-content-end mt-4">
        @if (session('status') === 'profile-updated')
            <p class="text-success me-3 mt-2 fw-bold">✅ Data berhasil disimpan.</p>
        @endif
        <button type="submit" class="btn-pill-main">Simpan Perubahan</button>
    </div>

  </form>

  <footer>
    <div style="display:flex; align-items:center; gap:8px;">
      <img src="{{ asset('images/logo-rumah-aduan.png') }}" height="24" alt="Logo" onerror="this.style.display='none'">
      <span>RumahAduan — Solusi Masalah Warga</span>
    </div>
    <span>&copy; 2025 Komplek Bougenville</span>
  </footer>

</div>

<!-- SCRIPT TAMBAH FORM DINAMIS -->
<script>
  const anggotaList = document.getElementById("anggota-list");
  const btnTambah = document.getElementById("btnTambahPenghuni");
  
  // Hitung index awal berdasarkan jumlah data yang sudah ada di PHP
  let penghuniIndex = {{ count($anggotaKeluarga) }}; 

  function buatKartuPenghuni(index) {
    const div = document.createElement("div");
    div.className = "penghuni-card";
    div.setAttribute("data-index", index);

    div.innerHTML = `
      <div class="penghuni-head">
        <div class="fw-bold text-success">Penghuni Baru</div>
        <button type="button" class="btn-remove" onclick="hapusElemen(this)">Hapus</button>
      </div>

      <div class="row g-2">
        <div class="col-md-6">
            <label class="form-label small">Nama Lengkap</label>
            <input type="text" name="anggota[${index}][nama]" class="form-control" placeholder="Nama sesuai KK" required>
        </div>
        <div class="col-md-3">
            <label class="form-label small">Status Hubungan</label>
            <select name="anggota[${index}][status]" class="form-select">
                <option value="Anak" selected>Anak</option>
                <option value="Istri">Istri</option>
                <option value="Famili Lain">Famili Lain</option>
                <option value="Kepala Keluarga">Kepala Keluarga</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label small">Tanggal Lahir</label>
            <input type="date" name="anggota[${index}][tgl_lahir]" class="form-control">
        </div>
      </div>
    `;
    return div;
  }

  btnTambah.addEventListener("click", () => {
    const card = buatKartuPenghuni(penghuniIndex);
    anggotaList.appendChild(card);
    penghuniIndex++;
  });

  // Fungsi hapus elemen DOM
  window.hapusElemen = function(btn) {
    btn.closest('.penghuni-card').remove();
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>