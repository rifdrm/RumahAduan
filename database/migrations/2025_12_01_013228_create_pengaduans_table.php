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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->string('pelapor_nama'); // Snapshot nama pelapor saat itu
            $table->string('judul_laporan');
            $table->text('deskripsi');
            $table->enum('kategori', ['Sampah', 'Keamanan', 'Fasilitas', 'Sosial', 'Darurat']);
            $table->string('foto_bukti')->nullable();
            $table->string('lokasi_kejadian');
            $table->enum('urgensi', ['Rendah', 'Sedang', 'Tinggi']);
            $table->enum('status', ['Terkirim', 'Diproses', 'Selesai', 'Ditolak'])->default('Terkirim');
            $table->text('tanggapan_admin')->nullable();
            
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
