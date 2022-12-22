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
        Schema::create('tbl_order_details', function (Blueprint $table) {
            $table->bigIncrements('order_details_id');
            $table->string('order_code');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->string('product_price');
            $table->integer('product_sales_quantity');
            $table->foreign('order_code')->references('order_code')->on('tbl_order');
            $table->foreign('product_id')->references('product_id')->on('tbl_product');
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
        Schema::dropIfExists('tbl_order_details');
    }
};