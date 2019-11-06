<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Processo extends Model
{
    protected $table = 'processo';
    protected $fillable = ['nome', 'data_inicio', 'data_fim', 'funcionario_id', 'status_id'];
    use SoftDeletes;

    public function responsavel() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Funcionario', 'funcionario_id');
    }

    public function avaliacoes() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Avaliacao', 'processo_id', 'id');
    }

    public function status() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Status', 'status_id');
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
