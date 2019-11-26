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
			$table->foreign('documento_id', 'fk_cliente_documento1')->references('id')->on('documento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('email_id', 'fk_cliente_email1')->references('id')->on('email')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('endereco_id', 'fk_cliente_endereco1')->references('id')->on('endereco')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign('fk_cliente_documento1');
			$table->dropForeign('fk_cliente_email1');
			$table->dropForeign('fk_cliente_endereco1');
			$table->dropForeign('fk_cliente_tipo_cliente1');
		});
	}

}
