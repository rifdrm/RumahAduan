<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterWarga extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Semua kolom boleh diisi kecuali ID

    // Satu data master warga (rumah) bisa punya 1 akun user (setelah verifikasi)
    public function user()
    {
        return $this->hasOne(User::class);
    }
}