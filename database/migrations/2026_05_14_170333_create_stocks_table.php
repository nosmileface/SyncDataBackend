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
            $table->foreignId('account_id')->constrained('accounts')->cascadeOnDelete();
            $table->unsignedBigInteger('sc_code')->nullable();
            $table->date('date')->nullable();
            $table->date('last_change_date')->nullable();
            $table->bigInteger('nm_id');
            $table->bigInteger('barcode');
            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->string('subject')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->string('warehouse_name');
            $table->unsignedInteger('in_way_to_client')->default(0)->nullable();
            $table->unsignedInteger('in_way_from_client')->default(0)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->unsignedTinyInteger('discount')->nullable();
            $table->unsignedInteger('quantity')->default(0)->nullable();
            $table->unsignedInteger('quantity_full')->default(0)->nullable();
            $table->boolean('is_supply')->default(false)->nullable();
            $table->boolean('is_realization')->default(false)->nullable();
            $table->timestamps();

            // Unique
            $table->unique(['account_id', 'nm_id', 'barcode', 'warehouse_name']);
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
