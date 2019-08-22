<?php

namespace Modules\Funcionario\Entities;

use Illuminate\Database\Eloquent\Model;

class Ferias extends Model
{
    protected $table = 'ferias';

    protected $fillable = ['inicio_periodo_aquisitivo','fim_periodo_aquisitivo','quantidade_dias','abono_pecuniario','id_controle_ferias'];

}

