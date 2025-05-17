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
            $table->dropColumn(['subjects', 'percentages', 'grades']);
        });

        Schema::table('higher_student_admissions', function (Blueprint $table) {
            $table->json('subjects')->nullable();
            $table->json('percentages')->nullable();
            $table->json('grades')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('higher_student_admissions', function (Blueprint $table) {
            $table->longText('subjects')->nullable();
            $table->longText('percentages')->nullable();
            $table->longText('grades')->nullable();
        });
    }
};
