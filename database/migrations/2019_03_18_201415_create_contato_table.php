<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContatoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contato', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('email', 100);
			$table->integer('funcionario_id')->index('fk_contato_funcionario1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contato');
	}

}
