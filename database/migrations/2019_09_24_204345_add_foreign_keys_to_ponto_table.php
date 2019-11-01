<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPontoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ponto', function(Blueprint $table)
		{
			$table->foreign('funcionario_id', 'fk_ponto_funcionario')->references('id')->on('funcionario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ponto', function(Blueprint $table)
		{
			$table->dropForeign('fk_ponto_funcionario');
		});
	}

}
