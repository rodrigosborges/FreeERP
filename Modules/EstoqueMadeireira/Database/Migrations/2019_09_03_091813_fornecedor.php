<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fornecedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor', function(Blueprint $table){
            $table->increments('id');
            $table->string('nome');
            $table->string('telefone');
            $table->string('endereco');          
            $table->string('cnpj');
            $table->integer('categoria_id')->unsigned()->index('fk_produtos_categoria');
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
        Schema::dropIfExists('fornecedor');
    }
}
