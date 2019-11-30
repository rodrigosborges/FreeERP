<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToVagaHasBeneficioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vaga_has_beneficio', function (Blueprint $table) {
            $table->foreign('vaga_id', 'fk_vaga_has_beneficio_vaga1')->references('id')->on('vaga')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('beneficio_id', 'fk_vaga_has_beneficio_beneficio1')->references('id')->on('beneficio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vaga_has_beneficio', function (Blueprint $table) {
            $table->dropForeign('fk_vaga_has_beneficio_vaga1');
            $table->dropForeign('fk_vaga_has_beneficio_beneficio1');
        });
    }
}
