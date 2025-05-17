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
            // New fields to be added
            $table->string('annual_income')->nullable()->after('date_of_birth');
            $table->string('nationality')->nullable()->after('annual_income');
            $table->string('religion_caste')->nullable()->after('nationality');
            $table->string('category')->nullable()->after('religion_caste');
            $table->string('caste_details')->nullable()->after('category');
            $table->text('siblings')->nullable()->after('medium_of_instruction');
            $table->text('local_guardian')->nullable()->after('siblings');
            $table->text('major_games')->nullable()->after('co_curricular_achievements');
            $table->string('father_education')->nullable()->after('father_occupation');
            $table->string('mother_education')->nullable()->after('mother_occupation');
            $table->string('photo_url')->nullable()->after('marks_table_image_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('higher_student_admissions', function (Blueprint $table) {
            // Rollback the new fields
            $table->dropColumn([
                'annual_income',
                'nationality',
                'religion_caste',
                'category',
                'caste_details',
                'siblings',
                'local_guardian',
                'major_games',
                'father_education',
                'mother_education',
                'photo_url',
            ]);
        });
    }
};
