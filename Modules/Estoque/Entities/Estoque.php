<?php

namespace Modules\Estoque\Entities;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = ['quantidade', 'produto_id', 'tipo_unidade'];
    protected $table = 'estoque';

    public function produtos()
    {
        return $this->hasMany('Modules\Estoque\Entities\Produto');
    }
    public function tipoUnidade()
    {
        return $this->hasOne('Modules\Estoque\Entities\TipoUnidade');
    }

}
