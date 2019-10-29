<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTelefoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('telefone', function(Blueprint $table)
		{
			$table->foreign('tipo_telefone_id', 'fk_telefone_tipo_telefone1')->references('id')->on('tipo_telefone')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('telefone', function(Blueprint $table)
		{
			$table->dropForeign('fk_telefone_tipo_telefone1');
		});
	}

}
