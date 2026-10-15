<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laporan_tumbuh_kembangs', function (Blueprint $table) {
            $table->foreignId('program_bantuan_id')
                ->nullable()
                ->after('keluarga_penerima_id')
                ->constrained('program_bantuans')
                ->nullOnDelete();
        });

        // Backfill data program_bantuan_id dari penyaluran_bantuans atau keluarga_penerimas
        $reports = DB::table('laporan_tumbuh_kembangs')->get();
        foreach ($reports as $r) {
            $programId = null;

            if (!empty($r->penyaluran_bantuan_id)) {
                $pen = DB::table('penyaluran_bantuans')->where('id', $r->penyaluran_bantuan_id)->first();
                if ($pen && !empty($pen->program_bantuan_id)) {
                    $programId = $pen->program_bantuan_id;
                }
            }

            if (!$programId && !empty($r->keluarga_penerima_id)) {
                $kel = DB::table('keluarga_penerimas')->where('id', $r->keluarga_penerima_id)->first();
                if ($kel && !empty($kel->program_bantuan_id)) {
                    $programId = $kel->program_bantuan_id;
                }
            }

            if (!$programId) {
                $firstProg = DB::table('program_bantuans')->first();
                $programId = $firstProg ? $firstProg->id : null;
            }

            if ($programId) {
                DB::table('laporan_tumbuh_kembangs')->where('id', $r->id)->update([
                    'program_bantuan_id' => $programId
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_tumbuh_kembangs', function (Blueprint $table) {
            $table->dropForeign(['program_bantuan_id']);
            $table->dropColumn('program_bantuan_id');
        });
    }
};
