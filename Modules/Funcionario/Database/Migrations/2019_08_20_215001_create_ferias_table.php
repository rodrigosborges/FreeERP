<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ferias', function (Blueprint $table) {
            $table->increments('id');
            $table->date('inicio_periodo_aquisitivo');
            $table->date('fim_periodo_aquisitivo');
            $table->integer('quantidade_dias');
            $table->boolean('abono_pecuniario');
            $table->integer('controle_ferias_id')->unsigned()->index('fk_ferias_controle_ferias');
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
        Schema::drop('ferias');
    }
}
