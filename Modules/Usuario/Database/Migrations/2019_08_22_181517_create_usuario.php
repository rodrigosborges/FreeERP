<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('apelido');
            $table->string('avatar')->default("default.png");
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('papel_id')->unsigned();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::table('usuario', function(Blueprint $table) {
            $table->foreign('papel_id')->references('id')->on('papel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
