<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPagamentoContaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pagamento_conta', function(Blueprint $table)
		{
			$table->foreign('conta_pagar_id', 'fk_pagamento_conta_conta_pagar1')->references('id')->on('conta_pagar')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pagamento_conta', function(Blueprint $table)
		{
			$table->dropForeign('fk_pagamento_conta_conta_pagar1');
		});
	}

}
