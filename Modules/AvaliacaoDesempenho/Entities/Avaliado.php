<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;

class Avaliado extends Model
{
    protected $table = 'avaliado';
    protected $fillable = ['funcionario_id', 'avaliacao_id'];
    
    public function avaliado() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Funcionario', 'funcionario_id');
    }

    public function avaliacao() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Avaliacao', 'avaliacao_id');
    }
}
