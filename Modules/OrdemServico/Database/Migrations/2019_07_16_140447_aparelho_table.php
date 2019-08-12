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
			$table->integer('id', true);
			$table->string('tipo_aparelho');
            $table->string('marca');
			$table->timestamps();
			$table->softDeletes();
		});
    }

    public function down()
    {
        Schema::drop('aparelho');
    }
}
