<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Pak RT',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Password login
            'role' => 'admin',           // <--- PENTING: Role admin
            'status_akun' => 'active',   // Langsung aktif
            'no_hp' => '081299999999',
        ]);

        User::create([
            'name' => 'Admin 1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin123'), // Password login
            'role' => 'admin',           // <--- PENTING: Role admin
            'status_akun' => 'active',   // Langsung aktif
            'no_hp' => '081299999999',
        ]);

        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('admin123'), // Password login
            'role' => 'admin',           // <--- PENTING: Role admin
            'status_akun' => 'active',   // Langsung aktif
            'no_hp' => '081299999999',
        ]);
    }
}