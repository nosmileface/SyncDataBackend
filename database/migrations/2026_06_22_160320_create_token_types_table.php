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
        Schema::create('token_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('api_service_id')->constrained('api_services')->cascadeOnDelete();
            $table->string('name');
            $table->string('type');
            $table->timestamps();

            // Index
            $table->index('api_service_id');

            // Unique
            $table->unique(['api_service_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_types');
    }
};
