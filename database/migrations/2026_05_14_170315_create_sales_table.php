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
            $table->string('g_number')->nullable();
            $table->string('sale_id');
            $table->unsignedBigInteger('income_id')->nullable();
            $table->string('odid')->nullable();
            $table->date('date')->nullable();
            $table->date('last_change_date')->nullable();
            $table->bigInteger('nm_id')->nullable();
            $table->bigInteger('barcode')->nullable();
            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->string('subject')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->string('country_name')->nullable();
            $table->string('oblast_okrug_name')->nullable();
            $table->string('region_name')->nullable();
            $table->string('warehouse_name')->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->decimal('price_with_disc', 10, 2)->nullable();
            $table->decimal('finished_price', 10, 2)->nullable();
            $table->decimal('for_pay', 10, 2)->nullable();
            $table->decimal('promo_code_discount', 10, 2)->nullable();
            $table->smallInteger('discount_percent')->nullable();
            $table->decimal('spp', 5, 2)->nullable();
            $table->boolean('is_supply')->default(false)->nullable();
            $table->boolean('is_realization')->default(false)->nullable();
            $table->boolean('is_storno')->nullable();
            $table->timestamps();

            // Unique
            $table->unique(['g_number', 'sale_id', 'nm_id', 'barcode']);
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
