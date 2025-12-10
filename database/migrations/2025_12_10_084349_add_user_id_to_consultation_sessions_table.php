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
        if (!Schema::hasColumn('consultation_sessions', 'user_id')) {
            Schema::table('consultation_sessions', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->after('client_id')->constrained('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('consultation_sessions', 'user_id')) {
            Schema::table('consultation_sessions', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }
};
