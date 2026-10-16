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
        Schema::create('kampus_wilayahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kampus_mitra_id')->constrained('kampus_mitras')->onDelete('cascade');
            $table->foreignId('wilayah_id')->constrained('wilayahs')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['kampus_mitra_id', 'wilayah_id']);
        });

        // Sinkronisasi otomatis data eksisting wilayah_binaan kampus mitra jika ada
        try {
            $kampuses = DB::table('kampus_mitras')->whereNull('deleted_at')->get();
            foreach ($kampuses as $km) {
                if (!empty($km->wilayah_binaan)) {
                    $cleaned = str_replace(['Kec.', 'Kecamatan'], '', $km->wilayah_binaan);
                    $parts = explode(',', $cleaned);
                    foreach ($parts as $part) {
                        $name = trim($part);
                        if ($name) {
                            $wilayah = DB::table('wilayahs')
                                ->where('jenis', 'kecamatan')
                                ->where('nama', 'like', "%{$name}%")
                                ->first();
                            if ($wilayah) {
                                DB::table('kampus_wilayahs')->updateOrInsert([
                                    'kampus_mitra_id' => $km->id,
                                    'wilayah_id' => $wilayah->id,
                                ], [
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                            }
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            // Abaikan jika migrasi baru
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kampus_wilayahs');
    }
};
