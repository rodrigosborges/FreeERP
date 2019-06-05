<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pagamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento_receber', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('conta_receber_id')->unsigned();
        $table->foreign('conta_receber_id')->references('id')->on('conta_receber');
        $table->decimal('valor', 9,2);
        $table->date('data_pagamento');
        $table->float('taxa');
        $table->date('data_recebimento');
        $table->text('status_pagamento');
        $table->integer('forma_pagamento_id')->unsigned();
        $table->foreign('forma_pagamento_id')->references('id')->on('conta_receber');
        $table->boolean('ativo')->default(1);
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
