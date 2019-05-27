<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtuacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atuacao', function(Blueprint $table)
		{
			$table->integer('usuario_id')->index('fk_atuacao_usuario1');
			$table->integer('papel_id')->index('fk_atuacao_papel1');
			$table->integer('modulo_id')->index('fk_atuacao_modulo1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('atuacao');
	}

}
