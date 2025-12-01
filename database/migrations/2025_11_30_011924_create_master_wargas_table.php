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
        Schema::create('master_wargas', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk', 16)->unique(); // Kunci utama validasi
            $table->string('nama_kepala_keluarga');
            $table->string('blok', 5);      // Contoh: A12
            $table->string('no_rumah', 5);  // Contoh: 10B
            $table->string('rt_rw', 10);    // Contoh: 001/002
            $table->enum('status_rumah', ['Dihuni', 'Kosong'])->default('Dihuni');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_wargas');
    }
};
