<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AddForeignKeyToCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('curso', function (Blueprint $table) {
            $table->foreign('funcionario_id', 'fk_curso_funcionario')->references('id')->on('funcionario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('curso', function (Blueprint $table) {
            $table->dropForeign('fk_curso_funcionario');
        });
    }
}
