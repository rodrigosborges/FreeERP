<?php

namespace Modules\ContaAReceber\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContaAReceberModel extends Model
{
    use SoftDeletes;
    public $table = 'conta_receber';
    protected $fillable = ['id', 'descricao', 'valor', 'categoria_receber_id'];

}
