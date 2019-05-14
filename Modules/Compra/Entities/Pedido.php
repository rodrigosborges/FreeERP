<?php


namespace Modules\Compra\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;
    protected $table = 'pedido';
    public $timestamps = true;
    protected $fillable = array('id','status');

    //Relação com a tabela ListaCompra
    public function itens(){
        return $this->belongsToMany('Modules\Compra\Entities\ItemCompra','item_compra_has_pedido');

    }

    

    
   

}
