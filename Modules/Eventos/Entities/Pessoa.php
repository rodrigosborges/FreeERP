<?php

namespace Modules\Eventos\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pessoa extends Authenticatable
{
    protected $fillable = ['nome', 'email', 'telefone', 'password']; //ATRIBUTOS QUE PODEM SER EDITADOS
    protected $guarded = ['id']; //ATRIBUTOS QUE NÃO PODEM SER EDITADOS
    protected $table = 'pessoa'; //TABELA COM NOME DIVERGENTE DO DEFAULT
    public $timestamps = false; //NÃO VOU UTILIZAR TIMESTAMPS
    
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_has_pessoa', 'pessoa_id', 'evento_id');
    }
}
