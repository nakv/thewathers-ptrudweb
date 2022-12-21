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
        Schema::create('tbl_admin_roles', function (Blueprint $table) {
            $table->bigIncrements('id_admin_role');
            $table->unsignedBigInteger('admin_admin_id');
            $table->unsignedBigInteger('role_id_role');
            $table->foreign('admin_admin_id')->references('admin_id')->on('tbl_admin');
            $table->foreign('role_id_role')->references('id_role')->on('tbl_roles');
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
        Schema::dropIfExists('tbl_admin_roles');
    }
};