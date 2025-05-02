<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('principal_msgs', function (Blueprint $table) {
            $table->id();
            $table->string('image_name');
            $table->text('description')->nullable();
            $table->string('image_header')->nullable();
            $table->string('image_url');
            $table->string('public_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('principal_msgs');
    }
};
