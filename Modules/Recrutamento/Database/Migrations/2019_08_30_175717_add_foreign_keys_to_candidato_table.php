<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCandidatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidato', function (Blueprint $table) {
            
            $table->foreign('vaga_id', 'fk_candidato_vaga1')->references('id')->on('vaga')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('endereco_id', 'fk_candidato_endereco1')->references('id')->on('endereco')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('email_id', 'fk_candidato_email1')->references('id')->on('email')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('telefone_id', 'fk_candidato_telefone1')->references('id')->on('telefone')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidato', function (Blueprint $table) {
            $table->dropForeign('fk_candidato_vaga1');
            $table->dropForeign('fk_candidato_endereco1');
            $table->dropForeign('fk_candidato_email1');
            $table->dropForeign('fk_candidato_telefone1');
        });
    }
}
