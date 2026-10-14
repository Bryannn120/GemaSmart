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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim_nip', 50)->nullable()->after('name');
            $table->string('fakultas_prodi')->nullable()->after('nim_nip');
            $table->string('no_hp', 30)->nullable()->after('email');
            $table->string('status_keaktifan', 20)->default('aktif')->after('kampus_id');
            $table->string('desa_penugasan')->nullable()->after('status_keaktifan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nim_nip', 'fakultas_prodi', 'no_hp', 'status_keaktifan', 'desa_penugasan']);
        });
    }
};
