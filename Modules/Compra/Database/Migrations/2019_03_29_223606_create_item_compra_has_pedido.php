<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCompraHasPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_compra_has_pedido', function (Blueprint $table) {
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('item_compra_id');

            //referencia chave estrangeira
            $table->foreign('item_compra_id')->references('id')->on('item_compra');
            $table->foreign('pedido_id')->references('id')->on('pedido');

            //chave composta
            $table->primary(['pedido_id','item_compra_id']);

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
        Schema::dropIfExists('item_compra_has_pedido');
    }
}
