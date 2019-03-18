<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunoHasAulaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('aluno_has_aula', function(Blueprint $table)
		{
			$table->foreign('aluno_id', 'fk_aluno_has_aula_aluno')->references('id')->on('aluno')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('aula_id', 'fk_aluno_has_aula_aula1')->references('id')->on('aula')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('aluno_has_aula', function(Blueprint $table)
		{
			$table->dropForeign('fk_aluno_has_aula_aluno');
			$table->dropForeign('fk_aluno_has_aula_aula1');
		});
	}

}
