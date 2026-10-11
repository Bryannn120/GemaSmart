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
        Schema::create('validasi_cpcls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_penerima_id')->constrained('keluarga_penerimas')->onDelete('cascade');
            $table->foreignId('pendamping_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('validator_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('tgl_survei');
            $table->enum('status_kelayakan', ['layak', 'tidak_layak', 'review'])->default('review');
            $table->enum('status_approval_pemda', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->string('foto_lahan_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_cpcls');
    }
};
