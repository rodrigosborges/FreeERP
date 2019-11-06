<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstoqueHasTipoUnidade extends Migration
{
    
    public function up()
    {
        Schema::create('estoque_has_tipoUnidade', function (Blueprint $table){
            $table->integer('estoque_id');
            $table->integer('tipoUnidade_id')->index('fk_estoque_has_tipoUnidade');

            $table->primary(['estoque_id', 'tipoUnidade_id']);
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('estoque_has_tipoUnidade');

    }
}