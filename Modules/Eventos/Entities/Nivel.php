<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $fillable = ['descricao']; //ATRIBUTOS QUE PODEM SER EDITADOS
    protected $guarded = ['id']; //ATRIBUTOS QUE NÃO PODEM SER EDITADOS
    protected $table = 'nivel'; //TABELA COM NOME DIVERGENTE DO DEFAULT
    public $timestamps = false; //NÃO VOU UTILIZAR TIMESTAMPS
}
