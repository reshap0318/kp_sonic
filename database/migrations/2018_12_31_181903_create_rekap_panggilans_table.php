<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekapPanggilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_panggilans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('pangkat');
            $table->string('nrp');
            $table->integer('panggilan_terjawab');
            $table->integer('panggilan_tidak_terjawab');
            $table->integer('polres_id')->unsigned();

            $table->foreign('polres_id')->references('id')->on('polres')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('rekap_panggilans');
    }
}
