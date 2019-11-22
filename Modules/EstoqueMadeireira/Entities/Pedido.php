<?php

namespace Modules\EstoqueMadeireira\Entities;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['cliente_id', 'taxa', 'desconto', 'status_pedido'];
    protected $table = 'pedidos';

    public function itemPedido()
    {
        return $this->hasMany('Modules\EstoqueMadeireira\Entities\itemPedido');
    }
}



