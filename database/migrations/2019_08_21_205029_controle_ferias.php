<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ControleFerias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controle_ferias', function (Blueprint $table) {
            $table->increments('id');
            $table->date('inicio_periodo_aquisitivo');
            $table->date('fim_periodo_aquisitivo');
            $table->date('limite_periodo_aquisitivo');
            $table->integer('saldo_periodo');
            $table->integer('funcionario_id')->unsigned()->index('fk_controle_ferias_funcionario');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('controle_ferias');
    }
}
