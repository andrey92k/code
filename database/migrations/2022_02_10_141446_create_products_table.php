<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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

            $table->string('slug')->unique();
            $table->string('sku')->nullable();
            $table->string('model')->nullable();
            $table->boolean('markdown')->default(0);

            $table->decimal('sale_price', 15, 2)->nullable();
            $table->decimal('price', 15, 2)->default(0);
            $table->decimal('cashback', 15, 2)->default(0);

            $table->tinyInteger('type_product')->default(0);

            $table->bigInteger('order')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');

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
}
