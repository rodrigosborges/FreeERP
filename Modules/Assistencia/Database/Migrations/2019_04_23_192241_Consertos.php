<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Consertos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('conserto_assistencia', function (Blueprint $table) {
          $table->increments('id');
          $table->string('modelo_aparelho');
          $table->string('marca_aparelho');
          $table->string('serial_aparelho');
          $table->string('imei_aparelho');
          $table->text('defeito');
          $table->text('obs');
          $table->integer('cliente_id')->unsigned();
          $table->integer('peca_id')->unsigned();
          $table->integer('servico_id')->unsigned();
          $table->foreign('cliente_id')->references('id')->on('cliente_assistencia');
          $table->foreign('peca_id')->references('id')->on('peca_assistencia');
          $table->foreign('servico_id')->references('id')->on('servico_assistencia');
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
