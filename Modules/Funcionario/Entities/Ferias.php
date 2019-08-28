<?php

namespace Modules\Funcionario\Entities;

use Illuminate\Database\Eloquent\Model;

class Ferias extends Model
{
    protected $table = 'ferias';

    protected $fillable = ['inicio_periodo_aquisitivo','fim_periodo_aquisitivo','quantidade_dias','abono_pecuniario','id_controle_ferias'];

}

class ControleFerias extends Model
{
    protected $table = 'controleferias';

    protected $fillable = ['data_inicio','data_fim','dias_ferias','numero_vezes','inicio_desconto','data_pagamento','data_aviso',
    'situacao_ferias','dias_abono','pagamento_parcela13','ferias_coletivas','observacao'];

}

