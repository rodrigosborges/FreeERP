<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAtuacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atuacao', function(Blueprint $table)
		{
			$table->foreign('modulo_id', 'fk_atuacao_modulo1')->references('id')->on('modulo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('papel_id', 'fk_atuacao_papel1')->references('id')->on('papel')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_id', 'fk_atuacao_usuario1')->references('id')->on('usuario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atuacao', function(Blueprint $table)
		{
			$table->dropForeign('fk_atuacao_modulo1');
			$table->dropForeign('fk_atuacao_papel1');
			$table->dropForeign('fk_atuacao_usuario1');
		});
	}

}
