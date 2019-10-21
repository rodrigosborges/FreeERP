<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaliacao extends Model
{
    protected $table = 'avaliacao';
    protected $fillable = ['nome', 'processo_id', 'funcionario_id', 'setor_id', 'tipo_id', 'status_id', 'data_inicio', 'data_fim'];
    use SoftDeletes;

    public function processo() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Processo', 'processo_id');
    }

    public function responsavel() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Funcionario', 'funcionario_id');
    }

    public function setor() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Setor', 'setor_id');
    }

    public function tipo() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\TipoAvaliacao', 'tipo_id');
    }

    public function questoes() {
        return $this->belongsToMany('Modules\AvaliacaoDesempenho\Entities\Questao', 'avaliacao_has_questao', 'avaliacao_id', 'questao_id');
    }

    public function avaliadores() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Avaliador', 'avaliacao_id', 'id');
    }

    public function avaliados() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Avaliado', 'avaliacao_id', 'id');
    }
}
