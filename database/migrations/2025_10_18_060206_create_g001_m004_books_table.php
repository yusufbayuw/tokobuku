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
        Schema::create('g001_m004_books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('isbn')->nullable();
            $table->string('sku')->nullable();
            $table->foreignId('g001_m003_publisher_id')->nullable()->constrained('g001_m003_publishers')->cascadeOnDelete();
            $table->string('edition')->nullable();
            $table->year('year')->nullable();
            $table->string('language')->nullable();
            $table->integer('pages')->nullable();
            $table->string('cover_photo')->nullable();
            $table->decimal('retail_price', 15, 2)->nullable();
            $table->decimal('agent_price', 15, 2)->nullable();
            $table->integer('min_stock')->nullable();
            $table->boolean('active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g001_m004_books');
    }
};
