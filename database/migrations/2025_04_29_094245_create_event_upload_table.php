<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('event_upload', function (Blueprint $table) {
        $table->id();
        $table->string('common_header');       // Batch/common header
        $table->string('header')->nullable();  // Individual image header
        $table->string('image_url');           // Cloudinary image URL
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_upload');
    }
};
