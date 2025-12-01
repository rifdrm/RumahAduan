<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pengaduan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tombol Tambah -->
            <a href="{{ route('pengaduan.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">
                + Buat Laporan Baru
            </a>

            <!-- Alert Sukses -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- List Pengaduan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($laporans->isEmpty())
                    <p class="text-center text-gray-500">Belum ada laporan.</p>
                @else
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="p-3 border">Tanggal</th>
                                <th class="p-3 border">Judul</th>
                                <th class="p-3 border">Kategori</th>
                                <th class="p-3 border">Status</th>
                                <th class="p-3 border">Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporans as $laporan)
                                <tr class="border-b">
                                    <td class="p-3">{{ $laporan->created_at->format('d M Y') }}</td>
                                    <td class="p-3 font-bold">{{ $laporan->judul_laporan }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 bg-gray-200 rounded text-xs">{{ $laporan->kategori }}</span>
                                    </td>
                                    <td class="p-3">
                                        <!-- Logika Warna Status Sederhana -->
                                        @php
                                            $warna = match($laporan->status) {
                                                'Terkirim' => 'text-yellow-600',
                                                'Diproses' => 'text-blue-600',
                                                'Selesai' => 'text-green-600',
                                                'Ditolak' => 'text-red-600',
                                            };
                                        @endphp
                                        <span class="font-bold {{ $warna }}">{{ $laporan->status }}</span>
                                    </td>
                                    <td class="p-3">
                                        <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" class="h-16 w-16 object-cover rounded" alt="Bukti">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>