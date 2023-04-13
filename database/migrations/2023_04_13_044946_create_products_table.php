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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->string('vendor_id')->nullable();
            $table->string('name')->nullable();
            $table->text('short_description')->nullable();
            $table->string('barcode')->nullable();
            // $table->string('category')->nullable();
            // $table->string('removed_date')->nullable();
            $table->integer('amount')->nullable();
            $table->string('type')->nullable();
            $table->string('received_date')->nullable();
            $table->string('manufactured_date')->nullable();
            $table->string('expired_date')->nullable();
            $table->string('package_type')->nullable();
            $table->integer('per_box')->nullable();
            $table->integer('package_amount')->nullable();
            // $table->string('country_id')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('price')->nullable();
            $table->string('trade_price')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
