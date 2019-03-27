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
			$table->dropForeign('fk_funcionario_estado_civil1');
		});
	}

}
