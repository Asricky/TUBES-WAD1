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
        // Change status column from ENUM to VARCHAR for flexibility
        DB::statement("ALTER TABLE consultation_sessions MODIFY COLUMN status VARCHAR(50) DEFAULT 'booked'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original ENUM
        DB::statement("ALTER TABLE consultation_sessions MODIFY COLUMN status ENUM('scheduled', 'in_progress', 'completed', 'cancelled') DEFAULT 'scheduled'");
    }
};
