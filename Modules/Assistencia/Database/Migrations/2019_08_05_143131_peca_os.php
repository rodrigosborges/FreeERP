<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PecaOs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peca_os_assistencia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idConserto')->unsigned();
            $table->foreign('idConserto')->references('id')->on('conserto_assistencia');
            $table->integer('idItemPeca')->unsigned();
            $table->foreign('idItemPeca')->references('id')->on('item_peca_assistencia');
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
