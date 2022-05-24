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
        //
        Schema::create('jugades', function (Blueprint $table){
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_jugador')->unsigned();
            $table->integer('dau1');
            $table->integer('dau2');
            $table->timestamps();
            $table->foreign('id_jugador')->references('id')->on('jugadors')->onDelete("cascade");
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
    }
};
