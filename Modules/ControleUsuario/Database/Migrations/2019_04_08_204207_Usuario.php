<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table){
            $table->increments('id');
            $table->string('foto');
            $table->string('nome');
            $table->string('email');
            $table->string('senha');
            $table->timestamps();
            $table->softDeletes();

            $table->integer('autenticacao_id')->unsigned();
            $table->foreign(['autenticacao_id'])->references('id')->on('autenticacao');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
