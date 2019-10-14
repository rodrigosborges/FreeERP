<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatoHasEtapaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidato_has_etapa', function (Blueprint $table) {
            $table->integer('id', true);
			$table->integer('candidato_id')->index('fk_candidato_has_etapa_candidato1');
            $table->integer('etapa_id')->index('fk_candidato_has_etapa_pedido1');
            $table->integer('nota');
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
        Schema::drop('candidato_has_etapa');
    }
}
