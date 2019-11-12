<?php
namespace Modules\EstoqueMadeireira\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Estoque extends Model
{
    use SoftDeletes;

    protected $fillable = ['quantidade','tipoUnidade_id'];
    protected $table = 'estoque';


    public function produtos()
    {
        return $this->belongsToMany('Modules\EstoqueMadeireira\Entities\Produto', 'estoque_has_produto','estoque_id','produto_id')->withTrashed();
    }
    public function tipoUnidade()
    {
        return $this->belongsTo('Modules\EstoqueMadeireira\Entities\tipoUnidade', 'tipoUnidade_id')->withTrashed();
    }
    public function movimentacaoEstoque()
    {
        return $this->hasMany('Modules\EstoqueMadeireira\Entities\MovimentacaoEstoque');
    }
}


