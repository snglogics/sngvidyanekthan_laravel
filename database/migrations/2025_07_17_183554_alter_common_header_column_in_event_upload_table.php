<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCommonHeaderColumnInEventUploadTable extends Migration
{
    public function up()
    {
        Schema::table('event_upload', function (Blueprint $table) {
            $table->text('common_header')->change(); // For up to ~65,535 characters
        });
    }

    public function down()
    {
        Schema::table('event_upload', function (Blueprint $table) {
            $table->string('common_header', 255)->change(); // Revert back if needed
        });
    }
}
