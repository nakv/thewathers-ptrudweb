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
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->bigIncrements('id_admin_roles');
            $table->unsignedBigInteger('admin_admin_id');
            $table->unsignedBigInteger('roles_id_roles');
            $table->foreign('admin_admin_id')->references('admin_id')->on('tbl_admin');
            $table->foreign('roles_id_roles')->references('id_roles')->on('tbl_roles');
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
        Schema::dropIfExists('admin_roles');
    }
};