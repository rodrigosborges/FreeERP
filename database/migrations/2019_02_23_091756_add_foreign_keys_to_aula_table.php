<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAulaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('aula', function(Blueprint $table)
		{
			$table->foreign('professor_id', 'fk_aula_professor1')->references('id')->on('professor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('aula', function(Blueprint $table)
		{
			$table->dropForeign('fk_aula_professor1');
		});
	}

}
