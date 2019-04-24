<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Concertos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('concerto', function (Blueprint $table) {
          $table->increments('id');
          $table->string('modelo_aparelho');
          $table->string('marca_aparelho');
          $table->string('serial_aparelho');
          $table->string('imei_aparelho');
          $table->foreign('cliente_id')->references('id')->on('cliente');
          $table->foreign('peca_id')->references('id')->on('peca');
          $table->foreign('servico_id')->references('id')->on('servico');
          /*$table->string('cliente_id');
          $table->string('peca_id');
          $table->string('servico_id');*/
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
