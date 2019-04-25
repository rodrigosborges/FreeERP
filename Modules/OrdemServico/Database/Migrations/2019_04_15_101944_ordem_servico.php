<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdemServico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('ordem_servico', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('solicitante_id')->index('fk_solicitante');
            $table->string('tipo_aparelho');
            $table->string('marca');
            $table->string('numero_serie');
            $table->string('descricao_problema');
			$table->string('status')->default('Em andamento');
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
		Schema::drop('ordem_servico');
	}

}
