<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggota_keluargas', function (Blueprint $table) {
            $table->id();
            // Hapus anggota jika user dihapus (cascade)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->string('nama_lengkap');
            $table->string('nik', 16)->unique();
            $table->enum('status_hubungan', ['Kepala Keluarga', 'Istri', 'Anak', 'Famili Lain']);
            $table->date('tgl_lahir')->nullable();
            $table->string('foto_profil')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_keluargas');
    }
};
