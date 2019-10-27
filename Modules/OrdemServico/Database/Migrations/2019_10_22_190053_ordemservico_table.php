
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
            $table->increments('id');
            $table->string('protocolo')->unique();
            $table->string('descricao');
            $table->integer('prioridade')->default(3);


            $table->integer('gerente_id')->unsigned();
            $table->foreign('gerente_id')->references('id')->on('usuario');

            $table->integer('tecnico_id')->unsigned()->nullable();
            $table->foreign('tecnico_id')->references('id')->on('usuario');
    
            $table->integer('aparelho_id')->unsigned();
            $table->foreign('aparelho_id')->references('id')->on('aparelho');

            $table->integer('problema_id')->unsigned();
            $table->foreign('problema_id')->references('id')->on('problema');
            
            $table->integer('status_id')->unsigned()->default(1);
            $table->foreign('status_id')->references('id')->on('status');

            $table->integer('solicitante_id')->unsigned();
            $table->foreign('solicitante_id')->references('id')->on('solicitante');

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