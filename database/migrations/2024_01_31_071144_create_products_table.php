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
            $table->bigincrements('id');
            // $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->string('purchase_price',8,2);
            $table->string('sale_price',8,2);
            $table->string('stock');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('image')->default('default.png');
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
