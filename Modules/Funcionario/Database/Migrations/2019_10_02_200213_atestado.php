<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Atestado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atestado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cid_atestado');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->integer('quantidade_dias');
            $table->integer('funcionario_id')->index('fk_funcionario');
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
        Schema::drop('atestado');
    }
}
