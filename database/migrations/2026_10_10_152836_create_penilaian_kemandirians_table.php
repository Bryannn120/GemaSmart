<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian_kemandirians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_penerima_id')->constrained('keluarga_penerimas')->onDelete('cascade');
            $table->foreignId('pendamping_id')->constrained('users')->onDelete('cascade');
            $table->string('periode'); // e.g. "Q1 2026" or "Bulan 10 2026"
            $table->integer('total_skor')->default(0);
            $table->enum('status_perkembangan', ['Maju', 'Tetap', 'Mundur']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian_kemandirians');
    }
};
