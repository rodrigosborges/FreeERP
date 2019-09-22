<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questao', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('enunciado', 255);
            $table->string('opt1', 255);
            $table->string('opt2', 255);
            $table->string('opt3', 255);
            $table->string('opt4', 255);
            $table->string('opt5', 255);
            $table->integer('categoria_id');
            $table->timestamps();
            $table->softDeletes();            

            $table->foreign('categoria_id')->references('id')->on('categoria')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questao');
    }
}
