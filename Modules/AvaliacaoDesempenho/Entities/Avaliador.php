<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;

class Avaliador extends Model
{
    protected $table = 'avaliador';
    protected $fillable = ['funcionario_id', 'avaliacao_id', 'concluido', 'token', 'validade'];
    
    public function funcionario() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Funcionario', 'funcionario_id');
    }

    public function avaliacao() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Avaliacao', 'avaliacao_id');
    }
}