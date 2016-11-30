<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsStruct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('brand_name', 100);
            $table->boolean('is_active')->default(0);
            $table->date('created_at');
            $table->date('updated_at');
        });

        Schema::create('groups_suppliers', function(Blueprint $table){
            $table->increments('id');
            $table->integer('category_id');
            $table->string('group_name', 50);
            $table->date('created_at');
            $table->date('updated_at');
        });

        Schema::create('suppliers', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('supplier_name', 100);
            $table->boolean('is_active')->default(0);
            $table->date('created_at');
            $table->date('updated_at');
        });

        Schema::create('products', function(Blueprint $table){
            $table->bigIncrements('id')->unsigned();
            $table->mediumInteger('brand_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->string('model', 20);
            $table->string('name', 150);
            $table->text('description');
            $table->double('price', 8, 2);
            $table->smallInteger('quantity');
            $table->string('image', 200);
            $table->string('warranty', 20);
            $table->double('discount', 6, 2);
            $table->text('promotionDescription');
            $table->string('currencyRate', 20);
            $table->string('promotionDateEnd', 20);
            $table->boolean('is_active')->default(0);
            $table->date('created_at');
            $table->date('updated_at');

            $table->index(['brand_id', 'group_id', 'model']);

            /*$table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('group_id')->references('id')->on('groups_suppliers');*/
        });

        Schema::create('products_sku', function(Blueprint $table){
            $table->bigInteger('product_id')->unsigned();
            $table->mediumInteger('supplier_id')->unsigned();
            $table->string('sku', 150);
            $table->smallInteger('quantity');
            $table->boolean('is_active')->default(0);
            $table->double('price', 8, 2);
            $table->date('created_at');
            $table->date('updated_at');

            $table->primary(['product_id', 'supplier_id', 'sku']);

            /*$table->foreign('product_id')->references('id')->on('products');
            $table->foreign('supplier_id')->references('id')->on('suppliers');*/
        });

        Schema::create('stock', function(Blueprint $table){
            $table->bigIncrements('stock_id')->unsigned();
            $table->mediumInteger('supplier_id')->unsigned();
            $table->string('stock_name', 150);
            $table->boolean('is_active')->default(0);
            $table->date('created_at');
            $table->date('updated_at');

            $table->index(['supplier_id']);

            //$table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::create('categories', function(Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('category_name', 100);
            $table->boolean('is_active')->default(0);
            $table->date('created_at');
            $table->date('updated_at');
        });

        Schema::create('products_categories', function(Blueprint $table){
            $table->bigInteger('products_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->boolean('is_active')->default(0);
            $table->date('created_at');
            $table->date('updated_at');

            $table->index(['category_id']);

            //$table->foreign('category_id')->references('id')->on('categories');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
        Schema::drop('products_sku');
        Schema::drop('stock');
        Schema::drop('products_categories');
        Schema::drop('groups_suppliers');
        Schema::drop('categories');
        Schema::drop('brands');
        Schema::drop('suppliers');
    }
}
