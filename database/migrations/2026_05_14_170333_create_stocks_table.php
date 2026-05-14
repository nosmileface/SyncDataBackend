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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sc_code');
            $table->date('date');
            $table->date('last_change_date');
            $table->unsignedBigInteger('nm_id');
            $table->string('barcode');
            $table->string('supplier_article');
            $table->string('tech_size');
            $table->string('subject');
            $table->string('category');
            $table->string('brand');
            $table->string('warehouse_name');
            $table->unsignedInteger('in_way_to_client')->default(0);
            $table->unsignedInteger('in_way_from_client')->default(0);
            $table->decimal('price', 10, 2);
            $table->unsignedTinyInteger('discount');
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedInteger('quantity_full')->default(0);
            $table->boolean('is_supply')->default(false);
            $table->boolean('is_realization')->default(false);
            $table->timestamps();

            // Unique
            $table->unique(['sc_code', 'nm_id', 'barcode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
