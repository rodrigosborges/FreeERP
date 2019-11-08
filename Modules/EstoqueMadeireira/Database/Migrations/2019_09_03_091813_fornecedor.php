<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fornecedor extends Migration
{

    public function up()
    {
        Schema::create('fornecedor', function(Blueprint $table){
            $table->increments('id');
            $table->string('nome', 45);
            $table->string('telefone', 14)->nullable();
            $table->string('endereco', 60);          
            $table->string('cnpj', 18);
            $table->string('email', 40);
            $table->timestamps();
            $table->softDeletes();

        });
    }


    public function down()
    {
        Schema::dropIfExists('fornecedor');
    }
}
