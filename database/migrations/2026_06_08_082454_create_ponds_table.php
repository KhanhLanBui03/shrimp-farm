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
        Schema::create('ponds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farming_zone_id')->constrained('farming_zones')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('name');
            $table->decimal('mouth_diameter', 8, 2)->nullable();
            $table->decimal('bottom_diameter', 8, 2)->nullable();
            $table->decimal('border_exclusion', 8, 2)->nullable();
            $table->decimal('area', 10, 2);
            $table->string('pond_type'); // 'nursery' or 'rearing'
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ponds');
    }
};
