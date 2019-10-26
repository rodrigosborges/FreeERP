<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SolucaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solucao', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descricao');

            $table->integer('problema_id')->unsigned();
            $table->foreign('problema_id')->references('id')->on('problema');
			
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('solucao');
	}
}
