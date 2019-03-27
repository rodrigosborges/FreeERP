<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documento', function(Blueprint $table)
		{
			$table->foreign('funcionario_id', 'fk_documento_funcionario1')->references('id')->on('funcionario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('documento', function(Blueprint $table)
		{
			$table->dropForeign('fk_documento_funcionario1');
		});
	}

}
