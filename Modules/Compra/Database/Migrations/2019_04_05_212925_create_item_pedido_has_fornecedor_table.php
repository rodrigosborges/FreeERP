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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_pedido_id');
            $table->unsignedBigInteger('fornecedor_id');
            
            //referencia chave estrangeira
            $table->foreign('item_pedido_id')->references('id')->on('item_compra_has_pedido');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedor');


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
