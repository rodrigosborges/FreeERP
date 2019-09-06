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
            $table->integer('tipo_id')->unsigned()->index('fk_produtos_tipo');
            $table->decimal('preco', 12, 2);
            $table->integer('unidade_id')->unsgined()->index('fk_produtos_unidade');
            $table->integer('codigo');
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
