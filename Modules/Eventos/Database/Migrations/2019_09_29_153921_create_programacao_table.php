<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programacao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('tipo');
            $table->string('descricao')->nullable();
            $table->date('data');
            $table->time('horario');
            $table->time('duracao');
            $table->string('local');
            $table->integer('vagas');
            $table->integer('evento_id')->unsigned();
            $table->foreign('evento_id')->references('id')->on('evento')->onDelete('CASCADE');
            $table->integer('palestrante_id')->unsigned();
            $table->foreign('palestrante_id')->references('id')->on('palestrante')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programacao');
    }
}
