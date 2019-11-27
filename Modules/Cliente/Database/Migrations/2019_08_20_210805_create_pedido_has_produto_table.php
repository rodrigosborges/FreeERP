<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidoHasProdutoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedido_has_produto', function(Blueprint $table)
		{
			$table->integer('pedido_id');
			$table->integer('produto_id');
			$table->integer('quantidade');
			$table->float('desconto', 10, 0)->nullable();
			$table->primary(['pedido_id','produto_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pedido_has_produto');
	}

}
