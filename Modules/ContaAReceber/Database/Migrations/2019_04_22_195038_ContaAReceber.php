<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContaAReceber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_receber', function (Blueprint $table) {
        $table->increments('id');
        $table->text('descricao');
        $table->decimal('valor', 9, 2);
        $table->integer('parcelas'); 
        $table->integer('categoria_receber_id')->unsigned();
        $table->foreign('categoria_receber_id')->references('id')->on('categoria_receber');
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
