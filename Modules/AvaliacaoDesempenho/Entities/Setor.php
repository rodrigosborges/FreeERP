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
        return $this->belongsTo('Modules\AvaliacaoDesempenho\Entities\Funcionario');
    }

    public function funcionarios() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Funcionario', 'setor_id', 'id');
    }

    public function avaliacoes() {
        return $this->hasMany('Modules\AvaliacaoDesempenho\Entities\Avaliacao', 'setor_id', 'id');
    }

    public function cargos() {
        return $this->belongsToMany('Modules\AvaliacaoDesempenho\Entities\Cargo', 'setor_has_cargo', 'setor_id', 'cargo_id');
    }
}
