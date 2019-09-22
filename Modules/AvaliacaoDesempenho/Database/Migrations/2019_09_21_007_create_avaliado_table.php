<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliado', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('funcionario_id');
            $table->integer('avaliacao_id');
            $table->timestamps();

            $table->foreign('funcionario_id')->references('id')->on('funcionario')->onDelete('restrict');
            $table->foreign('avaliacao_id')->references('id')->on('avaliacao')->onDelete('restrict');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliado');
    }
}
