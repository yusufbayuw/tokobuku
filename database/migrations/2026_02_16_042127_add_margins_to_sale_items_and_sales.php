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
        Schema::table('g003_m012_sale_items', function (Blueprint $table) {
            $table->decimal('consumer_price', 15, 2)->default(0)->after('unit_price');
            $table->decimal('discount', 15, 2)->default(0)->after('consumer_price');
            $table->decimal('margin', 15, 2)->default(0)->after('discount');
            $table->decimal('subtotal_margin', 15, 2)->default(0)->after('subtotal');
        });

        Schema::table('g003_m011_sales', function (Blueprint $table) {
            $table->decimal('total_margin', 15, 2)->default(0)->after('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('g003_m012_sale_items', function (Blueprint $table) {
            $table->dropColumn(['consumer_price', 'discount', 'margin', 'subtotal_margin']);
        });

        Schema::table('g003_m011_sales', function (Blueprint $table) {
            $table->dropColumn(['total_margin']);
        });
    }
};
