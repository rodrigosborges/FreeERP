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
			$table->decimal('valor', 9,2);
			$table->date('data_pagamento');
			$table->float('taxa');
			$table->date('data_recebimento');
			$table->text('status_pagamento');
			$table->integer('conta_receber_id')->index('fk_pagamento_receber_conta_receber1');
			$table->integer('forma_pagamento_id')->index('fk_pagamento_receber_forma_pagamento1');
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
		Schema::drop('pagamento_receber');
	}

}
