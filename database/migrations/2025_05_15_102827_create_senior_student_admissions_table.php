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
        Schema::create('student_admissions', function (Blueprint $table) {
            $table->id();
            $table->string('admission_class');
            $table->string('pupil_name');
            $table->enum('gender', ['Boy', 'Girl', 'Transgender']);
            $table->string('date_of_birth');
            $table->string('aadhaar_no')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion_caste')->nullable();
            $table->string('last_institution_attended')->nullable();
            $table->string('medium_of_instruction')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('parent_education')->nullable();
            $table->string('family_members')->nullable();
            $table->text('siblings')->nullable();
            $table->text('immunization_status')->nullable();
            $table->string('local_guardian')->nullable();
            $table->text('hobbies')->nullable();
            $table->text('games_played')->nullable();
            $table->text('cocurricular_achievements')->nullable();
            $table->text('cca_options')->nullable();
            $table->string('year_of_passing')->nullable();
            $table->integer('total_marks')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('pdf_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senior_student_admissions');
    }
};
