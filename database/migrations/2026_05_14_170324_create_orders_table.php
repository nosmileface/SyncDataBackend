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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('g_number');
            $table->string('odid')->nullable();
            $table->dateTime('date')->nullable();
            $table->date('last_change_date')->nullable();
            $table->dateTime('cancel_dt')->nullable();
            $table->bigInteger('nm_id')->nullable();
            $table->bigInteger('barcode')->nullable();
            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->string('subject')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->string('oblast')->nullable();
            $table->string('warehouse_name')->nullable();
            $table->decimal('total_price', 12, 4)->nullable();
            $table->unsignedTinyInteger('discount_percent')->nullable();
            $table->unsignedBigInteger('income_id')->default(0);
            $table->boolean('is_cancel')->default(false);
            $table->timestamps();

            // Unique
            $table->unique(['g_number', 'nm_id', 'barcode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
