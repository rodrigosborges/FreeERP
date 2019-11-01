<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePontoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ponto', function(Blueprint $table)
		{
            $table->integer('id', true);
			$table->integer('funcionario_id')->index('fk_ponto_funcionario');
			$table->dateTime('entrada');
			$table->dateTime('saida')->nullable();
			$table->boolean('automatico')->default(0);
			$table->dateTime('updated_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ponto');
	}

}
