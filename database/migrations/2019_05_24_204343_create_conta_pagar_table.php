<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContaPagarTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conta_pagar', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('descricao', 65535);
			$table->decimal('valor', 9, 2);
			$table->integer('parcelas');
			$table->integer('categoria_pagar_id')->index('fk_conta_pagar_categoria_pagar1');
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
		Schema::drop('conta_pagar');
	}

}
