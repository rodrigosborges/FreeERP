<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Estoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('estoque', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quantidade');
            $table->integer('produto_id')->unsigned()->index('fk_produto');
            $table->integer('tipo_unidade_id')->unsigned()->index('fk_tipo_unidade');
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
        Schema::dropIfExists('estoque');
    }
}
