<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('g003_m011_sales', function (Blueprint $table) {
            $table->enum('status', ['draft', 'final', 'cancelled'])->default('draft')->after('total');
        });

        Schema::table('g003_m012_sale_items', function (Blueprint $table) {
            $table->boolean('is_correction')->default(false)->after('subtotal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('g003_m011_sales', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('g003_m012_sale_items', function (Blueprint $table) {
            $table->dropColumn('is_correction');
        });
    }
};
