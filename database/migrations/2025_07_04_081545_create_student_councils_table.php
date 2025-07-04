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
        Schema::create('student_councils', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('position'); // e.g., Head Boy, Head Girl, Sports Captain
            $table->string('photo')->nullable(); // Optional profile photo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_councils');
    }
};
