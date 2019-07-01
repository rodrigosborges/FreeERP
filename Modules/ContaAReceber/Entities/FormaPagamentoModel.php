<?php

namespace Modules\ContaAReceber\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FormaPagamentoModel extends Model
{
    use SoftDeletes;
    public $table = 'forma_pagamento_receber';
    protected $fillable = ['id', 'nome', 'taxa','prazo_recebimento', 'forma_pagamento_id'];

}
