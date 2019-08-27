<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use softDeletes;

    protected $table = 'produto';
    protected $fillable = ['nome', 'preco_venda', 'descricao', 'categoria_id', 'unidade_id'];

    public function categoria(){
        return $this->belongsTo('Modules\Estoque\Entities\Categoria')->withTrashed();
    }

    public function unidade() {
        return $this->belongsTo('Modules\Estoque\Entities\UnidadeProduto')->withTrashed();
    }

}
