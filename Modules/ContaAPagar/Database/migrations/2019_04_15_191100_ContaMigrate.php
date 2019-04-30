<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContaMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_pagar', function (Blueprint $table) {
        $table->increments('id');
        $table->text('descricao');
        $table->decimal('valor', 9, 2);
        $table->integer('parcelas'); 
        $table->integer('categoria_pagar_id')->unsigned();
        $table->foreign('categoria_pagar_id')->references('id')->on('categoria_pagar');
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
