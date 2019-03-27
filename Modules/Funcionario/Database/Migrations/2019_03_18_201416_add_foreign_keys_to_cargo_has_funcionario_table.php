<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCargoHasFuncionarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cargo_has_funcionario', function(Blueprint $table)
		{
			$table->foreign('cargo_id', 'fk_cargo_has_funcionario_cargo1')->references('id')->on('cargo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('funcionario_id', 'fk_cargo_has_funcionario_funcionario1')->references('id')->on('funcionario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cargo_has_funcionario', function(Blueprint $table)
		{
			$table->dropForeign('fk_cargo_has_funcionario_cargo1');
			$table->dropForeign('fk_cargo_has_funcionario_funcionario1');
		});
	}

}
