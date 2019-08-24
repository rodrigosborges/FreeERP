<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subcategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('subcategoria', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('categoria_id')->unsigned()->nullable()->index('fk_categoria_pai');
            $table->softDeletes();
            $table->foreign('categoria_id', 'fk_categoria_pai')->references('id')->on('categoria')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('id', 'fk_categoria')->references('id')->on('categoria')->onUpdate('NO ACTION')->onDelete('CASCADE');

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
         Schema::dropIfExists('subcategoria');
        //
    }
}
