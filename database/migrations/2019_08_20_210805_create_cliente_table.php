<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliente', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 100);
			$table->integer('documento_id')->index('fk_cliente_documento1');
			$table->integer('endereco_id')->index('fk_cliente_endereco1');
			$table->integer('email_id')->index('fk_cliente_email1');
			$table->integer('tipo_cliente_id')->index('fk_cliente_tipo_cliente1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cliente');
	}

}
