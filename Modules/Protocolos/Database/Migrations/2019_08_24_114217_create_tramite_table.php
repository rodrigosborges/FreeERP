<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramite', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('legenda', 60);
            $table->text('despacho');
            $table->integer('funcionario_id')->index('fk_tramite_funcionario');
            $table->integer('protocolo_id')->index('fk_tramite_protocolo');
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
        Schema::dropIfExists('tramite');
    }
}
