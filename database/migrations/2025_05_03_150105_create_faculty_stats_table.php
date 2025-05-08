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
        Schema::create('faculty_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('total_teachers');
            $table->unsignedInteger('pgts');
            $table->unsignedInteger('tgts');
            $table->unsignedInteger('prts');
            $table->unsignedInteger('pets');
            $table->unsignedInteger('non_teaching');
            $table->unsignedInteger('mandatory_training_teachers');
            $table->unsignedInteger('trainings_attended');
            $table->string('special_educator')->default('NO');
            $table->string('counsellor_appointed')->default('NO');
            $table->string('mandatory_training_completed')->default('NO');
            $table->string('ntts')->default('NO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_stats');
    }
};
