<?php

namespace Modules\ContaAReceber\Entities;

use Illuminate\Database\Eloquent\Model;

class FormaPagamentoModel extends Model
{
    public $table = 'forma_pagamento_receber';
    protected $fillable = ['id', 'nome', 'taxa','prazo_recebimento', 'ativo', 'forma_pagamento_id'];
}
