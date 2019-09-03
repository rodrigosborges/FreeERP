<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFolhaPagamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->double('valor', 9,2); //1,000 a 999999,999
			$table->double('horas_extras', 7,2)->nullable();
			$table->double('adicional_noturno', 7,3)->nullable();
			$table->double('inss', 7,2);
            $table->integer('faltas');
            $table->date('emissao');
            $table->double('total', 9,3);
            $table->string('tipo_pagamento');
            $table->integer('funcionario_id')->index('fk_folha_pagamento_funcionario1');
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
        Schema::dropIfExists('pagamento');
    }
}