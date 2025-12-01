<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterWargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data 1: Warga Asli (Nanti kita coba daftar pakai data ini)
        \App\Models\MasterWarga::create([
            'no_kk' => '3201010001000001',
            'nama_kepala_keluarga' => 'Budi Santoso',
            'blok' => 'A1',
            'no_rumah' => '10',
            'rt_rw' => '001/005',
            'status_rumah' => 'Dihuni',
        ]);

        // Data 2: Warga Lain
        \App\Models\MasterWarga::create([
            'no_kk' => '3201010001000002',
            'nama_kepala_keluarga' => 'Siti Aminah',
            'blok' => 'A1',
            'no_rumah' => '11',
            'rt_rw' => '001/005',
            'status_rumah' => 'Dihuni',
        ]);

        // Data 3: Rumah Kosong
        \App\Models\MasterWarga::create([
            'no_kk' => '3201010001000003',
            'nama_kepala_keluarga' => 'Agus (Pemilik Lama)',
            'blok' => 'B3',
            'no_rumah' => '05',
            'rt_rw' => '002/005',
            'status_rumah' => 'Kosong',
        ]);
    }
}
