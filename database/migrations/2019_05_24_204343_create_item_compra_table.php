<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemCompraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_compra', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome');
			$table->float('valor_estimado');
			$table->text('caracteristicas', 65535);
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
		Schema::drop('item_compra');
	}

}
