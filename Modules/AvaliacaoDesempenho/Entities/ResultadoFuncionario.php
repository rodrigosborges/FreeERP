<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;

class ResultadoFuncionario extends Model
{
    protected $table = 'resultado_funcionario';
    protected $fillable = ['avaliado_id', 'respostas'];

    public function avaliado() {
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Avaliado', 'avaliado_id');
    }
}
