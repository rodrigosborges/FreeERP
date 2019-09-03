<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nome');
            $table->string('area_atuacao');
            $table->integer('duracao_horas_curso');
            $table->date('data_realizacao');
            $table->string('validade_curso');
            $table->integer('funcionario_id')->index('fk_curso_funcionario');
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
        Schema::dropIfExists('curso');
    }
}
