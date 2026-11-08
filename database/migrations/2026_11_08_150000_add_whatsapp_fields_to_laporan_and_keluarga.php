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
        // 1. Tambah no_hp pada keluarga_penerimas
        Schema::table('keluarga_penerimas', function (Blueprint $table) {
            if (!Schema::hasColumn('keluarga_penerimas', 'no_hp')) {
                $table->string('no_hp', 30)->nullable()->after('alamat')->index();
            }
        });

        // 2. Tambah kolom WhatsApp dan pelengkap pada laporan_penerimas
        Schema::table('laporan_penerimas', function (Blueprint $table) {
            if (!Schema::hasColumn('laporan_penerimas', 'pengirim_nama')) {
                $table->string('pengirim_nama', 100)->nullable()->after('keluarga_penerima_id');
            }
            if (!Schema::hasColumn('laporan_penerimas', 'sumber')) {
                $table->string('sumber', 20)->default('web')->after('foto')->index();
            }
            if (!Schema::hasColumn('laporan_penerimas', 'wa_sender')) {
                $table->string('wa_sender', 50)->nullable()->after('sumber')->index();
            }
            if (!Schema::hasColumn('laporan_penerimas', 'wa_message_id')) {
                $table->string('wa_message_id', 100)->nullable()->after('wa_sender');
            }
            if (!Schema::hasColumn('laporan_penerimas', 'status_laporan')) {
                $table->string('status_laporan', 30)->default('menunggu')->after('wa_message_id')->index();
            }
            if (!Schema::hasColumn('laporan_penerimas', 'tanggapan')) {
                $table->text('tanggapan')->nullable()->after('status_laporan');
            }
        });

        // 3. Modifikasi keluarga_penerima_id agar bisa nullable untuk pesan WA dari nomor baru
        try {
            Schema::table('laporan_penerimas', function (Blueprint $table) {
                $table->foreignId('keluarga_penerima_id')->nullable()->change();
            });
        } catch (\Throwable $e) {
            // Abaikan jika tidak didukung driver pada database tertentu
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keluarga_penerimas', function (Blueprint $table) {
            if (Schema::hasColumn('keluarga_penerimas', 'no_hp')) {
                $table->dropColumn('no_hp');
            }
        });

        Schema::table('laporan_penerimas', function (Blueprint $table) {
            $cols = ['pengirim_nama', 'sumber', 'wa_sender', 'wa_message_id', 'status_laporan', 'tanggapan'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('laporan_penerimas', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
