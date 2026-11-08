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
        // 1. Tambah kolom tolak ukur pendapatan & pengeluaran ke tabel penilaian_kemandirians
        Schema::table('penilaian_kemandirians', function (Blueprint $table) {
            $table->string('tipe_periode', 20)->default('per_bulan')->after('periode'); // 'per_bulan' atau 'per_hari'
            $table->decimal('pendapatan', 15, 2)->default(0)->after('tipe_periode'); // nilai input asli
            $table->decimal('pengeluaran', 15, 2)->default(0)->after('pendapatan'); // nilai input asli
            $table->decimal('pendapatan_perbulan', 15, 2)->default(0)->after('pengeluaran'); // ekuivalen bulanan
            $table->decimal('pengeluaran_perbulan', 15, 2)->default(0)->after('pendapatan_perbulan'); // ekuivalen bulanan
            $table->decimal('penghasilan_bersih', 15, 2)->default(0)->after('pengeluaran_perbulan'); // surplus / defisit bulanan
        });

        // 2. Tambah kolom tolak ukur pendapatan & pengeluaran ke tabel keluarga_penerimas
        Schema::table('keluarga_penerimas', function (Blueprint $table) {
            $table->string('tipe_periode', 20)->default('per_bulan')->after('penghasilan_perbulan');
            $table->decimal('pendapatan', 15, 2)->default(0)->after('tipe_periode');
            $table->decimal('pengeluaran', 15, 2)->default(0)->after('pendapatan');
            $table->decimal('pendapatan_perbulan', 15, 2)->default(0)->after('pengeluaran');
            $table->decimal('pengeluaran_perbulan', 15, 2)->default(0)->after('pendapatan_perbulan');
            $table->decimal('penghasilan_bersih', 15, 2)->default(0)->after('pengeluaran_perbulan');
        });

        // 3. Tambah status dibaca untuk Kampus dan Pendamping pada laporan_penerimas
        Schema::table('laporan_penerimas', function (Blueprint $table) {
            $table->boolean('is_read_by_kampus')->default(false)->after('is_read_by_pemda');
            $table->boolean('is_read_by_pendamping')->default(false)->after('is_read_by_kampus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian_kemandirians', function (Blueprint $table) {
            $table->dropColumn([
                'tipe_periode',
                'pendapatan',
                'pengeluaran',
                'pendapatan_perbulan',
                'pengeluaran_perbulan',
                'penghasilan_bersih',
            ]);
        });

        Schema::table('keluarga_penerimas', function (Blueprint $table) {
            $table->dropColumn([
                'tipe_periode',
                'pendapatan',
                'pengeluaran',
                'pendapatan_perbulan',
                'pengeluaran_perbulan',
                'penghasilan_bersih',
            ]);
        });

        Schema::table('laporan_penerimas', function (Blueprint $table) {
            $table->dropColumn([
                'is_read_by_kampus',
                'is_read_by_pendamping',
            ]);
        });
    }
};
