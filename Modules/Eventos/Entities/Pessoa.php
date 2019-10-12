<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = ['nome','email','telefone','foto']; //ATRIBUTOS QUE PODEM SER EDITADOS
    protected $guarded = ['id']; //ATRIBUTOS QUE NÃO PODEM SER EDITADOS
    protected $table = 'pessoa'; //TABELA COM NOME DIVERGENTE DO DEFAULT
    public $timestamps = false; //NÃO VOU UTILIZAR TIMESTAMPS
    
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_has_pessoa', 'pessoa_id', 'evento_id');
    }
}
