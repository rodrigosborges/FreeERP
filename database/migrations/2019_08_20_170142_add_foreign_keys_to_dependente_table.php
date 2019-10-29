<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDependenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dependente', function(Blueprint $table)
		{
			$table->foreign('funcionario_id', 'fk_dependente_funcionario')->references('id')->on('funcionario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('parentesco_id', 'fk_dependente_parentesco')->references('id')->on('parentesco')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dependente', function(Blueprint $table)
		{
			$table->dropForeign('fk_dependente_funcionario');
			$table->dropForeign('fk_dependente_parentesco');
		});
	}

}
