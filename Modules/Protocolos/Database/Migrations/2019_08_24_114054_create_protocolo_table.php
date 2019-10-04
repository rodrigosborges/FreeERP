<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocoloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocolo', function (Blueprint $table) {
            $table->integer('id', true);
			$table->string('assunto',200);
			$table->integer('tipo_protocolo_id')->index('fk_protocolo_tipo_protocolo1');
            $table->integer('tipo_acesso_id')->index('fk_protocolo_tipo_acesso1');
            $table->integer('usuario_id')->index('fk_protocolo_usuario1');
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
        Schema::dropIfExists('protocolo');
    }
}
