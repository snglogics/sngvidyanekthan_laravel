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
    // Rename old table first
    if (Schema::hasTable('sliders')) {
        Schema::rename('sliders', 'sliders_old');
    }

    // Then create the new sliders table
    Schema::create('sliders', function (Blueprint $table) {
        $table->id();
        $table->string('image')->nullable();
        $table->string('heading')->nullable();
        $table->text('description')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
