<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_stock', function(Blueprint $table){
            $table->bigInteger('product_id');
            $table->integer('stock_id');
            $table->smallInteger('quantity');
            $table->date('created_at');
            $table->date('updated_at');

            $table->primary(['product_id', 'stock_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products_stock');
    }
}
