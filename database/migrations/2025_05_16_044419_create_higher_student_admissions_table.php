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
        Schema::create('higher_student_admissions', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_name');
            $table->string('reg_roll_no');
            $table->string('year_of_passing');
            $table->string('board_type');
            $table->string('sex');
            $table->date('date_of_birth');
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->text('address')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('last_institution')->nullable();
            $table->string('medium_of_instruction')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->json('subjects')->nullable(); // Store as JSON
            $table->json('percentages')->nullable(); // Store as JSON
            $table->json('grades')->nullable(); // Store as JSON
            $table->string('marks_table_image_url')->nullable();
            $table->text('hobbies')->nullable();
            $table->text('co_curricular_achievements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('higher_student_admissions');
    }
};
