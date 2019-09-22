<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultadoGestorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultado_gestor', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('avaliado_id');
            $table->timestamps();

            $table->foreign('avaliado_id')->references('id')->on('avaliado')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultado_gestor');
    }
}
