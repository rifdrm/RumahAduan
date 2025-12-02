<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin (Pak RT)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- BAGIAN 1: TABEL VERIFIKASI WARGA -->
            <!-- BAGIAN 1: TABEL VERIFIKASI WARGA -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-yellow-600">⏳ Menunggu Verifikasi ({{ $pendingUsers->count() }})</h3>
                
                @if($pendingUsers->isEmpty())
                    <p class="text-gray-500">Tidak ada pendaftaran baru.</p>
                @else
                    <table class="w-full border-collapse border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-2">Nama Akun</th>
                                <th class="border p-2">No KK (Input)</th>
                                <th class="border p-2">Foto Bukti</th>
                                <th class="border p-2" style="min-width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingUsers as $user)
                            <tr class="text-center">
                                <td class="border p-2">{{ $user->name }}</td>
                                <td class="border p-2">{{ $user->masterWarga->no_kk ?? $user->no_kk ?? '-' }}</td>
                                <td class="border p-2">
                                    @if($user->foto_kk)
                                        <a href="{{ asset('storage/'.$user->foto_kk) }}" target="_blank" class="text-blue-500 underline">Lihat Foto</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <!-- KOLOM AKSI (DIPERBAIKI) -->
                                <td class="border p-2">
                                    <div class="flex justify-center items-center gap-2">
                                        
                                        <!-- Tombol Setuju (Warna Hijau Paksa) -->
                                        <form action="{{ route('admin.verifikasi', $user->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit" 
                                                    style="background-color: #22c55e; color: white; padding: 5px 10px; border-radius: 5px;">
                                                ✅ Terima
                                            </button>
                                        </form>

                                        <!-- Tombol Tolak (Warna Merah Paksa) -->
                                        <form action="{{ route('admin.verifikasi', $user->id) }}" method="POST" class="flex items-center gap-1">
                                            @csrf
                                            <input type="hidden" name="action" value="reject">
                                            <input type="text" name="alasan" placeholder="Alasan..." 
                                                class="border text-xs p-1 rounded" 
                                                style="width: 80px;" required>
                                            <button type="submit" 
                                                    style="background-color: #ef4444; color: white; padding: 5px 10px; border-radius: 5px;">
                                                ❌ Tolak
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- BAGIAN 2: TABEL LAPORAN WARGA -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-blue-600">📢 Daftar Laporan Masuk</h3>

                <table class="w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Tgl</th>
                            <th class="border p-2">Pelapor</th>
                            <th class="border p-2">Judul & Lokasi</th>
                            <th class="border p-2">Foto</th>
                            <th class="border p-2">Status & Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporans as $laporan)
                        <tr>
                            <td class="border p-2 text-sm">{{ $laporan->created_at->format('d/m/Y') }}</td>
                            <td class="border p-2">{{ $laporan->user->name ?? 'Anonim' }}</td>
                            <td class="border p-2">
                                <strong>{{ $laporan->judul_laporan }}</strong><br>
                                <span class="text-xs text-gray-500">{{ $laporan->lokasi_kejadian }}</span>
                            </td>
                            <td class="border p-2 text-center">
                                <a href="{{ asset('storage/'.$laporan->foto_bukti) }}" target="_blank" class="text-blue-500 underline text-sm">Lihat</a>
                            </td>
                            <td class="border p-2">
                                <!-- Form Update Status -->
                                <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST" class="flex flex-col gap-2">
                                    @csrf
                                    @method('PATCH')

                                    <select name="status" class="border rounded text-sm p-1">
                                        <option value="Terkirim" {{ $laporan->status == 'Terkirim' ? 'selected' : '' }}>🔵 Terkirim</option>
                                        <option value="Diproses" {{ $laporan->status == 'Diproses' ? 'selected' : '' }}>🟡 Diproses</option>
                                        <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                                        <option value="Ditolak" {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>🔴 Tolak</option>
                                    </select>

                                    <input type="text" name="tanggapan" value="{{ $laporan->tanggapan_admin }}" placeholder="Tulis balasan..." class="border text-xs p-1 rounded">

                                    <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700">Update</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>