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
        Schema::create('g002_m008_stock_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('g001_m004_book_id')->nullable()->constrained('g001_m004_books')->cascadeOnDelete();
            $table->foreignId('g002_m007_location_id')->nullable()->constrained('g002_m007_locations')->cascadeOnDelete();
            $table->integer('qty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g002_m008_stock_balances');
    }
};
