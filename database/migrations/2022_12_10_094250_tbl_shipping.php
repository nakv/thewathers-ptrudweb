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
        Schema::create('tbl_shipping', function (Blueprint $table) {
            $table->bigIncrements('shipping_id');
            $table->string('shipping_name');
            $table->string('shipping_address');
            $table->string('addressdelivery');
            $table->string('shipping_phone');
            $table->string('shipping_email');
            $table->string('shipping_note')->nullable();
            $table->integer('payment_method');
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
        Schema::dropIfExists('tbl_shipping');
    }
};