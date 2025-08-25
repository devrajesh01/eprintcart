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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('user_id')->nullable();

            // Arrays stored as JSON
            $table->json('product_id');
            $table->string('product_image')->nullable();
            $table->json('product_quantity');

            $table->decimal('amount', 10, 2);
            $table->string('currency');   // no default value
            $table->string('address');

            // Payment details
            $table->string('payment_method')->nullable();   // cod, stripe, razorpay, paypal
            $table->string('transaction_id')->nullable();   // gateway transaction id
            $table->string('status')->default('pending');   // pending, success, failed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
