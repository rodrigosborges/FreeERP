<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimentacaoEstoque extends Model
{
    use SoftDeletes;
    protected $fillable = ['data','quantidade','entrada','estoque_id','preco_custo'];
    protected $table ='movimentacao_estoque';


    public function estoque(){
        return $this->belongsTo('Modules\Estoque\Entities\Estoque');
    }
}
