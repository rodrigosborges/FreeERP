<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateAdiantamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adiantamento', function (Blueprint $table) {
            $table->integer('id', true);
            $table->double('valor_adiantamento')->nullable();
            $table->date('emissao');
            $table->integer('folha_pagamento_id')->index('fk_adiantamento_folha_pagamento1');
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
        Schema::drop('adiantamento');
    }
}
