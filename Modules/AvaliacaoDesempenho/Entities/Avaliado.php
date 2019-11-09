<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;

class Avaliado extends Model
{
    protected $table = 'avaliado';
    protected $fillable = ['funcionario_id', 'avaliacao_id', 'concluido'];

    public function funcionario() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Funcionario', 'funcionario_id');
    }

    public function avaliacao() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Avaliacao', 'avaliacao_id');
    }

    public function resposta() {

        if ($this->avaliacao->tipo->id == 1) {
            return $this->hasOne('Modules\AvaliacaoDesempenho\Entities\ResultadoGestor', 'avaliado_id', 'id');
        } else {
            return $this->hasOne('Modules\AvaliacaoDesempenho\Entities\ResultadoFuncionario', 'avaliado_id', 'id');
        }
    }
}