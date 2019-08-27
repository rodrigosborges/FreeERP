<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnidadeProduto extends Model
{

    use softDeletes;

    protected $fillable = ['tipo'];
    protected $table = 'unidade_produto';

    public function produtos() {
        return $this->hasMany('Modules\Estoque\Entities\Produto');
    }

    
}
