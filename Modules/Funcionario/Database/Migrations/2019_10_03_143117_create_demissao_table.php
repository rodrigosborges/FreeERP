<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demissao', function (Blueprint $table) {
            $table->integer('id');
            $table->date('data_demissao');
            $table->date('data_pagamento');
            $table->integer('funcionario_id')->index('fk_demissao_funcionario');
            $table->integer('tipo_demissao_id')->index('fk_demissao_tipo_demissao');
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
        Schema::dropIfExists('demissao');
    }
}
