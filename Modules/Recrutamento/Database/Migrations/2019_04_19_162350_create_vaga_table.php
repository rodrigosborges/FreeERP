<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaga', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cargo_id')->index('fk_vaga_cargo1');
            $table->string('salario');
            $table->longText('descricao')->nullable($value = true);
            $table->string('regime');
            $table->string('beneficios');
            $table->string('escolaridade');
            $table->string('especificacoes')->nullable($value = true);
            $table->boolean('status');
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
        Schema::drop('vaga');
    }
}
