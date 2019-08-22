<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $fillable = ['nome','categoria_id'];


    public function categoria(){
        return $this->belongsTo('App\Entities\Categoria');
    }
}
