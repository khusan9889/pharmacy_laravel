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
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete();
            $table->string('name')->nullable();
            $table->text('short_description')->nullable();
            $table->string('barcode')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->string('removed_date')->nullable();
            $table->integer('count')->nullable();
            $table->string('type')->nullable();
            $table->string('manufactured_date')->nullable();
            $table->string('expired_date')->nullable();
            $table->string('package_type')->nullable();
            $table->integer('per_box')->nullable();
            $table->integer('package_count')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->string('manufacturer')->nullable();
            $table->double('price')->nullable();
            $table->double('initial_price')->nullable();
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

