<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MovimentacaoEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('movimentacao_estoque', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data');
            $table->tinyInteger('entrada');
            $table->integer('estoque_id')->unsigned()->index('fk_estoque_pai');
            $table->decimal('preco_custo')->nullable();
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
        //
        Schema::dropIfExists('movimentacao_estoque');
    }
}
