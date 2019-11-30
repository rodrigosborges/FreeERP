<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVagaHasBeneficioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaga_has_beneficio', function (Blueprint $table) {
            $table->integer('id', true);
			$table->integer('vaga_id')->index('fk_vaga_has_beneficio_vaga1');
            $table->integer('beneficio_id')->index('fk_vaga_has_beneficio_beneficio1');
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
        Schema::drop('vaga_has_beneficio');
    }
}
