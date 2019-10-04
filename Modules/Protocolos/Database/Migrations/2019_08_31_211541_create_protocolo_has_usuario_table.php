<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocoloHasUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocolo_has_usuario', function (Blueprint $table) {
            $table->integer('protocolo_id');
			$table->integer('usuario_id')->index('fk_protocolo_has_usuario_usuario1');
			$table->primary(['protocolo_id','usuario_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocolo_has_usuario');
    }
}
