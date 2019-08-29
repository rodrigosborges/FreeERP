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
			$table->text('assunto');
			$table->integer('funcionario_id')->index('fk_protocolo_funcionario');
			$table->integer('tipo_protocolo_id')->index('fk_protocolo_tipo_protocolo');
			$table->integer('tipo_acesso_id')->index('fk_protocolo_tipo_acesso');
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
