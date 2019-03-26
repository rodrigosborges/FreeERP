<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCompra extends Model
{
    protected $table = 'item_compra';
    public $timestamps = false;
    protected $fillable = array('id','nome_produto','valor_estimado','quantidade','caracteristicas');


    //Relação com tabela Lista_Compra
    public function requisicao(){
        return $this->belongsToMany('App\Compra\Pedido', 'item_compra_has_pedido');
    }

    
}
