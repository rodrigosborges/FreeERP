<?php

namespace Modules\AvaliacaoDesempenho\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setor extends Model
{
    protected $table = 'setor';
    protected $fillable = ['nome', 'gestor_id'];
    use SoftDeletes;

    public function gestor() {
        return $this->hasOne('Modules\AvaliacaoDesempenho\Entities\Funcionario');
    }

    public function funcionarios() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Funcionario', 'funcionario_id', 'id');
    }

    public function avaliacoes() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Avaliacao', 'setor_id', 'id');
    }
}
