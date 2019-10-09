<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisoPrevioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aviso_previo', function (Blueprint $table) {
            $table->increments('id', true);
            $table->boolean('aviso_previo_indenizado');
            $table->boolean('descontar_aviso_previo');
            $table->integer('funcionario_id')->index('fk_aviso_previo_funcionario'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aviso_previo');
    }
}