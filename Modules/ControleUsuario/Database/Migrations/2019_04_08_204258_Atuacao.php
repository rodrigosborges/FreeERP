<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Atuacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atuacao', function (Blueprint $table){
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('papel_id')->unsigned();
            $table->integer('modulo_id')->unsigned();

            //referencia chave estrangeira
            $table->foreign('usuario_id')->references('id')->on('usuario');
            $table->foreign('papel_id')->references('id')->on('papel');
            $table->foreign('modulo_id')->references('id')->on('modulo');         
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
        Schema::dropIfExists('atuacao');
    }
}
