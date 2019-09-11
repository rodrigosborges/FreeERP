<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;

class MovimentacaoEstoque extends Model
{
    protected $fillable = ['quantidade','observacao','estoque_id','preco_custo'];
    protected $table ='movimentacao_estoque';


    public function estoque(){
        return $this->belongsTo('Modules\Estoque\Entities\Estoque');
    }

}
