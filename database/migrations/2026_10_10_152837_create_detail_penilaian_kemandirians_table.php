<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penilaian_kemandirians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penilaian_kemandirian_id')->constrained('penilaian_kemandirians')->onDelete('cascade');
            $table->foreignId('indikator_kemandirian_id')->constrained('indikator_kemandirians')->onDelete('cascade');
            $table->integer('nilai'); // e.g. 1-5 or 1-100
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penilaian_kemandirians');
    }
};
