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
        Schema::create('academic_performances', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('roll_number')->unique();
            $table->string('class');
            $table->string('section')->nullable();
            $table->json('subjects_marks');
            $table->integer('total_marks')->default(0);
            $table->decimal('percentage', 5, 2)->default(0);
            $table->string('grade')->nullable();
            $table->text('performance_description')->nullable();
            $table->string('term');
            $table->string('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_performances');
    }
};
