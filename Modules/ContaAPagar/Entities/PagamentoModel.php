<?php

namespace Modules\ContaAPagar\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\ContaAPagar\Entities\ContaAPagarModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagamentoModel extends Model
{
    use SoftDeletes;
    
    public $table = 'pagamento_pagar';
    protected $fillable = ['id', 'conta_pagar_id', 'data_vencimento', 'valor', 'data_pagamento', 'juros','multa','status_pagamento'];


    public function id(){
        return $this->belongsTo('Modules\ContaAPagar\Entities\ContaAPagarModel', 'foreign_key');
    }


    public function nome(){
        $conta = ContaAPagarModel::where('id', $this->conta_pagar_id)->first();
        return $conta["descricao"];
    }

    public function categoria(){
        $conta = ContaAPagarModel::where('id', $this->conta_pagar_id)->first();
        $categoria = CategoriaModel::withTrashed()->where('id', $conta->categoria_pagar_id)->first();
        return $categoria->nome;
    }

    public function categoria_conta($id_conta){
        $conta = ContaAPagarModel::where('id', $id_conta)->first();
        return $conta->categoria_pagar_id;
    }

    public function conta(){
        return $this->belongsTo('Modules\ContaAPagar\Entities\ContaAPagarModel', 'conta_pagar_id', 'id');
    }

}
