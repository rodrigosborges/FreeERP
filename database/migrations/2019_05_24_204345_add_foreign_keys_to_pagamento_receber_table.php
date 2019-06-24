<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPagamentoReceberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pagamento_receber', function(Blueprint $table)
		{
			$table->foreign('conta_receber_id', 'fk_pagamento_receber_conta_receber1')->references('id')->on('conta_receber')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('forma_pagamento_id', 'fk_pagamento_receber_forma_pagamento1')->references('id')->on('forma_pagamento_receber')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pagamento_receber', function(Blueprint $table)
		{
			$table->dropForeign('fk_pagamento_receber_conta_receber1');
			$table->dropForeign('fk_pagamento_receber_forma_pagamento1');
		});
	}

}
