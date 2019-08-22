<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $fillable = ['id','categoria_id'];
    protected $table = 'subcategoria';


    public function categoria(){
        return $this->belongsTo('Modules\Estoque\Entities\Categoria');
    }
}
