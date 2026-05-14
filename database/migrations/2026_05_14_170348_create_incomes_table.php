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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('income_id')->unique();
            $table->date('date');
            $table->date('last_change_date');
            $table->date('date_close')->nullable();
            $table->unsignedBigInteger('nm_id');
            $table->string('barcode');
            $table->string('supplier_article');
            $table->string('tech_size');
            $table->string('warehouse_name');
            $table->string('number')->nullable();
            $table->decimal('total_price', 10, 2)->default(0);
            $table->unsignedInteger('quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
