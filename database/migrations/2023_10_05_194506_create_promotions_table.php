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
            $table->id('promotion_id'); // promotion id
            $table->unsignedBigInteger('user_id'); // Refers to the business user
            $table->string('product_service_name'); // Name of the product or service being promoted
            $table->text('target_audience'); // Target audience description
            $table->text('description'); // Promotion description
            $table->date('start_date'); // Start date of promotion
            $table->date('end_date'); // End date of promotion
            $table->decimal('discount_amount', 8, 2); // Discount amount for the promotion
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
