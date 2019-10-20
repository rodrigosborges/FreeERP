<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SituacaOs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('situacao_os_assistencia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('situacao');
            $table->string('obs')->nullable();
            $table->integer('idConserto')->unsigned();
            $table->foreign('idConserto')->references('id')->on('conserto_assistencia')->onDelete('cascade');
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
