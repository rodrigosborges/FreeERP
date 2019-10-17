<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PapelHasModulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('papel_has_modulo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('papel_id')->unsigned();
            $table->integer('modulo_id')->unsigned();
            
            $table->foreign('modulo_id')->references('id')->on('modulo');
            $table->foreign('papel_id')->references('id')->on('papel');
            
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
