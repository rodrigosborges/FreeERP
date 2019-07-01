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
            $table->integer('id');
            $table->string('nome');
            $table->string('email');
            $table->string('formacao');
            $table->string('endereco');
            $table->string('telefone');
            $table->string('experiencia');
            $table->integer('vaga_id')->index('fk_curriculo_vaga1');
            $table->softDeletes();
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
        Schema::drop('curriculo');
    }
}
