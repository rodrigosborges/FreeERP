<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SolicitanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitante', function(Blueprint $table)
		{
            $table->increments('id');
            $table->bigInteger('identificacao')->unique();
            $table->string('nome');
            $table->string('email');
            $table->integer('endereco_id')->unsigned();
            $table->foreign('endereco_id')->references('id')->on('endereco');
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
		Schema::drop('solicitante');
    }
}
