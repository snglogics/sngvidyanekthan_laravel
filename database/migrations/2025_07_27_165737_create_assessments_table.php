<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->date('assessment_date');
            $table->string('assessment_type');
            $table->string('class');
            $table->integer('marks');
            $table->string('duration');
            $table->string('open_house')->nullable(); // Optional: can be a date or Yes/No
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assessments');
    }
}
