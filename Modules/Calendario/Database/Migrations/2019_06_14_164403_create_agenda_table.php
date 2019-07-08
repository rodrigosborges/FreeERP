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
            $table->string('titulo');
            $table->string('descricao')->nullable();
            $table->string('cor', 6)->nullable();
            $table->unsignedBigInteger('funcionario_id')->nullable();
            //$table->foreign('funcionario_id')->references('id')->on('funcionario');
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
