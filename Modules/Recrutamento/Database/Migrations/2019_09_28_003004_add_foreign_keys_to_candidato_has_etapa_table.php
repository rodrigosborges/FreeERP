<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCandidatoHasEtapaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidato_has_etapa', function (Blueprint $table) {
            $table->foreign('candidato_id', 'fk_candidato_has_etapa_candidato1')->references('id')->on('candidato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('etapa_id', 'fk_candidato_has_etapa_etapa1')->references('id')->on('etapa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidato_has_etapa', function (Blueprint $table) {
            $table->dropForeign('fk_candidato_has_etapa_candidato1');
            $table->dropForeign('fk_candidato_has_etapa_etapa1');
        });
    }
}
