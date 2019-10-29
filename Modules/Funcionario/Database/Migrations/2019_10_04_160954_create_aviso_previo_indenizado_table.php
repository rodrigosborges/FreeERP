<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisoPrevioIndenizadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aviso_previo_indenizado', function (Blueprint $table) {
            $table->increments('id', true);
            $table->date('data_inicio_aviso');
            $table->integer('dias_aviso_indenizado');
            $table->string('tipo_reducao_aviso');
            $table->integer('aviso_previo_id')->index('fk_aviso_previo_indenizado_aviso_previo');
            $table->integer('aviso_previo_indicador_cumprimento_id')->index('fk_aviso_previo_indenizado_aviso_previo_indicador_cumprimento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aviso_previo_indenizado');
    }
}
