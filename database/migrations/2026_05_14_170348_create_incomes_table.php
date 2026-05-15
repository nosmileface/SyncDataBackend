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
            $table->unsignedBigInteger('income_id');
            $table->date('date')->nullable();
            $table->date('last_change_date')->nullable();
            $table->date('date_close')->nullable();
            $table->bigInteger('nm_id');
            $table->bigInteger('barcode');
            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->string('warehouse_name')->nullable();
            $table->string('number')->nullable();
            $table->decimal('total_price', 10, 2)->default(0)->nullable();
            $table->unsignedInteger('quantity')->default(0)->nullable();
            $table->timestamps();

            // Unique
            $table->unique(['income_id', 'nm_id', 'barcode']);
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
