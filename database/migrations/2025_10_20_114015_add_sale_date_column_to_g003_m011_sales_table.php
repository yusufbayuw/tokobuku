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
        Schema::table('g003_m011_sales', function (Blueprint $table) {
            $table->dateTime('sale_date')->nullable()->after('g002_m007_location_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('g003_m011_sales', function (Blueprint $table) {
            $table->dropColumn('sale_date');
        });
    }
};
