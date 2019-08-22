<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOrcamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orcamento', function(Blueprint $table)
		{
			$table->foreign('fornecedor_id', 'fk_orcamento_fornecedor1')->references('id')->on('fornecedor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orcamento', function(Blueprint $table)
		{
			$table->dropForeign('fk_orcamento_fornecedor1');
		});
	}

}
