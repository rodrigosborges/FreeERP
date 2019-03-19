<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisicaoCompra extends Model
{
    protected $table = 'requisicao_compra';
    public $timestamps = true;
    protected $fillable = array('id_requisicao','id_gerente');


    // relação de requisição com itens da compra
    public function item_compra(){
        return $this->hasMany('app\ItemCompra');
    }
    
}
