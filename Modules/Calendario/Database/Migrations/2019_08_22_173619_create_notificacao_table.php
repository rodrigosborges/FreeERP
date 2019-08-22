<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tempo');
            $table->integer('periodo');
            $table->boolean('email')->default(false);
            $table->boolean('disparado')->default(false);
            $table->unsignedBigInteger('evento_id');
            $table->foreign('evento_id')->references('id')->on('evento')->onDelete('cascade');
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
        Schema::dropIfExists('notificacao');
    }
}
