<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Papel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papel', function (Blueprint $table){

            if(!Schema::hasTable('papel')){
                $table->increments('id');
                $table->string('nome');
                $table->text('descricao');
                $table->integer('usuario_id');
                $table->softDeletes();

                $table->foreign('usuario_id')->references('id')->on('usuario');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('papel');
    }
}
