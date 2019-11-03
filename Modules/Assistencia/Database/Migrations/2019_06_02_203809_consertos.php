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
          $table->integer('numeroOrdem');
          $table->decimal('valor', 6,2);
          $table->string('data_entrada');
          $table->string('situacao');
          $table->string('modelo_aparelho');
          $table->string('marca_aparelho');
          $table->string('serial_aparelho');
          $table->string('imei_aparelho');
          $table->text('defeito');
          $table->text('obs');
          $table->decimal('sinal', 6,2)->nullable();
          $table->integer('idCliente')->unsigned();
          $table->integer('idTecnico')->unsigned();
          $table->foreign('idCliente')->references('id')->on('cliente_assistencia')->onDelete('cascade');
          $table->foreign('idTecnico')->references('id')->on('tecnico_assistencia')->onDelete('cascade');
          $table->timestamps();
          $table->softDeletes();
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
