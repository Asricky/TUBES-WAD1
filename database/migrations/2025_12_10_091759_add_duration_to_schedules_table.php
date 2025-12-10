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
        if (!Schema::hasColumn('schedules', 'duration')) {
            Schema::table('schedules', function (Blueprint $table) {
                $table->integer('duration')->default(60)->after('status'); // 60 minutes default
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('schedules', 'duration')) {
            Schema::table('schedules', function (Blueprint $table) {
                $table->dropColumn('duration');
            });
        }
    }
};
