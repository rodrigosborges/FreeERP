<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCompra extends Model
{
    protected $table = 'item_compra';
    public $timestamps = false;
    protected $fillable = array('id_item','nome','valor_estimado','descricao','id_requisicao','quantidade');

    public function requisicao(){
        return $this->belongsToMany('App\RequisicaoCompra', 'requisicao_has_item_compra');
    }
}
