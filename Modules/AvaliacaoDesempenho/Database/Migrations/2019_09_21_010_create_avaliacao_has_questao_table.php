<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacaoHasQuestaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacao_has_questao', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('avaliacao_id');
            $table->integer('questao_id');
            $table->timestamps();

            $table->foreign('avaliacao_id')->references('id')->on('avaliacao')->onDelete('restrict');
            $table->foreign('questao_id')->references('id')->on('questao')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliacao_has_questao');
    }
}
