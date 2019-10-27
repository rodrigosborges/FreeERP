<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocoloHasApensadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocolo_has_apensado', function (Blueprint $table) {
            $table->integer('protocolo_id');
			$table->integer('apensado_id')->index('fk_protocolo_has_apensado_apensado1');
			$table->primary(['protocolo_id','apensado_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocolo_has_apensado');
    }
}
