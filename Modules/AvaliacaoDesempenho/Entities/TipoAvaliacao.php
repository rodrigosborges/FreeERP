<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoAvaliacao extends Model
{
    protected $table = 'tipo_avaliacao';
    protected $fillable = ['nome'];

    public function avaliacoes() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Avaliacao', 'tipo_id', 'id');
    }
}
