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
        Schema::create('operating_expenses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('expense_type'); // Electricity, Labor, Fuel, etc.
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('cost_center_type')->nullable(); // farming_zone, pond, cultivation_cycle
            $table->unsignedBigInteger('cost_center_id')->nullable();
            $table->string('allocation_method'); // direct, equal_split
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operating_expenses');
    }
};
