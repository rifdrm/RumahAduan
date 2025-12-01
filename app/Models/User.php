<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    // Relasi ke Master Warga
    public function masterWarga()
    {
        return $this->belongsTo(MasterWarga::class);
    }

    // Satu Akun User punya BANYAK Anggota Keluarga
    public function anggotaKeluargas()
    {
        return $this->hasMany(AnggotaKeluarga::class);
    }

    // Satu Akun User punya BANYAK Pengaduan
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class);
    }
}
