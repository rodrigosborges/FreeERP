<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToItemCompraHasPedidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('item_compra_has_pedido', function(Blueprint $table)
		{
			$table->foreign('item_compra_id', 'fk_item_compra_has_pedido_item_compra1')->references('id')->on('item_compra')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('pedido_id', 'fk_item_compra_has_pedido_pedido1')->references('id')->on('pedido')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('item_compra_has_pedido', function(Blueprint $table)
		{
			$table->dropForeign('fk_item_compra_has_pedido_item_compra1');
			$table->dropForeign('fk_item_compra_has_pedido_pedido1');
		});
	}

}
