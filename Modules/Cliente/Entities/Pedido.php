<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedido";    
    protected $fillable = ['desconto','data'];

    public function produtos(){
        return $this->belongsToMany('Modules\Cliente\Entities\Produto', 'pedido_has_produto');
    }






}
