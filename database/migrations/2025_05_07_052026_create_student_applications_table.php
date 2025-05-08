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
            $table->string('photo_url')->nullable();
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
