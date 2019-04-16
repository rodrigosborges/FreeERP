<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Modulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('modulo', function (Bluepint $table){
            
            if(!Schema::hasTable('papel')){

            $table->increments('id');
            $table->string('nome');
            $table->string('icone');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('modulo');
    }
}
