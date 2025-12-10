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
        if (!Schema::hasColumn('consultation_sessions', 'meet_link')) {
            Schema::table('consultation_sessions', function (Blueprint $table) {
                $table->text('meet_link')->nullable()->after('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('consultation_sessions', 'meet_link')) {
            Schema::table('consultation_sessions', function (Blueprint $table) {
                $table->dropColumn('meet_link');
            });
        }
    }
};
