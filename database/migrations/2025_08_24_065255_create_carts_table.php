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
       Schema::create('carts', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('customer_id'); // instead of user_id
    $table->unsignedBigInteger('product_id');
    $table->integer('quantity')->default(1);

    $table->foreign('customer_id')
          ->references('id')
          ->on('customer_regsisters') // ✅ correct table name
          ->onDelete('cascade');

    $table->foreign('product_id')
          ->references('id')
          ->on('products')
          ->onDelete('cascade');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
