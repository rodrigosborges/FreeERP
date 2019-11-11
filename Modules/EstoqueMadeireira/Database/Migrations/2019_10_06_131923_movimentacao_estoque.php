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
            $table->integer('estoque_id')->unsigned()->index('fk_estoque_pai');
            $table->decimal('preco_custo', 12,2)->nullable();
            $table->string('observacao', 256);
            $table->integer('quantidade');
            $table->softDeletes();
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
        Schema::dropIfExists('movimentacao_estoque');
    }
}
