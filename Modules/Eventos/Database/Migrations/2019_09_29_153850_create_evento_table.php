<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('local');
            $table->date('dataInicio');
            $table->date('dataFim');
            $table->longText('descricao');
            $table->mediumText('imagem')->nullable();
            $table->string('empresa');
            $table->string('email', 80)->nullable();
            $table->string('telefone', 14)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento');
    }
}
