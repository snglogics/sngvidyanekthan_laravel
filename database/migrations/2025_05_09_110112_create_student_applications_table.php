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
        Schema::create('student_applications', function (Blueprint $table) {
            $table->id();
            $table->string('class');
            $table->string('pupil_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('address');
            $table->string('phone_number');
            $table->string('email');
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('photo_url');

            // Additional fields
            $table->string('father_occupation')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('Whatsapp_number')->nullable();
            $table->string('aadhar')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('mother_toungue')->nullable();
            $table->string('father_education')->nullable();
            $table->string('mother_education')->nullable();
            $table->string('total_members')->nullable();
            $table->string('siblings')->nullable();
            $table->string('local_guardian')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('boarding_point')->nullable();
            $table->string('pdf_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_applications');
    }
};
