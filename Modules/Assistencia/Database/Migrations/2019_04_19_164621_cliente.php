<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('clientes', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nome');
          $table->string('cpf');
          $table->string('email');
          $table->string('data_nascimento');
          $table->string('sexo');
          $table->string('celnumero');
          $table->string('telefonenumero');
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
        Schema::drop('clientes');
    }
}
