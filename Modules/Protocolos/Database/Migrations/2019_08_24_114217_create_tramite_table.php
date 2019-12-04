<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramite', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('observacao');
            $table->text('origem');
            $table->text('destino')->nullable();
            $table->integer('protocolo_id')->index('fk_tramite_protocolo1');
            $table->boolean('checkbox');
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
        Schema::dropIfExists('tramite');
    }
}
