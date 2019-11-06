<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoHasPessoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_has_pessoa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evento_id')->unsigned();
            $table->foreign('evento_id')->references('id')->on('evento')->onDelete('CASCADE');
            $table->integer('pessoa_id')->unsigned();
            $table->foreign('pessoa_id')->references('id')->on('pessoa')->onDelete('CASCADE');
            $table->integer('nivel_id')->unsigned();
            $table->foreign('nivel_id')->references('id')->on('nivel')->onDelete('CASCADE');
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
        Schema::table('evento_has_pessoa', function(Blueprint $table){
            $table->dropForeign(['evento_id']);
            $table->dropForeign(['pessoa_id']);
            $table->dropForeign(['nivel_id']);
        });
        Schema::dropIfExists('evento_has_pessoa');
    }
}
