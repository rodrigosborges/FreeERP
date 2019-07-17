<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdemServicoTable extends Migration
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
            $table->integer('solicitante_id')->index('fk_ordem_servico_solicitante1');
            $table->integer('gerente_id')->index('fk_ordem_servico_gerente1');
            $table->integer('tecnico_id')->index('fk_ordem_servico_tecnico1');
            $table->integer('aparelho_id')->index('fk_ordem_servico_aparelho1');
            $table->integer('problema_id')->index('fk_ordem_servico_problema1');
            $table->string('status');
            $table->string('descricao');
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