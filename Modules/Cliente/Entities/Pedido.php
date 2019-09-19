<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido extends Model
{
    use SoftDeletes;

    protected $table = "pedido";    
    protected $fillable = ['numero','desconto','data','cliente_id'];

    public function produtos(){
        return $this->belongsToMany('Modules\Cliente\Entities\Produto', 'pedido_has_produto')->withPivot('quantidade','desconto');
    }
    public function cliente(){
        return $this->belongsTo('Modules\Cliente\Entities\Cliente');
    }

    public function vl_total_itens(){

        return $this->produtos()->
        select("produto.preco", "produto.nome","pedido_has_produto.quantidade", "pedido_has_produto.desconto", 
        
        DB::raw(" ( (produto.preco * pedido_has_produto.quantidade) 
            - ( (produto.preco*pedido_has_produto.quantidade) * (pedido_has_produto.desconto/100) ) ) as valor_total"
            ) 
        
        )->get();
    }
    public function vl_itens_desconto(){
        $valor  = 0;
        foreach($this->vl_total_itens() as $pedido){
            $valor += $pedido->valor_total;
        }
        return $valor;
    }

    public function vl_total_pedido(){
        $valor = $this->vl_itens_desconto();

        
        if($valor > 0){
            if($this->desconto > 0){
                $valor = $valor - ($valor*($this->desconto /100 ));
            }else{
                $this->desconto = 0;
            }
        }

        return $valor;
    }




    





}
