<?php

namespace Modules\Funcionario\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends Model
{
    use SoftDeletes;

    protected $table = 'pagamento';

    protected $fillable = ['valor', 'horas_extras', 'adicional_noturno', 
                           'inss', 'faltas', 'emissao', 'tipo_pagamento', 'funcionario_id', 'total',
                        'tipo_hora_extra'];

    public $timestamps = false;

    public function funcionario()
    {
        return $this->belongsTo('Modules\Funcionario\Entities\Funcionario','funcionario_id');
    }


}
