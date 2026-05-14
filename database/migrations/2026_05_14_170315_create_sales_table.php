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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('g_number');
            $table->string('sale_id')->unique();
            $table->unsignedBigInteger('income_id');
            $table->string('odid')->nullable();
            $table->date('date');
            $table->date('last_change_date');
            $table->unsignedBigInteger('nm_id');
            $table->string('barcode');
            $table->string('supplier_article');
            $table->string('tech_size');
            $table->string('subject');
            $table->string('category');
            $table->string('brand');
            $table->string('country_name');
            $table->string('oblast_okrug_name');
            $table->string('region_name');
            $table->string('warehouse_name');
            $table->decimal('total_price', 10, 2);
            $table->decimal('price_with_disc', 10, 2);
            $table->decimal('finished_price', 10, 2);
            $table->decimal('for_pay', 10, 2);
            $table->decimal('promo_code_discount', 10, 2)->nullable();
            $table->unsignedTinyInteger('discount_percent');
            $table->decimal('spp', 5, 2);
            $table->boolean('is_supply')->default(false);
            $table->boolean('is_realization')->default(false);
            $table->boolean('is_storno')->nullable();
            $table->timestamps();

            // Unique
            $table->unique(['sale_id', 'nm_id', 'barcode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
