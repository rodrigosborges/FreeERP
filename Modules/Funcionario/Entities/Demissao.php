<?php

namespace Modules\Funcionario\Entities;

use Illuminate\Database\Eloquent\Model;

class Demissao extends Model {

    protected $table = 'demissao';

    protected $fillable = ['data_demissao', 'data_pagamento', 'funcionario_id', 'tipo_demissao_id'];
    
    public function funcionario(){
        return $this->belongsTo('Modules\Funcionario\Entities\Funcionario');
    }

    public function tipoDemissao(){
        return $this->belongsTo('App\Entities\TipoDemissao');
    }
}
