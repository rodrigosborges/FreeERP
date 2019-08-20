<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCidadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cidade', function(Blueprint $table)
		{
			$table->foreign('estado_id', 'fk_cidade_estado')->references('id')->on('estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cidade', function(Blueprint $table)
		{
			$table->dropForeign('fk_cidade_estado');
		});
	}

}
