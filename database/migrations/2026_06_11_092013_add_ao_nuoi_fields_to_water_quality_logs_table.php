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
        Schema::table('water_quality_logs', function (Blueprint $table) {
            $table->decimal('do', 5, 2)->nullable();
            $table->decimal('alkalinity', 6, 2)->nullable();
            $table->decimal('temperature', 4, 2)->nullable();
            $table->decimal('nh3', 6, 4)->nullable();
            $table->decimal('h2s', 6, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('water_quality_logs', function (Blueprint $table) {
            $table->dropColumn(['do', 'alkalinity', 'temperature', 'nh3', 'h2s']);
        });
    }
};
