<?php

namespace Modules\Compra\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemCompraHasPedido extends Model
{
    protected $table = 'item_compra_has_pedido';
    public $timestamps = false;
    protected $fillable = array('id','item_compra_id','item_pedido_id');

    //Relação com tabela Item Compra
    public function itens(){
        return $this->belongsToMany('App\Compra\ItemCompra');
    }

    //Relação com tabela Pedido
    public function pedidos(){
        return $this->belongsToMany('App\Compra\Pedido');
    }

}
