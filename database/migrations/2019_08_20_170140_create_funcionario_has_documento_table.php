<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuncionarioHasDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funcionario_has_documento', function(Blueprint $table)
		{
			$table->integer('funcionario_id');
			$table->integer('documento_id')->index('fk_funcionario_has_documento_documento1');
			$table->primary(['funcionario_id','documento_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('funcionario_has_documento');
	}

}
