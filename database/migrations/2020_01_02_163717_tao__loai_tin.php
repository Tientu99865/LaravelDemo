<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoLoaiTin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('LoaiTin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idTheLoai')->unsigned();
            $table->foreign('idTheLoai')->references('id')->on('TheLoai');
            $table->string('Ten',60);
            $table->string('TenKhongDau',60);
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
        //
        Schema::drop('LoaiTin');
    }
}
