<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_penerimas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_penerima_id')->constrained('keluarga_penerimas')->onDelete('cascade');
            $table->text('laporan_teks');
            $table->string('foto')->nullable();
            $table->boolean('is_read_by_pemda')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_penerimas');
    }
};
