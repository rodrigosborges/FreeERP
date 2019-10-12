<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAprovacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aprovacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('compartilhamento_id')->unique();
            $table->unsignedBigInteger('funcionario_id');
            $table->foreign('compartilhamento_id')->references('id')->on('compartilhamento')->onDelete('cascade');
            $table->foreign('funcionario_id')->references('id')->on('funcionario')->onDelete('cascade');
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
        Schema::dropIfExists('aprovacao');
    }
}
