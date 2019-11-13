<?php

namespace Modules\EstoqueMadeireira\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class itemPedido extends Model
{
    use SoftDeletes;
    protected $fillable = ['pedido_id', 'produto_id', 'quantidade', 'precoCusto', 'precoVenda'];
    protected $table = 'item_pedidos';


    public function pedido(){
        return $this->belongsTo('Modules\EstoqueMadeireira\Entities\Pedido')->withTrashed();

    }

}


