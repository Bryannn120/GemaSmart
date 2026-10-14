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
        Schema::table('penilaian_kemandirians', function (Blueprint $table) {
            $table->decimal('penghasilan_perbulan', 15, 2)->default(0)->after('periode');
            $table->integer('jumlah_anak')->default(0)->after('penghasilan_perbulan');
            $table->string('aset_rumah', 50)->nullable()->after('jumlah_anak');
            $table->string('aset_tanah', 50)->nullable()->after('aset_rumah');
            $table->string('aset_kendaraan', 50)->nullable()->after('aset_tanah');
            $table->decimal('pendapatan_per_kapita', 15, 2)->default(0)->after('aset_kendaraan');
            $table->integer('desil_sebelumnya')->nullable()->after('pendapatan_per_kapita');
            $table->integer('desil_hasil')->default(1)->after('desil_sebelumnya');
            $table->text('catatan')->nullable()->after('total_skor');
        });

        Schema::table('keluarga_penerimas', function (Blueprint $table) {
            $table->decimal('penghasilan_perbulan', 15, 2)->default(0)->after('desil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian_kemandirians', function (Blueprint $table) {
            $table->dropColumn([
                'penghasilan_perbulan',
                'jumlah_anak',
                'aset_rumah',
                'aset_tanah',
                'aset_kendaraan',
                'pendapatan_per_kapita',
                'desil_sebelumnya',
                'desil_hasil',
                'catatan',
            ]);
        });

        Schema::table('keluarga_penerimas', function (Blueprint $table) {
            $table->dropColumn('penghasilan_perbulan');
        });
    }
};
