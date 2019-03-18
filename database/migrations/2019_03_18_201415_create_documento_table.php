<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documento', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('tipo');
			$table->string('numero', 45);
			$table->integer('funcionario_id')->index('fk_documento_funcionario1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documento');
	}

}
