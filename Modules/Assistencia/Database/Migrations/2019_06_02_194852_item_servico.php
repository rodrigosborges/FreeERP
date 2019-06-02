<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemServico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('item_servico_assistencia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMaoObra')->unsigned();
            $table->integer('quantidade');
            $table->foreign('idMaoObra')->references('id')->on('servico_assistencia');
            $table->integer('idConserto')->unsigned();
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
