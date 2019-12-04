<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplementoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complemento', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('complemento');
            $table->integer('user_id')->index('fk_complemento_user1');
            $table->integer('protocolo_id')->index('fk_doc_protocolo_protocolo1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complemento');
    }
}
