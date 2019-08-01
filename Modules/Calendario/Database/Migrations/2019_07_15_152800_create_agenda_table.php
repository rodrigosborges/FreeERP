<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //TODO ajustar a relação com o criador

    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo', 100);
            $table->string('descricao', 500)->nullable();
            $table->unsignedBigInteger('cor_id');
            $table->unsignedBigInteger('funcionario_id');
            $table->unsignedBigInteger('setor_id')-> nullable();
            $table->foreign('cor_id')->references('id')->on('cor');
            $table->foreign('setor_id')->references('id')->on('setor');
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
        Schema::dropIfExists('agenda');
    }
}
