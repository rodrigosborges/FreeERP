<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidato', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nome');
            $table->string('curriculo');
            $table->string('foto');
            $table->integer('vaga_id')->index('fk_candidato_vaga1');
            $table->integer('endereco_id')->index('fk_candidato_endereco1');
            $table->integer('telefone_id')->index('fk_candidato_telefone1');
            $table->integer('email_id')->index('fk_candidato_email1');
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
        Schema::drop('candidato');
    }
}
