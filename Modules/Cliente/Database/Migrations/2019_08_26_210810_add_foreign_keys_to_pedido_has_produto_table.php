<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPedidoHasProdutoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pedido_has_produto', function(Blueprint $table)
		{
			$table->foreign('pedido_id', 'fk_pedido_has_produto_pedido1')->references('id')->on('pedido')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('produto_id', 'fk_pedido_has_produto_produto1')->references('id')->on('produto')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pedido_has_produto', function(Blueprint $table)
		{
			$table->dropForeign('fk_pedido_has_produto_pedido1');
			$table->dropForeign('fk_pedido_has_produto_produto1');
		});
	}

}
