<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vaga_id');
            $table->string('nome');
            $table->string('email');
            $table->string('formacao');
            $table->string('endereco');
            $table->string('telefone');
            $table->string('experiencia');
            $table->softDeletes();
            $table->timestamps();

            //chave estrangeira
            $table->foreign('vaga_id')->references('id')->on('vaga');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculo');
    }
}
