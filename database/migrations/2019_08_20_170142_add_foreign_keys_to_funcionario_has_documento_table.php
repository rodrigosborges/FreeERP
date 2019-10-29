<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFuncionarioHasDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('funcionario_has_documento', function(Blueprint $table)
		{
			$table->foreign('documento_id', 'fk_funcionario_has_documento_documento1')->references('id')->on('documento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('funcionario_id', 'fk_funcionario_has_documento_funcionario1')->references('id')->on('funcionario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('funcionario_has_documento', function(Blueprint $table)
		{
			$table->dropForeign('fk_funcionario_has_documento_documento1');
			$table->dropForeign('fk_funcionario_has_documento_funcionario1');
		});
	}

}
