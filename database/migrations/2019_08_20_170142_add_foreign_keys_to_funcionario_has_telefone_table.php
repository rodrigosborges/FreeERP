<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFuncionarioHasTelefoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('funcionario_has_telefone', function(Blueprint $table)
		{
			$table->foreign('funcionario_id', 'fk_funcionario_has_telefone_funcionario1')->references('id')->on('funcionario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('telefone_id', 'fk_funcionario_has_telefone_telefone1')->references('id')->on('telefone')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('funcionario_has_telefone', function(Blueprint $table)
		{
			$table->dropForeign('fk_funcionario_has_telefone_funcionario1');
			$table->dropForeign('fk_funcionario_has_telefone_telefone1');
		});
	}

}
