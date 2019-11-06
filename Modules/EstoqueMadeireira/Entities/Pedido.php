<?php

namespace Modules\EstoqueMadeireira\Entities;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['cliente_id', 'taxa', 'desconto'];
    protected $table = 'pedidos';

    public function itemPedido(){
        
    }
}



