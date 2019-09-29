<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    private $table = 'evento'; //TABELA COM NOME DIVERGENTE DO DEFAULT
    public $timestamps = false; //NÃO VOU UTILIZAR TIMESTAMPS
    
    public function programacao()
    {
        return $this->hasMany('Programacao');
    }
}


