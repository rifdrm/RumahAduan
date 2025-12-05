<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Master Warga - RumahAduan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root { --radius-lg: 16px; --text-main: #111827; }
    body { font-family: system-ui, -apple-system, sans-serif; background: #f8fafc; padding: 28px; color: var(--text-main); }
    .card-soft { background: #fff; padding: 18px; border-radius: 14px; box-shadow: 0 10px 30px rgba(2,6,23,0.06); border: 1px solid #eef2ff; }
    .card-title { font-weight: 700; color: #1e3a8a; display: flex; gap: 10px; align-items: center; }
    .table-admin { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
    .table-admin th { text-align: left; padding: 10px; background: #f8fafc; color: #64748b; font-weight: 700; font-size: 0.75rem; }
    .table-admin td { padding: 10px; border-bottom: 1px solid #f1f5f9; }
    .btn-primary, .btn-success { border-radius: 8px; }
    .muted { color: #9ca3af; }
    .form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap: 10px; }
  </style>

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

</head>
<body>
<div style="max-width:1100px;margin:0 auto;">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
    <div class="card-title">👥 Manajemen Master Warga</div>
    <div style="display:flex;gap:10px;align-items:center;">
      <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Kembali</a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="card-soft" style="margin-bottom:18px;">
    <div style="display:grid;grid-template-columns:1fr 360px;gap:18px;align-items:start;">
      <div>
        <div style="font-weight:700;margin-bottom:8px;">Tambah Manual</div>
        <form action="{{ route('admin.warga.store') }}" method="POST">
          @csrf
          <div class="form-row">
            <input type="text" name="nama_kepala_keluarga" placeholder="Nama Kepala Keluarga" class="form-control" required>
            <input type="text" name="no_kk" placeholder="No. KK" class="form-control" required>
            <input type="text" name="blok" placeholder="Blok" class="form-control" required>
            <input type="text" name="no_rumah" placeholder="No. Rumah" class="form-control" required>
            <input type="text" name="rt_rw" placeholder="RT/RW (opsional)" class="form-control">
            <select name="status_rumah" class="form-control">
              <option value="Dihuni">Dihuni</option>
              <option value="Kosong">Kosong</option>
            </select>
          </div>
          <div style="margin-top:10px; text-align:right;">
            <button class="btn btn-primary">Simpan Manual</button>
          </div>
        </form>
      </div>

      <div>
        <div style="font-weight:700;margin-bottom:8px;">Import CSV</div>
        <div style="font-size:0.9rem;color:#6b7280;margin-bottom:10px;">Format header CSV: <code>no_kk,nama_kepala_keluarga,blok,no_rumah,rt_rw,status_rumah</code></div>
        <form action="{{ route('admin.warga.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="csv_file" accept=".csv,text/csv" class="form-control mb-2" required>
          <div style="display:flex;gap:8px;">
            <button class="btn btn-success" type="submit">Import CSV</button>
            <a href="{{ asset('template_data_warga.csv') }}" class="btn btn-outline-secondary" download>Download Template</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="card-soft">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;gap:12px;">
      <div style="font-weight:700;">Daftar Master Warga (Total: {{ $masters->total() }})</div>
      <form method="GET" action="{{ route('admin.warga.index') }}" style="display:flex;gap:8px;align-items:center;">
        <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari No KK / Nama / Blok" class="form-control" style="width:260px; padding:6px 10px;">
        <button class="btn btn-outline-primary btn-sm">Cari</button>
      </form>
    </div>

    <div style="overflow:auto;">
      <table class="table-admin" style="width:100%;">
        <thead>
          <tr>
            <th>No KK</th>
            <th>Nama Kepala Keluarga</th>
            <th>Alamat</th>
            <th>Status</th>
            <th style="width:120px;text-align:center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($masters as $m)
          <tr>
            <td style="font-family:monospace;font-weight:600;color:#1e3a8a;">{{ $m->no_kk }}</td>
            <td style="font-weight:600;">{{ $m->nama_kepala_keluarga }}</td>
            <td>{{ 'Blok ' . $m->blok . ' No. ' . $m->no_rumah . ( $m->rt_rw ? ' • RT/RW ' . $m->rt_rw : '') }}</td>
            <td>{{ $m->status_rumah }}</td>
            <td style="text-align:center;">
              <form action="{{ route('admin.warga.master.destroy', $m->id) }}" method="POST" onsubmit="return confirm('⚠️ Hapus master warga ini? Aksi tidak dapat dibatalkan.');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Hapus</button>
              </form>
            </td>
          </tr>
          @empty
          <tr><td colspan="4" class="muted">Belum ada data master warga.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div style="margin-top:12px; display:flex; justify-content:flex-end;">
      {{ $masters->links() }}
    </div>
  </div>

</div>
</body>
</html>
