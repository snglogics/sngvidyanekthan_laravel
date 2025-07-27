<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeMarksAndDurationNullableInAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->integer('marks')->nullable()->change();
            $table->string('duration')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->integer('marks')->nullable(false)->change();
            $table->string('duration')->nullable(false)->change();
        });
    }
}
