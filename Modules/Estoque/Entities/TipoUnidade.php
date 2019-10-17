<?php

namespace Modules\Estoque\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TipoUnidade extends Model
{
    use SoftDeletes;
    protected $fillable = ['nome','quantidade_itens'];
    protected $table = 'tipo_unidade';

    public function estoque()
    {
        return $this->belongsTo('Modules\Estoque\Entities\Estoque')->withTrashed();
    }
}
