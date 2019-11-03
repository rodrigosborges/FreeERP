<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = ['nome','local','dataInicio','dataFim','descricao','imagem','empresa','email','telefone']; //ATRIBUTOS QUE PODEM SER EDITADOS
    protected $guarded = ['id']; //ATRIBUTOS QUE NÃO PODEM SER EDITADOS
    protected $table = 'evento'; //TABELA COM NOME DIVERGENTE DO DEFAULT
    public $timestamps = false; //NÃO VOU UTILIZAR TIMESTAMPS
    
    public function pessoas()
    {
        return $this->belongsToMany(Pessoa::class, 'evento_has_pessoa', 'evento_id', 'pessoa_id');
    }
    
    public function programacao()
    {
        return $this->hasMany(Programacao::class);
    }
    
    public function permissoes(){
        return $this->hasMany(Permissao::class);
    }
}


