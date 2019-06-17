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
			$table->integer('id',true);
			$table->text('descricao', 65535);
			$table->decimal('valor', 9, 2);
			$table->integer('categoria_receber_id')->index('fk_conta_receber_categoria_receber1');
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
		Schema::drop('conta_receber');
	}

}
