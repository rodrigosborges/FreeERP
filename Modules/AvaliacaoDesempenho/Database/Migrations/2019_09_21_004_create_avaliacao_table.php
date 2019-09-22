<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacao', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('processo_id');
            $table->integer('funcionario_id');
            $table->integer('setor_id');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('processo_id')->references('id')->on('processo')->onDelete('restrict');
            $table->foreign('funcionario_id')->references('id')->on('funcionario')->onDelete('restrict');
            $table->foreign('setor_id')->references('id')->on('setor')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliacao');
    }
}
