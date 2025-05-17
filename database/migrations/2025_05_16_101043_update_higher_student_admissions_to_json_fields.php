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
        Schema::table('higher_student_admissions', function (Blueprint $table) {
            // Change longtext to json for these fields
            $table->json('subjects')->nullable()->change();
            $table->json('percentages')->nullable()->change();
            $table->json('grades')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('higher_student_admissions', function (Blueprint $table) {
            // Revert back to longtext if needed
            $table->longText('subjects')->nullable()->change();
            $table->longText('percentages')->nullable()->change();
            $table->longText('grades')->nullable()->change();
        });
    }
};
