<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Pedido extends Model
{
    use SoftDeletes;

    protected $table = "pedido";    
    protected $fillable = ['numero','desconto','data'];

    public function produtos(){
        return $this->belongsToMany('Modules\Cliente\Entities\Produto', 'pedido_has_produto')->withPivot('quantidade','desconto');
    }
    public function vl_total_itens(){
        return $this->produtos()->
        select("produto.preco", "pedido_has_produto.quantidade", "pedido_has_produto.desconto", 
        
        DB::raw(" ( (produto.preco * pedido_has_produto.quantidade) 
            - ( (produto.preco*pedido_has_produto.quantidade) * (pedido_has_produto.desconto/100) ) ) as valor_total"
            ) 
        
        )->get();
    }

    public function vl_total_pedido(){

    }





}
