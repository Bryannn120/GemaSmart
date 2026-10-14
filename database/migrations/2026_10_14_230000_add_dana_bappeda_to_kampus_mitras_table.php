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
        Schema::table('kampus_mitras', function (Blueprint $table) {
            if (!Schema::hasColumn('kampus_mitras', 'dana_bappeda')) {
                $table->decimal('dana_bappeda', 15, 2)->default(0)->after('status_mou');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kampus_mitras', function (Blueprint $table) {
            if (Schema::hasColumn('kampus_mitras', 'dana_bappeda')) {
                $table->dropColumn('dana_bappeda');
            }
        });
    }
};
