<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelefoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telefone', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('tipo_telefone_id')->index('fk_telefone_tipo_telefone1');
			$table->string('numero', 11);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('telefone');
	}

}
