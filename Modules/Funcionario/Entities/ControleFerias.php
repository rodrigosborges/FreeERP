<?php

namespace Modules\Funcionario\Entities;

use Illuminate\Database\Eloquent\Model;

class ControleFerias extends Model
{
    protected $table = 'controle_ferias';

    protected $fillable = ['inicio_periodo_aquisitivo','fim_periodo_aquisitivo','saldo_total','saldo_periodo','marcar_ferias', 'funcionario_id'];

    public function ferias() {
        return $this->HasMany('Modules\Funcionario\Entities\Ferias');
    }

    public function funcionario() {
        return $this->BelongsTo('Modules\Funcionario\Entities\Funcionario');
    }
}
