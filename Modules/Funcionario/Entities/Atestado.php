<?php

namespace Modules\Funcionario\Entities;

use Illuminate\Database\Eloquent\Model;

class Atestado extends Model
{
    protected $table = 'atestado';
    protected $fillable = ['cid_atestado','data_inicio','data_fim','quantidade_dias','funcionario_id'];

public function funcionario(){
    return $this->belongsTo('Modules\Funcionario\Entities\Funcionario');
}
}