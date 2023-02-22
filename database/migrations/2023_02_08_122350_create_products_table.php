<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('stock')->nullable();
            $table->float('price');
            $table->float('sale_price')->nullable();
            $table->float('discount')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('tag_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
