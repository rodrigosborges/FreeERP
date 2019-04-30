<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormaDePagamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forma_pagamento_receber', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('nome');
            $table->float('taxa');
            $table->integer('prazo_recebimento');
            $table->rememberToken();
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
