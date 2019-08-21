<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome'];

    public function subcategoria(){
        return $this->hasMany('App\Entities\Subcategoria');
    }
}
