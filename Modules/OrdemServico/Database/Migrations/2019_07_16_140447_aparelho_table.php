<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AparelhoTable extends Migration
{
    public function up()
    {
        Schema::create('aparelho', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('numero_serie')->unique();
			$table->string('tipo_aparelho');
            $table->string('marca');
            $table->string('modelo');
            $table->string('acessorios')->nullable();
            $table->boolean('inutilizacao')->default(false);
			$table->timestamps();
			$table->softDeletes();
		});
    }

    public function down()
    {
        Schema::drop('aparelho');
    }
}
