<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pengaduan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Form Start -->
                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Judul Laporan -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Judul Laporan</label>
                            <input type="text" name="judul_laporan" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                   placeholder="Contoh: Sampah menumpuk di selokan" required>
                        </div>

                        <!-- Kategori & Lokasi (Grid 2 Kolom) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                                <select name="kategori" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="Sampah">Sampah & Kebersihan</option>
                                    <option value="Keamanan">Keamanan (Maling/Satpam)</option>
                                    <option value="Fasilitas">Fasilitas Umum Rusak</option>
                                    <option value="Sosial">Sosial & Tetangga</option>
                                    <option value="Darurat">Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Lokasi Kejadian</label>
                                <input type="text" name="lokasi_kejadian" 
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                       placeholder="Contoh: Depan Blok A3 No. 10" required>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Deskripsi Lengkap</label>
                            <textarea name="deskripsi" rows="4" 
                                      class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                      placeholder="Ceritakan detail masalahnya di sini..." required></textarea>
                        </div>

                        <!-- Upload Foto -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2">Foto Bukti (Wajib)</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                        <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 5MB)</p>
                                    </div>
                                    <input id="dropzone-file" type="file" name="foto_bukti" class="hidden" accept="image/*" required />
                                </label>
                            </div>
                        </div>

                        <!-- TOMBOL KIRIM (Saya perbesar & beri warna kontras) -->
                        <div class="flex justify-end">
                            <a href="{{ route('pengaduan.index') }}" class="bg-gray-500 text-white font-bold py-2 px-4 rounded mr-2 hover:bg-gray-600">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded shadow-lg hover:bg-blue-700 transition duration-300">
                                🚀 Kirim Laporan
                            </button>
                        </div>

                    </form>
                    <!-- Form End -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>