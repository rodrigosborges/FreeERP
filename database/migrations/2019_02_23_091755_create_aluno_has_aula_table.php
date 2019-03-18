<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoHasAulaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno_has_aula', function(Blueprint $table)
		{
			$table->integer('aluno_id');
			$table->integer('aula_id')->index('fk_aluno_has_aula_aula1');
			$table->primary(['aluno_id','aula_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno_has_aula');
	}

}
