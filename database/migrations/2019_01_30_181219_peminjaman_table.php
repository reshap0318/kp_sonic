<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->integer('pemberi_id')->unsigned();
            $table->integer('barang_id')->unsigned();
            $table->integer('kondisi');
            $table->string('nrp_nip');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barang')->onUpdate('cascade');
            $table->foreign('nrp_nip')->references('nrp_nip')->on('users')->onUpdate('cascade');
            $table->foreign('pemberi_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
