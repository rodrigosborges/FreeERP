<?php

namespace Modules\ContaAReceber\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\ContaAPagar\Entities\ContaAPagarModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagamentoModel extends Model
{
    use SoftDeletes;
    public $table = 'pagamento_receber';
    protected $fillable = ['id', 'numero_parcela', 'conta_pagar_id', 'valor', 'data_pagamento','status_pagamento'];


    public function id(){
        return $this->belongsTo('Modules\ContaAReceber\Entities\ContaAPagarModel', 'foreign_key');
    }


    public function nome(){
        $conta = ContaAReceberModel::where('id', $this->conta_receber_id)->first();
        return $conta["descricao"];
    }

    public function categoria(){
        $conta = ContaAReceberModel::where('id', $this->conta_receber_id)->first();
        $categoria = CategoriaModel::where('id', $conta->categoria_receber_id)->first();
        return $categoria->nome;
    }

    public function formapg(){
        $formapg = FormaPagamentoModel::where('id', $this->forma_pagamento_id)->get()->first();
        return $formapg['nome'];
    }
    public function categoria_conta($id_conta){
        $conta = ContaAReceber::where('id', $id_conta)->first();
        return $conta->categoria_pagar_id;
    }

    public function valorPrevisto(){
        $formapg = FormaPagamentoModel::where('id', $this->forma_pagamento_id)->get()->first();
        return ($this->valor - (($this->valor*$formapg->taxa)/100));
    }

}
