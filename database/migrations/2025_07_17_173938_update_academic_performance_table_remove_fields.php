<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAcademicPerformanceTableRemoveFields extends Migration
{
    public function up()
    {
        Schema::table('academic_performances', function (Blueprint $table) {
            $table->dropColumn([
                'roll_number',
                'section',
                'subjects_marks',
                'total_marks',
                'grade',
            ]);
        });
    }

    public function down()
    {
        Schema::table('academic_performances', function (Blueprint $table) {
            $table->string('roll_number')->nullable();
            $table->string('section')->nullable();
            $table->text('subjects_marks')->nullable(); // assuming this was JSON/text
            $table->integer('total_marks')->nullable();
            $table->string('grade')->nullable();
        });
    }
}
