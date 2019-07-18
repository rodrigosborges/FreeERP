<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Peca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('peca_assistencia', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nome');
          $table->decimal('valor_compra', 6,2);
          $table->decimal('valor_venda', 6,2);
          $table->timestamps();
          $table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('peca');
    }
}
