<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;

class UnidadeProduto extends Model
{
    protected $fillable = ['tipo'];
    protected $table = 'unidade_produto';

    public function produtos() {
        return $this->hasMany('Modules\Estoque\Entities\Produto');
    }

    
}
