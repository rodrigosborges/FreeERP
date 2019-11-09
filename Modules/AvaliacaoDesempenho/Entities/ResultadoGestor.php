<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;

class ResultadoGestor extends Model
{
    protected $table = 'resultado_gestor';
    protected $fillable = ['avaliacao_id', 'avaliador_id', 'avaliado_id', 'respostas'];

    public function avaliacao() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Avaliacao', 'avaliacao_id');
    }

    public function avaliador() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Avaliador', 'avaliador_id');
    }

    public function avaliado() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Avaliado', 'avaliado_id');
    }
}
