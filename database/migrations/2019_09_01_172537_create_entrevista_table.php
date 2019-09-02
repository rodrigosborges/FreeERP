<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrevistaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrevista', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('candidato_id')->index('fk_entrevista_candidato1');
            $table->date('data');
            $table->time('hora');
            $table->string('local');
            $table->string('email');
            $table->string('mensagem');
            $table->softDeletes();
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
        Schema::drop('entrevista');
    }
}
