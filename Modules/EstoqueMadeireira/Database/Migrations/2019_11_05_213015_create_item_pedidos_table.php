<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pedido_id')->unsigned()->index('fk_itemPedido_pedido');
            $table->integer('produto_id')->unsigned()->index('fk_itemPedido_produto');
            $table->decimal('quantidade', 12,2);
            $table->decimal('precoCusto', 12,2);
            $table->decimal('precoVenda', 12,2);
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
        Schema::dropIfExists('item_pedidos');
    }
}
