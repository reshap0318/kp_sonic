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
            $table->string('no_serial')->unique()->nullable();
            $table->string('th_perolehan')->nullable();
            $table->integer('id_jenis')->unsigned()->nullable();
            $table->integer('id_merek')->unsigned()->nullable();
            $table->integer('id_satker')->unsigned()->nullable();
            $table->string('type')->nullable();
            $table->integer('kondisi');
            $table->integer('status')->default(1);
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('id_jenis')->references('id')->on('barang_jenis')->onUpdate('cascade');
            $table->foreign('id_merek')->references('id')->on('merek')->onUpdate('cascade');
            $table->foreign('id_satker')->references('id')->on('satker')->onUpdate('cascade');
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
