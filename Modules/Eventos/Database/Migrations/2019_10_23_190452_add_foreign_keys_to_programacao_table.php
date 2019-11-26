<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToProgramacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('programacao', function (Blueprint $table) {
            $table->unsignedInteger('evento_id');
            $table->foreign('evento_id')->references('id')->on('evento')->onDelete('CASCADE');
            $table->unsignedInteger('palestrante_id');
            $table->foreign('palestrante_id')->references('id')->on('palestrante')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('programacao', function (Blueprint $table) {
            $table->dropForeign(['evento_id']);
            $table->dropForeign(['palestrante_id']);
        });
    }
}
