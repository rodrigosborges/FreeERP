<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pagamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento_assistencia', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('valor', 6,2);
            $table->text('status');
            $table->text('forma');
            $table->integer('idConserto')->unsigned();
            $table->foreign('idConserto')->references('id')->on('conserto_assistencia')->onDelete('cascade');
            $table->integer('idCliente')->unsigned();
            $table->foreign('idCliente')->references('id')->on('conserto_assistencia')->onDelete('cascade');
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
        //
    }
}
