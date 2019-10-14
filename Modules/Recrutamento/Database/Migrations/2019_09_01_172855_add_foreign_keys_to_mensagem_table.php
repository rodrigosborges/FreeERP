<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToMensagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mensagem', function (Blueprint $table) {
            $table->foreign('candidato_id', 'fk_mensagem_candidato1')->references('id')->on('candidato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mensagem', function (Blueprint $table) {
            $table->dropForeign('fk_mensagem_candidato1');
        });
    }
}
