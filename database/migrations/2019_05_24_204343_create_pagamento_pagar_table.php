<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagamentoPagarTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagamento_pagar', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('data_vencimento');
			$table->decimal('valor', 9,2);
			$table->date('data_pagamento');
			$table->decimal('juros',9,2);
			$table->decimal('multa',9,2);
			$table->text('status_pagamento');
			$table->integer('conta_pagar_id')->index('fk_pagamento_pagar_conta_pagar1');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pagamento_pagar');
	}

}
