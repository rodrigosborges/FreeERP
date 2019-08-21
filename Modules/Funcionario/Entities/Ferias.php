<?php

namespace Modules\Funcionario\Entities;

use Illuminate\Database\Eloquent\Model;

class Ferias extends Model
{
    protected $table = 'ferias';

    protected $fillable = ['inicio_ferias','final_ferias','abono_pecuniario'];

    public function funcionario(){
        return $this->belongsTo('Modules\Funcionario\Entities\Funcionario');
    }
}

