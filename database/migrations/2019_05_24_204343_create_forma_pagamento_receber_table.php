<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormaPagamentoReceberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forma_pagamento_receber', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 100);
			$table->float('taxa');
			$table->integer('prazo_recebimento');
			$table->rememberToken();
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
		Schema::drop('forma_pagamento_receber');
	}

}
