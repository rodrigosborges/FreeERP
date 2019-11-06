<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Estoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('quantidade');
            $table->integer('tipoUnidade_id')->unsigned()->index('fk_tipo_unidade');
            $table->integer('quantidade_notificacao')->nullable();
            $table->softDeletes();
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
        //
    }
}
