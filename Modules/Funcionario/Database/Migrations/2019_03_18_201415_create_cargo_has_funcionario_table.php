<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCargoHasFuncionarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cargo_has_funcionario', function(Blueprint $table)
		{
			$table->integer('cargo_id');
			$table->integer('funcionario_id')->index('fk_cargo_has_funcionario_funcionario1');
			$table->primary(['cargo_id','funcionario_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cargo_has_funcionario');
	}

}
