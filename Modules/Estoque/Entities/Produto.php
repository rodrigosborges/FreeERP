<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use softDeletes;

    protected $table = 'produto';
    protected $fillable = ['nome', 'preco_venda', 'descricao', 'categoria_estoque_id'];

    public function categoria(){
        $this->hasOne('App\CategoriaEstoque');
    }

}
