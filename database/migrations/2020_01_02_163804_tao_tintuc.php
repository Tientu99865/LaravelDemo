<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoTintuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('TinTuc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('TieuDe',60);
            $table->string('TieuDeKhongDau',60);
            $table->text('TomTat');
            $table->longText('NoiDung');
            $table->string('Hinh',200);
            $table->integer('NoiBat')->default(0);
            $table->integer('SoLuotXem')->default(0);
            $table->integer('idLoaiTin')->unsigned();
            $table->foreign('idLoaiTin')->references('id')->on('LoaiTin');
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
        Schema::drop('TinTuc');
    }
}
