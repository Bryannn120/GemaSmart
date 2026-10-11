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
        Schema::create('penyalurans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_bast')->unique();
            $table->date('tgl_kirim');
            $table->foreignId('wilayah_id')->constrained('wilayahs')->onDelete('cascade');
            $table->foreignId('jenis_bibit_id')->constrained('jenis_bibits')->onDelete('cascade');
            $table->integer('kuantitas');
            $table->enum('status', ['disiapkan', 'dikirim', 'diterima'])->default('disiapkan');
            $table->string('dokumen_bast_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyalurans');
    }
};
