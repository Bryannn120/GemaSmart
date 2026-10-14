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
        DB::statement("ALTER TABLE keluarga_penerimas MODIFY status_kemandirian VARCHAR(50) DEFAULT 'Belum Dinilai'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE keluarga_penerimas MODIFY status_kemandirian ENUM('Maju', 'Tetap', 'Mundur', 'Belum Dinilai') DEFAULT 'Belum Dinilai'");
    }
};
