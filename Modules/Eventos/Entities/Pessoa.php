<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    private $table = 'pessoa'; //TABELA COM NOME DIVERGENTE DO DEFAULT
    public $timestamps = false; //NÃO VOU UTILIZAR TIMESTAMPS
    
    public function eventos()
    {
        return $this->belongsToMany(Evento::class);
    }
}
