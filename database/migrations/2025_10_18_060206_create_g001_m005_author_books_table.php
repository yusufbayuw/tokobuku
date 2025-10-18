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
        Schema::create('g001_m005_author_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('g001_m004_book_id')->nullable()->constrained('g001_m004_books')->cascadeOnDelete();
            $table->foreignId('g001_m001_author_id')->nullable()->constrained('g001_m001_authors')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g001_m005_author_books');
    }
};
