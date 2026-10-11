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
        Schema::create('spjs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kampus_id')->constrained('kampus_mitras')->onDelete('cascade');
            $table->string('nomor_spj')->unique();
            $table->date('tgl_pengajuan');
            $table->text('uraian');
            $table->bigInteger('nominal');
            $table->enum('status', ['diajukan', 'review', 'disetujui', 'ditolak'])->default('diajukan');
            $table->string('dokumen_spj_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spjs');
    }
};
