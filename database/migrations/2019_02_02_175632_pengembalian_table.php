<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PengembalianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pengembalian', function (Blueprint $table) {
          $table->increments('id');
          $table->date('tanggal');
          $table->integer('peminjaman_id')->unsigned();
          $table->integer('kondisi');
          $table->string('nrp_nip');
          $table->text('keterangan')->nullable();
          $table->timestamps();

          $table->foreign('peminjaman_id')->references('id')->on('peminjaman')->onUpdate('cascade');
          $table->foreign('nrp_nip')->references('nrp_nip')->on('users')->onUpdate('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalian');
    }
}
