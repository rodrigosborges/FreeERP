<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questao extends Model
{
    protected $table = 'questao';
    protected $fillable = ['enunciado', 'opt1', 'opt2', 'opt3', 'opt4', 'opt5', 'categoria_id'];
    use SoftDeletes;

    public function categoria() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Categoria', 'categoria_id');
    }

    public function avaliacoes() {
        return $this->belongsToMany('Modules\AvaliacaoDesempenho\Entities\Avaliacao', 'avaliacao_has_questao', 'questao_id', 'avaliacao_id');
    }
}
