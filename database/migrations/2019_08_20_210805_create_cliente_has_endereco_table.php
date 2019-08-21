<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteHasEnderecoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliente_has_endereco', function(Blueprint $table)
		{
			$table->integer('cliente_id');
			$table->integer('endereco_id')->index('fk_cliente_has_endereco_endereco1');
			$table->primary(['cliente_id','endereco_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cliente_has_endereco');
	}

}
