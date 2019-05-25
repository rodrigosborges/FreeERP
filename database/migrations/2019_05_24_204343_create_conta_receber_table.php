<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContaReceberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conta_receber', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('descricao', 65535);
			$table->decimal('valor', 9);
			$table->integer('parcelas');
			$table->integer('categoria_receber_id')->unsigned()->index('fk_conta_receber_categoria_receber1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('conta_receber');
	}

}
