<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCurriculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('curriculo', function (Blueprint $table) {
            
            $table->foreign('vaga_id', 'fk_curriculo_vaga1')->references('id')->on('vaga')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('curriculo', function (Blueprint $table) {
            $table->dropForeign('fk_curriculo_vaga1');
        });
    }
}
