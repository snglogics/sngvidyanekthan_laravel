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
    Schema::create('cloud_images', function (Blueprint $table) {
        $table->id();
        $table->string('image_name');
        $table->string('description')->nullable();
        $table->string('image_header')->nullable();
        $table->string('image_url'); // ✅ Save Cloudinary URL here
        $table->string('public_id');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('principal_msgs');
    }
};
