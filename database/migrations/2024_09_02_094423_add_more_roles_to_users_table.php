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
            // Adding nullable foreign keys for the hierarchy
            $table->foreignId('division_id')->nullable()->constrained('divisions')->cascadeOnDelete();
            $table->foreignId('office_id')->nullable()->constrained('offices')->cascadeOnDelete();
            $table->foreignId('campus_id')->nullable()->constrained('campuses')->cascadeOnDelete();

            // Expanding the role column to include new roles

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Removing the columns and reverting the role changes
            $table->dropForeign(['division_id']);
            $table->dropForeign(['office_id']);
            $table->dropForeign(['campus_id']);
            $table->dropColumn(['division_id', 'office_id', 'campus_id']);

            $table->enum('role', ['admin', 'staff', 'teamleader'])->default('staff')->change();
        });
    }
};
