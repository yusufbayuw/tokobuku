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
        Schema::create('g003_m012_sale_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('g003_m011_sale_id')->nullable()->constrained('g003_m011_sales')->cascadeOnDelete();
            $table->foreignId('g001_m004_book_id')->nullable()->constrained('g001_m004_books')->cascadeOnDelete();
            $table->decimal('unit_price', 15, 2)->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('subtotal', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g003_m012_sale_items');
    }
};
