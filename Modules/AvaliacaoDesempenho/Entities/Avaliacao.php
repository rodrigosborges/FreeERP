<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaliacao extends Model
{
    protected $table = 'avaliacao';
    protected $fillable = ['nome', 'processo_id', 'funcionario_id', 'setor_id', 'tipo_id', 'status_id', 'modelo_id', 'data_inicio', 'data_fim'];
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

    public function status() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Status', 'status_id');
    }

    public function modelo() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Categoria', 'modelo_id');
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

    public function resultados() {

        if ($this->avaliacao->tipo->id == 1) {
            return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\ResultadoFuncionario', 'avalicao_id', 'id');
        } else {
            return $this->hasOne('Modules\AvaliacaoDesempenho\Entities\ResultadoGestor', 'avalicao_id', 'id');
        }
    }

    // GETTERS E SETTERS
    public function getDataInicioAttribute() {
        return date("d/m/Y", strtotime($this->attributes['data_inicio']));
    }

    public function getDataFimAttribute() {
        return date("d/m/Y", strtotime($this->attributes['data_fim']));
    }

    public function setDataInicioAttribute($data) {
        $this->attributes['data_inicio'] = implode('-', array_reverse(explode('/', $data))) ? : '';
    }

    public function setDataFimAttribute($data) {
        $this->attributes['data_fim'] = implode('-', array_reverse(explode('/', $data))) ? : '';        
    }
}
