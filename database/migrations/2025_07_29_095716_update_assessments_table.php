<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('assessments', function (Blueprint $table) {
            // Remove old columns
            $table->dropColumn([
                'assessment_date',
                'assessment_type',
                'class',
                'marks',
                'duration',
                'open_house'
            ]);

            // Add new columns
            $table->string('classname');
            $table->string('pdf_url');
            $table->string('pdf_public_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('assessments', function (Blueprint $table) {
            // Re-add old columns (for rollback)
            $table->date('assessment_date');
            $table->string('assessment_type');
            $table->string('class');
            $table->decimal('marks', 5, 2);
            $table->integer('duration');
            $table->boolean('open_house');

            // Remove new columns
            $table->dropColumn(['classname', 'pdf_url', 'pdf_public_id']);
        });
    }
}