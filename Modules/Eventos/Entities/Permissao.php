<?php

namespace Modules\Eventos\Entities;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'evento_has_pessoa';
    protected $fillable = [];
    
    public function pessoa(){
        return $this->belongsTo(Pessoa::class);
    }
    
    public function evento(){
        return $this->belongsTo(Evento::class);
    }
    
    public function nivel(){
        return $this->belongsTo(Nivel::class);
    }
    
    public function programacao(){
        return $this->belongsTo(Programacao::class);
    }
}
