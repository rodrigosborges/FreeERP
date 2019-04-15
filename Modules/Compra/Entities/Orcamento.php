<?php

namespace Modules\Compra\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orcamento extends Model
{
    use SoftDeletes;
    protected $table = 'orcamento';
    public $timestamps = true;
    protected $fillable = array('id','valor_total');

    //Relação com a tabela Pedido
    public function pedidos(){
        return $this->belongsToMany('App\Compra\Pedido','orcamento_has_pedido');
    }

}
