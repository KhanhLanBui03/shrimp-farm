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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
            $table->string('name');
            $table->string('type'); // feed, medicine, probiotic, mineral, chemical, tool
            $table->string('brand')->nullable();
            $table->decimal('pellet_size', 4, 2)->nullable();
            $table->string('unit');
            $table->decimal('stock_quantity', 12, 2)->default(0);
            $table->decimal('unit_price', 15, 2);
            $table->date('expiration_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
