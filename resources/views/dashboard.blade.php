<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Kartu Selamat Datang -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="mt-2 text-gray-600">Selamat datang di RumahAduan Bougelville.</p>
                </div>
            </div>

            <!-- Menu Cepat (Grid) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Kartu 1: Buat Laporan -->
                <a href="{{ route('pengaduan.create') }}" class="block p-6 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition shadow-sm">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-900">📢 Buat Pengaduan</h5>
                    <p class="font-normal text-blue-700">Ada masalah di lingkungan sekitar? Laporkan segera di sini.</p>
                </a>

                <!-- Kartu 2: Riwayat Laporan -->
                <a href="{{ route('pengaduan.index') }}" class="block p-6 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition shadow-sm">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-green-900">📜 Riwayat Pengaduan</h5>
                    <p class="font-normal text-green-700">Pantau status laporan yang sudah Anda kirimkan sebelumnya.</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
