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
        Schema::table('announcement_files', function (Blueprint $table) {
            $table->dropColumn(['original_filename', 'file_extension']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcement_files', function (Blueprint $table) {
            $table->string('original_filename')->nullable();
            $table->string('file_extension')->nullable();
        });
    }
};
