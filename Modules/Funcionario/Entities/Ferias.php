<?php

namespace Modules\Funcionario\Entities;


use Illuminate\Database\Eloquent\Model;

class Ferias extends Model
{
    protected $table = 'ferias';

    protected $fillable = ['data_inicio','data_fim','dias_ferias','data_pagamento','data_aviso','situacao_ferias','pagamento_parcela13','observacao', 'funcionario_id', 'controle_ferias_id'];

    public function controleFerias() {
        return $this->belongsTo('Modules\Funcionario\Entities\ControleFerias');
    }
   
    public function funcionario() {
        return $this->belongsTo('Modules\Funcionario\Entities\Funcionario');
    }
       
}


