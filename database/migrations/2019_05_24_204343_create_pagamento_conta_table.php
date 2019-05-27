<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagamentoContaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagamento_conta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('numero_parcela', 45);
			$table->date('data_vencimento');
			$table->decimal('valor', 9);
			$table->date('data_pagamento');
			$table->decimal('juros', 9);
			$table->decimal('multa', 9);
			$table->string('status_pagamento', 45);
			$table->integer('conta_pagar_id')->index('fk_pagamento_conta_conta_pagar1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pagamento_conta');
	}

}
