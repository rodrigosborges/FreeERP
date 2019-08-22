<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documento', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('numero', 50);
			$table->string('comprovante', 100)->nullable();
			$table->integer('tipo_documento_id')->index('fk_documento_tipo_documento');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documento');
	}

}
