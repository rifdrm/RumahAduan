<!DOCTYPE html>
<html>
<head>
	<title>Laporan Bulanan RumahAduan</title>
	<style>
        /* Gaya CSS Khusus Cetak */
		body { font-family: sans-serif; color: #333; }
		.container { width: 100%; margin: 0 auto; }
        
        /* KOP SURAT */
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        .header p { margin: 2px 0; font-size: 12px; color: #555; }

        /* TABEL */
		table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 11px; }
		table, th, td { border: 1px solid #333; }
		th { background-color: #f0f0f0; padding: 8px; text-align: left; }
		td { padding: 6px; }

        /* STATUS BADGE (Versi Teks) */
        .status { font-weight: bold; }
        
        /* TANDA TANGAN */
        .footer { margin-top: 40px; text-align: right; font-size: 12px; page-break-inside: avoid; }
        .ttd-box { display: inline-block; text-align: center; width: 200px; }
        .ttd-space { height: 60px; }
	</style>
</head>
<body>

	<div class="container">
        <!-- KOP SURAT -->
		<div class="header">
			<h1>Pengurus RT 05 / RW 02</h1>
            <h1>Komplek Bougenville</h1>
            <p>Jalan Melati No. 1, Kelurahan Suka Maju, Kecamatan Coding</p>
            <p>Telp: 0812-3456-7890 | Email: admin@rumahaduan.com</p>
		</div>

        <h3 style="text-align: center; margin-top: 20px;">LAPORAN PENGADUAN WARGA</h3>
        <p style="text-align: center; font-size: 12px;">Periode: 30 Hari Terakhir</p>

        <!-- TABEL DATA -->
		<table>
			<thead>
				<tr>
					<th width="5%">No</th>
					<th width="15%">Tanggal</th>
					<th width="15%">Pelapor</th>
					<th width="20%">Masalah</th>
					<th width="15%">Lokasi</th>
					<th width="10%">Status</th>
                    <th width="20%">Tanggapan</th>
				</tr>
			</thead>
			<tbody>
                @foreach($laporans as $index => $laporan)
				<tr>
					<td style="text-align: center;">{{ $index + 1 }}</td>
					<td>{{ $laporan->created_at->format('d/m/Y') }}</td>
					<td>{{ $laporan->user->name ?? 'Anonim' }}</td>
					<td>
                        <strong>{{ $laporan->judul_laporan }}</strong><br>
                        <span style="color: #666;">({{ $laporan->kategori }})</span>
                    </td>
                    <td>{{ $laporan->lokasi_kejadian }}</td>
					<td>
                        <span class="status">{{ strtoupper($laporan->status) }}</span>
                    </td>
                    <td>{{ $laporan->tanggapan_admin ?? '-' }}</td>
				</tr>
                @endforeach
			</tbody>
		</table>

        <!-- AREA TANDA TANGAN -->
        <div class="footer">
            <div class="ttd-box">
                <p>Jakarta, {{ date('d F Y') }}</p>
                <p>Mengetahui,<br>Ketua RT 05</p>
                <div class="ttd-space"></div>
                <p><strong>( Bpk. Admin RT )</strong></p>
            </div>
        </div>
	</div>

</body>
</html>