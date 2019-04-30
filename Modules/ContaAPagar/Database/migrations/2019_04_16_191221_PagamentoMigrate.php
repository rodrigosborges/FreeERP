<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PagamentoMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('numero_parcela');
        $table->integer('conta_pagar_id')->unsigned();
        $table->foreign('conta_pagar_id')->references('id')->on('conta_pagar');
        $table->date('data_vencimento');
        $table->decimal('valor', 9,2);
        $table->date('data_pagamento');
        $table->decimal('juros',9,2);
        $table->decimal('multa',9,2);
        $table->text('status_pagamento');
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
