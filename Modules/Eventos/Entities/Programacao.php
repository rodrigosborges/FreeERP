<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Programacao extends Model
{
    private $table = 'programacao'; //TABELA COM NOME DIVERGENTE DO DEFAULT
    public $timestamps = false; //NÃO VOU UTILIZAR TIMESTAMPS
}
