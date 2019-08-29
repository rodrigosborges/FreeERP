<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteressadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interessado', function (Blueprint $table) {
            $table->integer('protocolo_id')->index('fk_interessado_protocolo');
            $table->integer('funcionario_id')->index('fk_interessado_funcionario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interessado');
    }
}
