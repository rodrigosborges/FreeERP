<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagamentoReceberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagamento_receber', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('numero_parcela');
			$table->date('data_vencimento');
			$table->decimal('valor', 9);
			$table->date('data_pagamento');
			$table->decimal('juros', 9);
			$table->decimal('multa', 9);
			$table->float('taxa', 10, 0);
			$table->date('data_recebimento');
			$table->string('status_recebimento', 45);
			$table->integer('conta_receber_id')->unsigned()->index('fk_pagamento_receber_conta_receber1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pagamento_receber');
	}

}
