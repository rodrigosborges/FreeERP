<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoUnidade extends Model
{
    protected $fillable = ['nome','quantidade_itens'];
    protected $table = 'tipo_unidade';

    public function estoque()
    {
        return $this->belongsTo('Modules\Estoque\Entities\Estoque');
    }
}
