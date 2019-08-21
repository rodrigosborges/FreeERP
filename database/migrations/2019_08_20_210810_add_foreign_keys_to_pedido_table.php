<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPedidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pedido', function(Blueprint $table)
		{
			$table->foreign('cliente_id', 'fk_pedido_cliente1')->references('id')->on('cliente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pedido', function(Blueprint $table)
		{
			$table->dropForeign('fk_pedido_cliente1');
		});
	}

}
