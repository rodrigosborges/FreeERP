<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEnderecoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('endereco', function(Blueprint $table)
		{
			$table->foreign('aluno_id', 'fk_endereco_aluno1')->references('id')->on('aluno')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('endereco', function(Blueprint $table)
		{
			$table->dropForeign('fk_endereco_aluno1');
		});
	}

}
