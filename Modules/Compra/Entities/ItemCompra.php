<?php

namespace Modules\Compra\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemCompra extends Model
{
    use SoftDeletes;
    protected $table = 'item_compra';
    public $timestamps = false;
    protected $fillable = array('id','nome','valor_estimado','caracteristicas');


    //Relação com tabela Pedido
    public function pedidos(){
        return $this->belongsToMany('App\Compra\Pedido', 'item_compra_has_pedido');
    }

    
}
