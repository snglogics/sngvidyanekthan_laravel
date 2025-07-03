<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('bus_no');
            $table->string('driver_name');
            $table->string('driver_phone');
            $table->string('attender_name');
            $table->string('attender_phone');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
