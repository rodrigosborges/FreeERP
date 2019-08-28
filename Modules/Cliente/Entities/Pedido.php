<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

    protected $table = "pedido";    
    protected $fillable = ['desconto','data'];

    public function produtos(){
        return $this->belongsToMany('Modules\Cliente\Entities\Produto', 'pedido_has_produto')->withPivot('quantidade','desconto');
    }
    public function vl_total_itens(){
        
    }

    public function vl_total_pedido(){

    }





}
