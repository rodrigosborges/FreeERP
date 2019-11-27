<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuario extends Migration
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
            $table->string('reset_password_token')->nullable();
            $table->foreign('papel_id')->references('id')->on('papel');
            $table->rememberToken();
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
        Schema::dropIfExists('usuario');
    }
}
