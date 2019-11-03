<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipoUnidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoUnidade', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 20);
            $table->integer('quantidade_itens');
            $table->softDeletes();
            $table->timestamps();
        });
        //
    }

    public function down()
    {
        Schema::dropifExists('tipo_unidade');
    }
}
