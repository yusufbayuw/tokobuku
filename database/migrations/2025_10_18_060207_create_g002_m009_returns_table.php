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
        Schema::create('g002_m009_returns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('from_location_id')->nullable()->constrained('g002_m007_locations')->cascadeOnDelete();
            $table->foreignUuid('to_location_id')->nullable()->constrained('g002_m007_locations')->cascadeOnDelete();
            $table->foreignId('handled_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->date('return_date')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g002_m009_returns');
    }
};
