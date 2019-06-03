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
          $table->integer('numero');
          $table->decimal('valor', 6,2);
          $table->string('data_entrada');
          $table->string('situacao');
          $table->string('modelo_aparelho');
          $table->string('marca_aparelho');
          $table->string('serial_aparelho');
          $table->string('imei_aparelho');
          $table->text('defeito');
          $table->text('obs');

          $table->integer('idCliente')->unsigned();
          $table->integer('idTecnico')->unsigned();
<<<<<<< HEAD:Modules/Assistencia/Database/Migrations/2019_06_02_203809_consertos.php
          $table->integer('idPeca')->unsigned();
          $table->integer('idMaoObra')->unsigned();

          $table->foreign('idCliente')->references('id')->on('cliente_assistencia');
          $table->foreign('idTecnico')->references('id')->on('tecnico_assistencia');
          $table->foreign('idPeca')->references('id')->on('item_peca_assistencia');
          $table->foreign('idMaoObra')->references('id')->on('item_servico_assistencia');

=======

          $table->integer('idPeca')->unsigned(); // vai receber um array aqui bro
          $table->integer('idMaoObra')->unsigned(); // vai receber um array aqui bro

          $table->foreign('idCliente')->references('id')->on('cliente_assistencia');
          $table->foreign('idTecnico')->references('id')->on('tecnico_assistencia');

          $table->foreign('idPeca')->references('id')->on('peca_assistencia'); // vai receber um array aqui bro
          $table->foreign('idMaoObra')->references('id')->on('servico_assistencia'); // vai receber um array aqui bro
>>>>>>> 2f95fd17cdc24aa54391a3b05ffcf855608ac1c4:Modules/Assistencia/Database/Migrations/2019_05_07_211406_Consertos.php
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
