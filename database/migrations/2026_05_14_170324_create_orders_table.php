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
            $table->dateTime('date');
            $table->date('last_change_date');
            $table->dateTime('cancel_dt')->nullable();
            $table->unsignedBigInteger('nm_id');
            $table->string('barcode');
            $table->string('supplier_article');
            $table->string('tech_size');
            $table->string('subject');
            $table->string('category');
            $table->string('brand');
            $table->string('oblast')->nullable();
            $table->string('warehouse_name');
            $table->decimal('total_price', 12, 4);
            $table->unsignedTinyInteger('discount_percent');
            $table->unsignedBigInteger('income_id')->default(0);
            $table->boolean('is_cancel')->default(false);
            $table->timestamps();
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
