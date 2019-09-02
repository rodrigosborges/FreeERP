<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToEntrevistaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrevista', function (Blueprint $table) {
            $table->foreign('candidato_id', 'fk_entrevista_candidato1')->references('id')->on('candidato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrevista', function (Blueprint $table) {
            $table->dropForeign('fk_entrevista_candidato1');
        });
    }
}
