<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClienteHasEnderecoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cliente_has_endereco', function(Blueprint $table)
		{
			$table->foreign('cliente_id', 'fk_cliente_has_endereco_cliente1')->references('id')->on('cliente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('endereco_id', 'fk_cliente_has_endereco_endereco1')->references('id')->on('endereco')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cliente_has_endereco', function(Blueprint $table)
		{
			$table->dropForeign('fk_cliente_has_endereco_cliente1');
			$table->dropForeign('fk_cliente_has_endereco_endereco1');
		});
	}

}
