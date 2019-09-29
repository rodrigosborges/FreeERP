<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    private $table = 'nivel'; //TABELA COM NOME DIVERGENTE DO DEFAULT
    public $timestamps = false; //NÃO VOU UTILIZAR TIMESTAMPS
}
