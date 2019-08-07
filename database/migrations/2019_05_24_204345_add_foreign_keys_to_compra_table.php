<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCompraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('compra', function(Blueprint $table)
		{
			$table->foreign('fornecedor_id', 'fk_compra_fornecedor1')->references('id')->on('fornecedor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('orcamento_id', 'fk_compra_orcamento1')->references('id')->on('orcamento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('compra', function(Blueprint $table)
		{
			$table->dropForeign('fk_compra_fornecedor1');
			$table->dropForeign('fk_compra_orcamento1');
		});
	}

}
