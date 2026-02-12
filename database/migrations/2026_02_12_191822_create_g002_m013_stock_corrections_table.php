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
        Schema::create('g002_m013_stock_corrections', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('g002_m008_stock_balance_id')->nullable()->constrained('g002_m008_stock_balances')->cascadeOnDelete();
            $table->boolean('substraction')->default(false);
            $table->integer('qty')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g002_m013_stock_corrections');
    }
};
