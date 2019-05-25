<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemPedidoHasFornecedorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_pedido_has_fornecedor', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('item_pedido_id')->index('fk_item_pedido_has_fornecedor_item_compra_has_pedido1');
			$table->integer('fornecedor_id')->index('fk_item_pedido_has_fornecedor_fornecedor1');
			$table->dateTime('created_at')->nullable();
			$table->dateTime('update_at')->nullable();
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
		Schema::drop('item_pedido_has_fornecedor');
	}

}
