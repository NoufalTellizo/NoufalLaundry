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
        Schema::create('supplier_news', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->double('tax_number', 20,3)->nullable();
            $table->double('opening_balance', 20,3)->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->integer('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_news');
    }
};
