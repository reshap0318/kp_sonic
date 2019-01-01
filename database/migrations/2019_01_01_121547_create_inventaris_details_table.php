<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarisDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode');
            $table->integer('kondisi');
            $table->integer('inventaris_id')->unsigned();

            $table->foreign('inventaris_id')->references('id')->on('inventaris')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('inventaris_details');
    }
}
