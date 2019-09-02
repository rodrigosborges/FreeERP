<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocoloHasInteressadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocolo_has_interessado', function (Blueprint $table) {
            $table->integer('protocolo_id');
			$table->integer('interessado_id')->index('fk_protocolo_has_interessado_interessado1');
			$table->primary(['protocolo_id','interessado_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocolo_has_interessado');
    }
}
