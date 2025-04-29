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
        Schema::create('product_news', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string('sku')->unique();
            $table->double('purchase_price', 20,3);
            $table->double('opening_stock', 20,3)->nullable();
            $table->text('description');
            $table->integer('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_news');
    }
};
