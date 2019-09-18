<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Categoria extends Model
{
    use SoftDeletes;
    protected $fillable = ['nome'];
    protected $table = 'categoria';

    public function subcategoria(){
        return $this->hasMany('Modules\Estoque\Entities\Subcategoria')->withTrashed();
    }
}
