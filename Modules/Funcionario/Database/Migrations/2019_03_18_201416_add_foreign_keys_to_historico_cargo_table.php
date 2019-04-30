<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHistoricoCargoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('historico_cargo', function(Blueprint $table)
		{
			$table->foreign('cargo_id', 'fk_historico_cargo_cargo1')->references('id')->on('cargo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('funcionario_id', 'fk_historico_cargo_funcionario1')->references('id')->on('funcionario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('historico_cargo', function(Blueprint $table)
		{
			$table->dropForeign('fk_historico_cargo_cargo1');
			$table->dropForeign('fk_historico_cargo_funcionario1');
		});
	}

}
