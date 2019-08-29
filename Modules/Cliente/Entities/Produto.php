<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = "produto";    
    protected $fillable = ['nome','preco','codigo'];

    public function pedidos(){
        return $this->belongsToMany('Modules\Cliente\Entities\Pedido', 'pedido_has_produto');
    }

}
