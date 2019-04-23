<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('orcamento_id');
            $table->unsignedBigInteger('orcamento_fornecedor_id');

            $table->timestamps();
            $table->softDeletes();

             //referencia chave estrangeira
             $table->foreign('orcamento_id')->references('id')->on('orcamento');
              $table->foreign('orcamento_fornecedor_id')->references('fornecedor_id')->on('orcamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra');
    }
}
