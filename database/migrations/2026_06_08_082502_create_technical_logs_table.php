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
        Schema::create('technical_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cultivation_cycle_id')->constrained('cultivation_cycles')->onDelete('cascade');
            $table->foreignId('pond_id')->constrained('ponds')->onDelete('cascade');
            $table->date('date');
            $table->integer('doc');
            $table->decimal('water_level', 5, 2)->nullable();
            $table->decimal('ph', 4, 2)->nullable();
            $table->decimal('feed_amount', 8, 2)->nullable();
            $table->decimal('siphon_amount', 8, 2)->nullable();
            $table->decimal('shrimp_size', 6, 2)->nullable();
            $table->decimal('adg', 5, 2)->nullable();
            $table->decimal('fcr', 4, 2)->nullable();
            $table->integer('mortality')->nullable();
            $table->text('transfer_log')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_logs');
    }
};
