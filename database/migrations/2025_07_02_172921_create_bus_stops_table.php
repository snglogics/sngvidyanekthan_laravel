<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bus_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained('buses')->onDelete('cascade');
            $table->string('stop_name');
            $table->time('morning_time')->nullable();
            $table->time('evening_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bus_stops');
    }
};
