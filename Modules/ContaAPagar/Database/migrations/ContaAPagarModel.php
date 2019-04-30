<?php

namespace Modules\ContaAPagar\Entities;

use Illuminate\Database\Eloquent\Model;

class ContaAPagarModel extends Model
{
    public $table = 'conta_pagar';
    protected $fillable = ['id', 'descricao', 'valor', 'parcelas', 'categoria_id'];
    
}
