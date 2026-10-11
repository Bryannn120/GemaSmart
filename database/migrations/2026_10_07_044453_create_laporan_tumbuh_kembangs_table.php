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
        Schema::create('laporan_tumbuh_kembangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_penerima_id')->constrained('keluarga_penerimas')->onDelete('cascade');
            $table->foreignId('pendamping_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_lapor');
            $table->enum('status_kondisi', ['normal', 'hama', 'gagal'])->default('normal');
            $table->text('catatan');
            $table->string('foto_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_tumbuh_kembangs');
    }
};
