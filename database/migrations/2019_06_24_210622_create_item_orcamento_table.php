<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOrcamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_orcamento', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('orcamento_id')->index('fk_item_orcamento_orcamento1');
            $table->integer('item_compra_id')->index('fk_item_orcamento_has_item_compra1');
            $table->double('valor_unitario');
            $table->double('valor_total');
            $table->dateTime('created_at')->nullable();
			$table->dateTime('update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_orcamento');
    }
}
