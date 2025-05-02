<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('image_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_gallery_id')->constrained()->onDelete('cascade');
            $table->string('title'); // e.g. "Match Highlights"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
