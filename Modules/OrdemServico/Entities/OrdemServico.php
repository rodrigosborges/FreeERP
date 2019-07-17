<?php

namespace Modules\OrdemServico\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdemServico extends Model
{
    Use SoftDeletes;
    protected $table = 'ordem_servico';
    public $timestamps = true;
    protected $fillable = array('id','status','descricao');

    public function solicitante(){
        return $this->hasOne('App\Solicitante','ordem_servico_has_solicitante');
    }

    public function tecnico(){
        return $this->hasOne('App\Tecnico','ordem_servico_has_tecnico');
    }
    
    public function gerente(){
        return $this->hasOne('App\Gerente','ordem_servico_has_gerente');
    }
    
    public function aparelho(){
        return $this->hasOne('App\Aparelho','ordem_servico_has_aparelho');
    }
    
    public function problema(){
        return $this->hasOne('App\Problema','ordem_servico_has_problema');
    }
}
