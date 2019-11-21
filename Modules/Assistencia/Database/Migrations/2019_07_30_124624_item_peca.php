<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemPeca extends Migration
{
 
    public function up()
    {
        Schema::create('item_peca_assistencia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idPeca')->unsigned();
            $table->foreign('idPeca')->references('id')->on('peca_assistencia')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
}