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
        Schema::create('interschool_participations', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('event_name');
            $table->date('event_date');
            $table->string('position')->nullable();  // e.g., 1st, 2nd, participant
            $table->string('school_name');
            $table->text('remarks')->nullable();
            $table->string('photo_url')->nullable(); // optional image/photo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interschool_participations');
    }
};
