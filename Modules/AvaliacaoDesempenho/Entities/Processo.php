<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Processo extends Model
{
    protected $table = 'processo';
    protected $fillable = ['data_inicio', 'data_fim', 'funcionario_id', 'status_id'];
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
}
