<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsuarioHasModulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_has_modulo', function (Blueprint $table) {
            $table->integer('papel_id')->unsigned()->index('fk_us_has_mod_papel_id_idx');
            $table->integer('usuario_id')->unsigned()->index('fk_us_has_mod_usuario_id_idx');
            $table->integer('modulo_id')->unsigned()->index('fk_us_has_mod_modulo_id_idx');
            $table->primary(['usuario_id', 'modulo_id']);
        });

        Schema::table('usuario_has_modulo', function (Blueprint $table) {
            $table->foreign('papel_id')->references('id')->on('papel');
            $table->foreign('usuario_id')->references('id')->on('usuario');
            $table->foreign('modulo_id')->references('id')->on('modulo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_has_modulo');
    }
}

