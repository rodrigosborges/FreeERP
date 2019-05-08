<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tecnico extends Migration
{

    public function up()
    {
      Schema::create('tecnico_assistencia', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nome');
          $table->string('cpf');
          $table->timestamps();
      });
    }

    public function down()
    {
        //
    }
}
