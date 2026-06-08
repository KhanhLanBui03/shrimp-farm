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
        Schema::create('water_quality_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('sampling_location');
            $table->decimal('salinity', 5, 2)->nullable();
            $table->decimal('ph', 4, 2)->nullable();
            $table->decimal('transparency', 5, 2)->nullable();
            $table->decimal('tidal_peak', 4, 2)->nullable();
            $table->decimal('water_level', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_quality_logs');
    }
};
