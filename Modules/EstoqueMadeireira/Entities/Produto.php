<?php

namespace Modules\EstoqueMadeireira\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Produto extends Model
{
    use softDeletes;

    protected $table = 'produto';
    protected $fillable = ['nome', 'preco', 'codigo', 'descricao', 'categoria_id'];


    public function categoria(){
        return $this->belongsTo('Modules\Estoque\Entities\Categoria')->withTrashed();
    }
}
