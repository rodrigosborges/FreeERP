<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Produto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 45);
            $table->string('descricao', 300);
            $table->decimal('tamanho', 5,2)->nullable();
            $table->integer('categoria_id')->unsigned()->index('fk_produtos_categoria');
            $table->integer('fornecedor_id')->unsigned()->index('fk_produtos_fornecedor');
            $table->integer('unidadeMedida_id')->unsigned()->index('fk_produtos_unidadeMedida');
            $table->decimal('preco', 12, 2);
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
        Schema::dropIfExists('produto');
    }
}
