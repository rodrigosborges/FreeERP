<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPedidoHasFornecedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pedido_has_fornecedor', function (Blueprint $table) {
            $table->unsignedBigInteger('item_compra_id');
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('fornecedor_id');
            
            //referencia chave estrangeira
            $table->foreign('item_compra_id')->references('item_compra_id')->on('item_compra_has_pedido');
            $table->foreign('pedido_id')->references('pedido_id')->on('item_compra_has_pedido');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedor');

            //chave composta
            $table->primary(['item_compra_id','pedido_id','fornecedor_id']);

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
        Schema::dropIfExists('item_compra_has_pedido_has_fornecedor');
    }
}
