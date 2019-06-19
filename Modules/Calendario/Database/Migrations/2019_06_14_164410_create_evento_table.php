<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->date('data_inicio');
            $table->time('hora_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->time('hora_fim')->nullable();
            $table->dateTime('notificacao')->nullable();
            $table->string('nota')->nullable();
            $table->unsignedBigInteger('calendario_id');
            $table->foreign('calendario_id')->references('id')->on('calendario');
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
        Schema::dropIfExists('evento');
    }
}
