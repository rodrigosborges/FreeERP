<?php

namespace Modules\EstoqueMadeireira\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Produto extends Model
{
    use softDeletes;

    protected $table = 'produto';
    protected $fillable = ['nome', 'preco', 'tamanho', 'descricao', 'categoria_id', 'fornecedor_id', 'unidadeMedida_id'];


    public function categoria(){
        return $this->belongsTo('Modules\EstoqueMadeireira\Entities\Categoria')->withTrashed();
    }

    public function fornecedor(){
        return $this->belongsTo('Modules\EstoqueMadeireira\Entities\Fornecedor')->withTrashed();

    }

    public function unidadeMedida(){
        return $this->belongsTo('Modules\EstoqueMadeireira\Entities\UnidadeMedida')->withTrashed();
    }
}
