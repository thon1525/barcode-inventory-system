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
        Schema::create('taxproduct', function (Blueprint $table) {
            $table->id();
            $table->string('nametax', 255); // Tax name (max length: 255 characters)
            $table->decimal('price_tax', 8, 2); // Tax percentage with 2 decimal precision
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxproduct');
    }
};
