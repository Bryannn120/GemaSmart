<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kampus_id ke tabel users (khususnya untuk pendamping & validator dari kampus mana)
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('kampus_id')->nullable()->after('role')->constrained('kampus_mitras')->nullOnDelete();
        });

        // 2. Tambah pendamping_id dan kampus_id ke tabel keluarga_penerimas
        Schema::table('keluarga_penerimas', function (Blueprint $table) {
            $table->foreignId('pendamping_id')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
            $table->foreignId('kampus_id')->nullable()->after('pendamping_id')->constrained('kampus_mitras')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('keluarga_penerimas', function (Blueprint $table) {
            $table->dropForeign(['pendamping_id']);
            $table->dropForeign(['kampus_id']);
            $table->dropColumn(['pendamping_id', 'kampus_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['kampus_id']);
            $table->dropColumn(['kampus_id']);
        });
    }
};
