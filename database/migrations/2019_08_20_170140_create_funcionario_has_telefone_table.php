<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuncionarioHasTelefoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funcionario_has_telefone', function(Blueprint $table)
		{
			$table->integer('funcionario_id');
			$table->integer('telefone_id')->index('fk_funcionario_has_telefone_telefone1');
			$table->primary(['funcionario_id','telefone_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('funcionario_has_telefone');
	}

}
