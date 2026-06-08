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
        Schema::create('harvests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cultivation_cycle_id')->constrained('cultivation_cycles')->onDelete('cascade');
            $table->foreignId('pond_id')->constrained('ponds')->onDelete('cascade');
            $table->date('harvest_date');
            $table->integer('doc');
            $table->string('harvest_type'); // partial, total
            $table->string('shrimp_condition'); // alive, substandard, dead
            $table->decimal('weight', 10, 2); // kg
            $table->integer('quantity');
            $table->string('size_range')->nullable();
            $table->decimal('unit_price', 15, 2);
            $table->decimal('total_amount', 15, 2);
            $table->decimal('net_rental_fee', 15, 2)->default(0);
            $table->decimal('net_amount', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harvests');
    }
};
