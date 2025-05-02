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
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('slider1_heading')->nullable();
            $table->text('slider1_description')->nullable();
            
            $table->string('slider2_heading')->nullable();
            $table->text('slider2_description')->nullable();
            
            $table->string('slider3_heading')->nullable();
            $table->text('slider3_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn([
                'slider1_heading', 'slider1_description',
                'slider2_heading', 'slider2_description',
                'slider3_heading', 'slider3_description',
            ]);
        });
    }
};
