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

    public function setDataAttribute($val){
        $date = \DateTime::createFromFormat('d/m/Y', $val);
        $this->attributes["data"]= $date->format('Y-m-d');
    }

    public function getDataAttribute(){
        return date("d/m/Y", strtotime($this->attributes["data"]));
    }

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
    public function produto_qtde($produto_id){
        return $this->produtos()->select("produto.nome", "pedido_has_produto.quantidade as qtde")
            ->where("produto.id","=",$produto_id)->first();
    }

    public function vl_bruto_pedido(){
         $vl = $this->produtos()->select(DB::raw("produto.preco*pedido_has_produto.quantidade as total_item"))->get();
         $total = 0;
         foreach($vl as $valor){
             $total += $valor["total_item"];
         }
         return $total;
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
                $valor = $valor - ( $valor*($this->desconto /100 ));
            }else{
                $this->desconto = 0;
            }
        }

        return $valor;
    }

    public function media_desconto_itens(){
        $produtos = $this->vl_total_itens();
        $desc_total = 0;

        foreach($produtos as $produto){
            $desc_total += $produto->desconto;
        }
        if($desc_total > 0)
            return $media = $desc_total/count($produtos);

        return 0;
    }




    





}
