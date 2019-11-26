<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoHasParticipante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_has_participante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('programacao_id');
            $table->foreign('programacao_id')->references('id')->on('programacao')->onDelete('CASCADE');
            $table->unsignedInteger('pessoa_id');
            $table->foreign('pessoa_id')->references('id')->on('pessoa')->onDelete('CASCADE');
            $table->boolean('faltou')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento_has_participante');
    }
}
