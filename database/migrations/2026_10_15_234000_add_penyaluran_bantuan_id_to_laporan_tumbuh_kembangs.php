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
        Schema::table('laporan_tumbuh_kembangs', function (Blueprint $table) {
            $table->foreignId('penyaluran_bantuan_id')
                ->nullable()
                ->after('keluarga_penerima_id')
                ->constrained('penyaluran_bantuans')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_tumbuh_kembangs', function (Blueprint $table) {
            $table->dropForeign(['penyaluran_bantuan_id']);
            $table->dropColumn('penyaluran_bantuan_id');
        });
    }
};
