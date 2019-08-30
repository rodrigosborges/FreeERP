<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFuncionarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('funcionario', function(Blueprint $table)
		{
			$table->foreign('email_id', 'fk_funcionario_email1')->references('id')->on('email')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('endereco_id', 'fk_funcionario_endereco1')->references('id')->on('endereco')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('estado_civil_id', 'fk_funcionario_estado_civil1')->references('id')->on('estado_civil')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('funcionario', function(Blueprint $table)
		{
			$table->dropForeign('fk_funcionario_email1');
			$table->dropForeign('fk_funcionario_endereco1');
			$table->dropForeign('fk_funcionario_estado_civil1');
		});
	}

}
