<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cliente', function(Blueprint $table)
		{
			$table->foreign('tipo_cliente_id', 'fk_cliente_tipo_cliente1')->references('id')->on('tipo_cliente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cliente', function(Blueprint $table)
		{
			$table->dropForeign('fk_cliente_tipo_cliente1');
		});
	}

}
