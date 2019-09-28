<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vaga', function (Blueprint $table) {
            $table->foreign('cargo_id', 'fk_vaga_cargo1')->references('id')->on('cargo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vaga', function (Blueprint $table) {
            $table->dropForeign('fk_vaga_cargo1');
        });
    }
}
