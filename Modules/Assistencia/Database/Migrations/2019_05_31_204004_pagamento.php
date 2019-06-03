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
            $table->decimal('desconto', 6,2);
            $table->decimal('valor', 6,2);
            $table->boolean('status')->default('false');
            $table->integer('idConserto')->unsigned();
            $table->foreign('idConserto')->references('id')->on('conserto_assistencia');
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
