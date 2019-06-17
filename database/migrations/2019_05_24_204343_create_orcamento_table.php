<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrcamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orcamento', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('fornecedor_id')->index('fk_orcamento_fornecedor1');
			$table->float('valor_total');
			$table->dateTime('created_at')->nullable();
			$table->dateTime('update_at')->nullable();
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
		Schema::drop('orcamento');
	}

}
