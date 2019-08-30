<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContaReceberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('conta_receber', function(Blueprint $table)
		{
			$table->foreign('categoria_receber_id', 'fk_conta_receber_categoria_receber1')->references('id')->on('categoria_receber')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('conta_receber', function(Blueprint $table)
		{
			$table->dropForeign('fk_conta_receber_categoria_receber1');
		});
	}

}
