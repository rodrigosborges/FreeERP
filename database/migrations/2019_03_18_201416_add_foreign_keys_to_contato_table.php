<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContatoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contato', function(Blueprint $table)
		{
			$table->foreign('funcionario_id', 'fk_contato_funcionario1')->references('id')->on('funcionario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contato', function(Blueprint $table)
		{
			$table->dropForeign('fk_contato_funcionario1');
		});
	}

}
