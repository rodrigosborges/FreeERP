<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContaPagarTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('conta_pagar', function(Blueprint $table)
		{
			$table->foreign('categoria_pagar_id', 'fk_conta_pagar_categoria_pagar1')->references('id')->on('categoria_pagar')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('conta_pagar', function(Blueprint $table)
		{
			$table->dropForeign('fk_conta_pagar_categoria_pagar1');
		});
	}

}
