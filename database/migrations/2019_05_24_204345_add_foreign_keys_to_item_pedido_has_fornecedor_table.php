<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToItemPedidoHasFornecedorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('item_pedido_has_fornecedor', function(Blueprint $table)
		{
			$table->foreign('fornecedor_id', 'fk_item_pedido_has_fornecedor_fornecedor1')->references('id')->on('fornecedor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('item_pedido_id', 'fk_item_pedido_has_fornecedor_item_compra_has_pedido1')->references('id')->on('item_compra_has_pedido')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('item_pedido_has_fornecedor', function(Blueprint $table)
		{
			$table->dropForeign('fk_item_pedido_has_fornecedor_fornecedor1');
			$table->dropForeign('fk_item_pedido_has_fornecedor_item_compra_has_pedido1');
		});
	}

}
