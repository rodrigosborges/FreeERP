<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConviteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convite', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evento_id');
            $table->unsignedBigInteger('funcionario_id');
            $table->boolean('status')->nullable();
            $table->foreign('evento_id')->references('id')->on('evento')->onDelete('cascade');
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
        Schema::dropIfExists('convite');
    }
}
