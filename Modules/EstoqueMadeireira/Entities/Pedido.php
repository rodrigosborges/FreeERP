<?php

namespace Modules\EstoqueMadeireira\Entities;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use SoftDeletes;
    protected $fillable = ['cliente_id', 'taxa', 'desconto'];
    protected $table = 'pedidos';

    public function itemPedido(){
        
    }
}



