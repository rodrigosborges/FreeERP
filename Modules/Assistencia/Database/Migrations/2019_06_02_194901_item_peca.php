<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemPeca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  
          Schema::table('item_peca_assistencia', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('idPeca')->unsigned();
              $table->integer('idConserto')->unsigned();
              $table->integer('quantidade');
              $table->foreign('idPeca')->references('id')->on('peca_assistencia');
              $table->foreign('idConserto')->references('id')->on('conserto_assistencia');
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
    }
}
