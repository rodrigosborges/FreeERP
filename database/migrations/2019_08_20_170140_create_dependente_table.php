<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDependenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dependente', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 100);
			$table->boolean('mora_junto');
			$table->integer('funcionario_id')->index('fk_dependente_funcionario');
			$table->integer('parentesco_id')->index('fk_dependente_parentesco');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dependente');
	}

}
