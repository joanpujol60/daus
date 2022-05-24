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
        Schema::create('jugadors', function (Blueprint $table){
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->char('email',100);
            $table->char('password',100);
            $table->char('nickname',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the, migrations.
     * @return void
     */
    public function down()
    {
        //
    }
};
