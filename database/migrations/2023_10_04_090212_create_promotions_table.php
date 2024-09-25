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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the promotion
            $table->text('description')->nullable(); // Description of the promotion (optional)
            $table->enum('discount_type', ['percentage', 'fixed']); // Discount type: percentage or fixed
            $table->decimal('discount_value', 10, 2); // Discount value (percentage or fixed amount)
            $table->decimal('minimum_purchase', 10, 2); // Minimum purchase amount required
            $table->date('start_date'); // Start date of the promotion
            $table->date('end_date'); // End date of the promotion
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
