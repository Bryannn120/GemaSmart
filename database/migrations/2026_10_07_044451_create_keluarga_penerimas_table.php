<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keluarga_penerimas', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk', 16)->unique();
            $table->string('kepala_keluarga');
            $table->string('nik', 16)->unique();
            $table->string('alamat')->nullable();
            $table->integer('desil')->default(1);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('wilayah_id')->constrained('wilayahs')->onDelete('cascade');
            $table->foreignId('program_bantuan_id')->constrained('program_bantuans')->onDelete('cascade');
            $table->enum('status_validasi', ['menunggu_validasi', 'proses_lapangan', 'valid', 'anomali'])->default('menunggu_validasi');
            $table->enum('status_kemandirian', ['Maju', 'Tetap', 'Mundur', 'Belum Dinilai'])->default('Belum Dinilai');
            $table->boolean('is_flagged')->default(false); // marked if not progressing
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keluarga_penerimas');
    }
};
