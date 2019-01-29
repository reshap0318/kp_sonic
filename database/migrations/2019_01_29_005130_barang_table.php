<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_serial');
            $table->string('th_perolehan');
            $table->integer('id_jenis')->unsigned();
            $table->integer('id_merek')->unsigned();
            $table->string('type');
            $table->integer('kondisi');
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('id_jenis')->references('id')->on('barang_jenis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_merek')->references('id')->on('merek')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
