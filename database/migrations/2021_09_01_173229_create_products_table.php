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
            $table->foreignId('category_id');
            $table->foreignId('subcategory_id');
            $table->foreignId('subsubcategory_id')->nullable();
            $table->foreignId('brand_id')->nullable();
            $table->string('product_name');
            $table->string('product_slug');
            $table->bigInteger('product_code');
            $table->string('product_qty');
            $table->string('selling_price');
            $table->string('descount_price')->nullable();
            $table->text('short_details');
            $table->text('long_details');
            $table->string('thmbnail');
            $table->integer('hotdeal_product')->nullable();
            $table->integer('featured_product')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(1)->comment('1= Active 0=Deactive');
            $table->timestamps();
            $table->softDeletes();
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
