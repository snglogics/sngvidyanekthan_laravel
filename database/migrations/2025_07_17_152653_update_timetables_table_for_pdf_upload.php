<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTimetablesTableForPdfUpload extends Migration
{
    public function up()
    {
        Schema::table('timetables', function (Blueprint $table) {
            // Add new columns
            $table->string('pdf_url')->nullable();
            $table->string('pdf_public_id')->nullable();

            // Optional: remove old fields no longer needed
            $table->dropColumn([
                'section',
                'day',
                'period_number',
                'subject',
                'teacher_name',
                'start_time',
                'end_time',
                'room_number'
            ]);
        });
    }

    public function down()
    {
        Schema::table('timetables', function (Blueprint $table) {
            // Reverse changes: re-add dropped fields
            $table->string('section')->nullable();
            $table->string('day')->nullable();
            $table->integer('period_number')->nullable();
            $table->string('subject')->nullable();
            $table->string('teacher_name')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('room_number')->nullable();

            // Drop the new ones
            $table->dropColumn(['pdf_url', 'pdf_public_id']);
        });
    }
}
