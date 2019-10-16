<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocProtocoloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_protocolo', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('documento', 100);
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
        Schema::dropIfExists('doc_protocolo');
    }
}
