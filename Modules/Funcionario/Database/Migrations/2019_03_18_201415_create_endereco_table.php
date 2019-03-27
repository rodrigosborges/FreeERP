<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnderecoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('endereco', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('funcionario_id')->index('fk_endereco_funcionario');
			$table->string('logradouro');
			$table->integer('numero');
			$table->string('bairro', 100);
			$table->string('cidade', 100);
			$table->string('uf', 2);
			$table->string('cep', 8);
			$table->string('complemento', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('endereco');
	}

}
