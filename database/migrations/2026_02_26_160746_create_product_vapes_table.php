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
        Schema::create('product_vapes', function (Blueprint $table) {
            $table->id();
            $table->boolean('has_podsystem');
            $table->unsignedInteger('puff_count');
            $table->foreignId('product_id')->constrained('products', 'id');
            $table->foreignId('color_id')->constrained('colors', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_vapes');
    }
};
