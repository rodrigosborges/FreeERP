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

    //TODO ajustar a relação com a agenda
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->datetime('data_inicio');
            $table->datetime('data_fim');
            $table->dateTime('notificacao')->nullable();
            $table->boolean('dia_todo')->default(0);
            $table->string('nota')->nullable();
            $table->unsignedBigInteger('calendario_id')->nullable();
            //$table->foreign('calendario_id')->references('id')->on('calendario');
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
