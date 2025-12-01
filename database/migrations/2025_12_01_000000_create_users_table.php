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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke Master Warga (Nullable dulu, diisi saat verifikasi)
            $table->foreignId('master_warga_id')->nullable()->constrained('master_wargas')->onDelete('set null');
            
            $table->string('name'); // Nama Akun Keluarga (misal: Keluarga Bpk Budi)
            $table->string('email')->unique();
            $table->string('password');
            
            // Data Tambahan
            $table->string('no_hp')->nullable();
            $table->string('foto_kk')->nullable(); // Path file foto
            $table->enum('role', ['admin', 'warga'])->default('warga');
            $table->enum('status_akun', ['pending', 'active', 'rejected'])->default('pending');
            $table->text('alasan_penolakan')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
