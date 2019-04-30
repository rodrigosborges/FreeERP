<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistoricoCargoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('historico_cargo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cargo_id');
			$table->integer('funcionario_id');
			$table->date('data_entrada');
			$table->date('data_saida')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('historico_cargo');
	}

}
