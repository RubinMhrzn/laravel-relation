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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->foreignId('color_id')->nullable()->constraints("colors")->nullOnDelete();
            $table->foreignId('size_id')->nullable()->constraints("sizes")->nullOnDelete();
            $table->boolean('is_parent');
            $table->decimal('price', 10, 2);
            $table->decimal('base_price', 10, 2);
            $table->boolean('status')->default(1);
            $table->integer('stock')->defaule(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
