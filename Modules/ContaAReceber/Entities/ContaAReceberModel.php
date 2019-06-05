<?php

namespace Modules\ContaAReceber\Entities;

use Illuminate\Database\Eloquent\Model;

class ContaAReceberModel extends Model
{
    public $table = 'conta_receber';
    protected $fillable = ['id', 'descricao', 'valor', 'categoria_receber_id', 'ativo'];
    
}
