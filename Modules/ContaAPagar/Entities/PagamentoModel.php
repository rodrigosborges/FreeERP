<?php

namespace Modules\ContaAPagar\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\ContaAPagar\Entities\ContaAPagarModel;

class PagamentoModel extends Model
{
    public $table = 'pagamento_conta';
    protected $fillable = ['id', 'numero_parcela', 'conta_pagar_id', 'data_vencimento', 'valor', 'data_pagamento', 'juros','multa','status_pagamento'];
    public $total = 0;
    
    public function id(){
        return $this->belongsTo('Modules\ContaAPagar\Entities\ContaAPagarModel', 'foreign_key');
    }

    public function nome(){
        $conta = ContaAPagarModel::where('id', $this->conta_pagar_id)->first();
        return $conta["descricao"];
    }
}
