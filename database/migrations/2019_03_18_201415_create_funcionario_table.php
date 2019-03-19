<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuncionarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funcionario', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome');
			$table->date('data_nascimento');
			$table->integer('estado_civil_id')->index('fk_funcionario_estado_civil1');
			$table->integer('cargo_id');
			$table->boolean('sexo');
			$table->date('data_admissao');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('funcionario');
	}

}
