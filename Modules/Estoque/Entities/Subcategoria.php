<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','categoria_id'];
    protected $table = 'subcategoria';


    public function categoria(){
        return $this->belongsTo('Modules\Estoque\Entities\Categoria', 'id', 'id');
    }
}
