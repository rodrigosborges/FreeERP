<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteHasTelefoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliente_has_telefone', function(Blueprint $table)
		{
			$table->integer('cliente_id');
			$table->integer('telefone_id')->index('fk_cliente_has_telefone_telefone1');
			$table->primary(['cliente_id','telefone_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cliente_has_telefone');
	}

}
