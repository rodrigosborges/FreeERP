<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClienteHasTelefoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cliente_has_telefone', function(Blueprint $table)
		{
			$table->foreign('cliente_id', 'fk_cliente_has_telefone_cliente1')->references('id')->on('cliente')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('telefone_id', 'fk_cliente_has_telefone_telefone1')->references('id')->on('telefone')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cliente_has_telefone', function(Blueprint $table)
		{
			$table->dropForeign('fk_cliente_has_telefone_cliente1');
			$table->dropForeign('fk_cliente_has_telefone_telefone1');
		});
	}

}
