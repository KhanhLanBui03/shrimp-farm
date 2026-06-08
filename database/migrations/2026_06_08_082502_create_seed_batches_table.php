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
        Schema::create('seed_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cultivation_cycle_id')->constrained('cultivation_cycles')->onDelete('cascade');
            $table->foreignId('pond_id')->constrained('ponds')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->string('lot_number');
            $table->integer('quantity');
            $table->date('stocking_date');
            $table->decimal('stocking_density', 8, 2);
            $table->string('seed_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seed_batches');
    }
};
