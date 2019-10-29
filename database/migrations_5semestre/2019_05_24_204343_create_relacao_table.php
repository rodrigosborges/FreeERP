<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('relacao', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('tabela_origem', 40);
			$table->integer('origem_id');
			$table->string('tabela_destino', 40);
			$table->integer('destino_id');
			$table->string('modelo', 40);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('relacao');
	}

}
