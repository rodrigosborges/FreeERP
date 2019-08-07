<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemCompraHasPedidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_compra_has_pedido', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('item_compra_id')->index('fk_item_compra_has_pedido_item_compra1');
			$table->integer('pedido_id')->index('fk_item_compra_has_pedido_pedido1');
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
		Schema::drop('item_compra_has_pedido');
	}

}
