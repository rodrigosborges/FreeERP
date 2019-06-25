<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToItemOrcamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_orcamento', function (Blueprint $table) {
            $table->foreign('orcamento_id', 'fk_item_orcamento_orcamento1')->references('id')->on('orcamento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('item_compra_id', 'fk_item_orcamento_has_item_compra1')->references('id')->on('item_compra_has_pedido')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_orcamento', function (Blueprint $table) {
            //
        });
    }
}
