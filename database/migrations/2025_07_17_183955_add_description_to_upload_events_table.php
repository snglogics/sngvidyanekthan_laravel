<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToUploadEventsTable extends Migration
{
    public function up()
    {
        Schema::table('event_upload', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('event_upload', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
