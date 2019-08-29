<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ferias', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->integer('dias_ferias');
            $table->date('data_pagamento');
            $table->date('data_aviso');
            $table->string('situacao_ferias');
            $table->boolean('pagamento_parcela13');
            $table->string('observacao');
            $table->integer('funcionario_id')->unsigned()->index('fk_ferias_funcionario');
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
        Schema::drop('ferias');
    }
}
